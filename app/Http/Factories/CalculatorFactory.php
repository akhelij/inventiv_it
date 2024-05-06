<?php

namespace App\Http\Factories;

class CalculatorFactory
{
    public static function build($type = '')
    {
        if ($type != '') {
            $className = 'App\\Http\\Controllers\\Calculator\\'.ucfirst($type);
            if (class_exists($className)) {
                return new $className();
            }
        }
    }
}
