<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequestUpdate extends FormRequest
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
            'nome' => 'required|max:100|min:5',
            'cpf' => 'required|numeric|max:99999999999|min:10000000000',
            'password' => ''
        ];
    }

        public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return  [
            
            
            'nome.max' => 'O campo nome não pode ter mais de 120 caracteres.',
            'nome.min' => 'O campo nome deve ter no mínimo 5 caracteres.',
            
        
           
            'cpf.numeric' => 'O campo CPF deve conter apenas números.',
            'cpf.max' => 'O campo CPF deve ter no maximo 11 dígitos.',
            'cpf.min' => 'O campo CPF deve ter no minimo 11 dígitos.',
           
        ];
}
}
