<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasMetaAttributes
{
    protected static $globalWithMeta = false;
    protected $instanceWithMeta = null;

    public static function toggleMeta(bool $withMeta = true)
    {
        static::$globalWithMeta = $withMeta;
    }

    public static function disableMetaFields(bool $withMeta = true)
    {
        static::$globalWithMeta = $withMeta;
    }

    public function withMeta(bool $withMeta = true)
    {
        $this->instanceWithMeta = $withMeta;
        return $this;
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        $withMeta = $this->instanceWithMeta !== null ? $this->instanceWithMeta : static::$globalWithMeta;

        if ($withMeta && isset($this->meta[$key])) {
            $meta = $this->meta[$key];
            $computedValues = $this->computeMetaValue($key, $value, $meta);
            $meta['computedValues'] = $computedValues;
            // @todo: should we keep the compute information

            return [
                'value' => $value,
                'meta' => $meta,
            ];
        }

        return $value;
    }

    public function toArray()
    {
        $attributes = parent::toArray();
        $withMeta = $this->instanceWithMeta !== null ? $this->instanceWithMeta : static::$globalWithMeta;

        if ($withMeta) {
            foreach ($this->meta as $key => $metaData) {
                if (array_key_exists($key, $attributes)) {
                    $computedValues = $this->computeMetaValue($key, $attributes[$key], $metaData);
                    $metaData['computedValues'] = $computedValues;
                    $attributes['meta'][] = [
                        $key =>$metaData,
                    ];
                }
            }
        }

        return $attributes;
    }

    private function computeMetaValue($key, $value, $meta)
    {
        $computedValues = [];

        if (isset($meta['compute'])) {
            foreach ($meta['compute'] as $computeData) {
                if (class_exists($computeData['targetClass'])) {
                    $strategyClass = $computeData['computeStrategy'];
                    if (!class_exists($strategyClass)) {
                        \Log::warning("Strategy class does not exist: $strategyClass"); // Debug line
                        continue;
                    }

                    $strategy = new $strategyClass();
                    $relationMethod = Str::camel(Str::plural(class_basename($computeData['targetClass'])));

                    // Ensure the relation method exists
                    if (!method_exists($this, $relationMethod)) {
                        \Log::warning("Relation method does not exist: {$relationMethod} on class " . static::class);
                        continue;
                    }

                    $relatedModels = $this->$relationMethod;

                    // Ensure related models are not null
                    if (is_null($relatedModels)) {
                        \Log::info("Related models are null for relation method: $relationMethod"); // Debug line
                        continue;
                    }

                    $totalComputedValue = $value;  // Start with the original value
                    foreach ($relatedModels as $relatedModel) {
                        var_dump("compute data field" . $computeData['targetField']);
                        $targetValue = collect($relatedModel->attributes)->get('meta.computedValues') ?? $relatedModel->{$computeData['targetField']};
                        $totalComputedValue = $strategy->compute($totalComputedValue, $targetValue);
                    }

                    $computedValues[] = [
                        'computedClass' => $computeData['targetClass'],
                        'originalValue' => $value,
                        'computedValue' => $totalComputedValue,
                    ];

                } else {
                    \Log::warning("Target class does not exist: " . $computeData['targetClass']); // Debug line
                }
            }
        } else {
            \Log::info("Meta compute is not set."); // Debug line
        }

        return $computedValues;
    }
}
