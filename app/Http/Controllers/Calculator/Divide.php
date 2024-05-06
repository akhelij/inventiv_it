<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Interfaces\CalculatorInterface;

class Divide implements CalculatorInterface
{
    public function calculate($value1, $value2)
    {
        return $value1 / $value2;
    }
}
