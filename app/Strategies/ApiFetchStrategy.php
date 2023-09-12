<?php

namespace App\Strategies;


class ApiFetchStrategy implements ComputationStrategy
{
    public function compute($value, $meta, $parentValue = null)
    {
        // Fetch value from API and potentially cache it
        // Use $value and $meta to determine how to fetch the value
        return $value; // modify as per your logic
    }
}
