<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequest extends FormRequest
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
            'nome' => 'required|max:120|min:5|',
            'cpf' => 'required|max:11|min:11|unique:clientes,cpf,',
            'password' => 'required|'
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
        return [
            'nome.required' => 'Preencha o campo nome',
            'nome.max' => 'Este campo deve conter no maximo 120 caractéris',
            'nome.min' => 'Este campo deve conter no minimo 5 caractéris',
            'cpf.required' => 'Preencha o campo CPF',
            'cpf.min' => 'este campo deve ter no minimo 11 caractéris',
            'cpf.max' => 'este campo deve ter no maximo 11 caractéris',
            'cpf.required' => 'Preencha o campo CPF',
            'cpf.unique' => 'Este CPF já esta no sistema',
            'password.required' => 'Senha é obrigatória'

        ];
    }
}
