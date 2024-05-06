<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Interfaces\CalculatorInterface;

class Substract implements CalculatorInterface
{
    public function calculate($value1, $value2)
    {
        return $value1 - $value2;
    }
}
