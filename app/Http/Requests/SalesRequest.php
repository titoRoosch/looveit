<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|numeric|between:0,99999999.99',
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'O campo products é obrigatório.',
            'products.array' => 'O campo products deve ser um array.',
            'products.*.product_id.required' => 'O campo product_id é obrigatório.',
            'products.*.product_id.integer' => 'O campo product_id deve ser um número inteiro.',
            'products.*.quantity.required' => 'O campo quantity é obrigatório.',
            'products.*.quantity.numeric' => 'O campo quantity deve ser um número.',
            'products.*.quantity.between' => 'O campo quantity deve estar entre 0 e 99999999.99.',
            'products.*' => 'Os dados do produto são inválidos.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();
        throw new HttpResponseException(response()->json(['message' => $message]
        , 422));
    }
}
