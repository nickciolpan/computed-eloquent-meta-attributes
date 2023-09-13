<?php
namespace App\Strategies;

class AdditionStrategy implements ComputationStrategy
{
    public function compute($targetFieldValue, $attributeValue)
    {
        var_dump($targetFieldValue);
        var_dump($attributeValue);
        return $targetFieldValue + $attributeValue;
    }
}
