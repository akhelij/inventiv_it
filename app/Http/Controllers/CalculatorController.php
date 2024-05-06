<?php

namespace App\Http\Controllers;

use App\Http\Factories\CalculatorFactory;
use App\Http\Requests\CalculateRequest;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function calculate(CalculateRequest $request)
    {
        $operation = basename($request->operation);
        $calculator = CalculatorFactory::build($operation);

        $result = $this->calculateResult($request->value1, $request->value2, $operation, $calculator);
        
        return response()->json([
            'result' => $result,
        ], 200);
    }

    private function calculateResult($value1, $value2, $operation, $calculator) {
        if($value1 == 0 && in_array($operation, ['divide', 'multiply'])) {
            return 0;
        } elseif($operation == 'divide' && $value2 == 0) {
            return 'Error: Division by zero';
        } elseif($value1 == 0) {
            return $value2;
        } else {
            return $calculator->calculate($value1, $value2);
        }
    }
}
