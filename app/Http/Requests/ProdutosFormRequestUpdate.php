<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutosFormRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => '|max:80|min:5|unique:produtos,nome',
            'valor_unit' => '|decimal:2,4'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'error' => $validator->errors()
            ])
        );
    }

    public function messages()
    {
        return  [

            'nome.max' => 'Este campo deve conter no maximo 80 caractéris',
            'nome.min' => 'Este campo deve conter no minimo 5 caractéris',
            'valor_unit.decimal' => 'Este campo recebe apenas numeros decimais ',

        ];
    }
}
