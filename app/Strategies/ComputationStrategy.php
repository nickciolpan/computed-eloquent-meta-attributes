<?php

namespace App\Strategies;

interface ComputationStrategy
{
    public function compute($targetFieldValue, $attributeValue);
}
