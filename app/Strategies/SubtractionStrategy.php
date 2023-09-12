<?php

namespace App\Strategies;


class SubtractionStrategy implements ComputationStrategy
{
    public function compute($targetFieldValue, $attributeValue)
    {
        return $targetFieldValue - $attributeValue;
    }
}
