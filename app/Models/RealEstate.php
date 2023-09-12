<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMetaAttributes;
use App\Strategies\SubtractionStrategy;

class RealEstate extends Model
{
    use HasMetaAttributes;

    protected $fillable = ['value', 'name', 'llc_id'];

    protected $meta = [
        'value' => [
            'compute' => [
                [
                    'targetClass' => Liability::class,
                    'targetField' => 'value',
                    'computeStrategy' => SubtractionStrategy::class
                ]
            ]
        ]
    ];

    public function llc()
    {
        return $this->belongsTo(LLC::class);
    }

    public function liabilities()
    {
        return $this->hasMany(Liability::class);
    }
}
