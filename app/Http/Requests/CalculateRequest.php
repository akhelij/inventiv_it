<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CalculateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
    
    public function rules(): array
    {
        return [
            'value1' => 'required|numeric',
            'value2' => 'required|numeric',
            'operation' => 'required|in:add,multiply,substract,divide',
        ];
    }
}
