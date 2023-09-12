<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMetaAttributes;
use App\Strategies\SubtractionStrategy;

class Liability extends Model
{
    use HasMetaAttributes;

    protected $fillable = ['value', 'name', 'real_estate_id'];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class);
    }
}
