<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Change to your authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages()
    {
        return [
            'name.string' => 'el nomnbre debe ser una cadena de texto',
            'name.max' => 'el nombre no puede exceder los 255 caracteres',
            'price.numeric' => 'el precio debe ser un número',
            'price.min' => 'el precio debe ser al menos 0',
            'stock.integer' => 'el stock debe ser un número entero',
            'stock.min' => 'el stock debe ser al menos 0',
        ];
    }
}
