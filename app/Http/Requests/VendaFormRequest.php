<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaFormRequest extends FormRequest
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
            'data'=>'required|date',
            'quantidade' => 'required',
            'valor' => 'required|decimal:2,4'
        ];
    }



    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'sucess' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'data.date' => 'formato da data está inválido',
            'data.required' => 'Data é obrigatória',
            'quantidade.required' => 'quantidade é obrigatorio',
            'valor.decimal' => 'formato invalido',
            'valor.required' => 'valor obrigatorio',

        ];
    }
}
