<?php
namespace App\Strategies;

class AdditionStrategy implements ComputationStrategy
{
    public function compute($targetFieldValue, $attributeValue)
    {
        return $targetFieldValue + $attributeValue;
    }
}
