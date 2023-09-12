<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMetaAttributes;
use App\Strategies\AdditionStrategy;

class Llc extends Model
{
    use HasMetaAttributes;
    protected $table = "llcs";

    protected $meta = [
        'value' => [
            'compute' => [
                [
                    'targetClass' => RealEstate::class,
                    'targetField' => 'value',
                    'computeStrategy' => AdditionStrategy::class
                ]
            ]
        ]
    ];


    protected $fillable = ['value', 'name'];

    public function realEstates()
    {
        return $this->hasMany(RealEstate::class);
    }
}
