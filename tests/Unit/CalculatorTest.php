<?php

namespace Tests\Unit;

use App\Http\Factories\CalculatorFactory;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function test_addition()
    {
        $result = CalculatorFactory::build('add')->calculate(2, 2);

        $this->assertEquals($result, 4);
    }

    public function test_substraction()
    {
        $result = CalculatorFactory::build('substract')->calculate(2, 2);

        $this->assertEquals($result, 0);
    }

    public function test_division()
    {
        $result = CalculatorFactory::build('divide')->calculate(2, 2);

        $this->assertEquals($result, 1);
    }

    public function test_multiple()
    {
        $result = CalculatorFactory::build('multiply')->calculate(2, 2);

        $this->assertEquals($result, 4);
    }
}
