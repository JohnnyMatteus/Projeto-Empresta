<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaxasInstituitionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'valor_emprestimo' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            'parcela' => 'numeric'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute e necessario.',
            'numeric' => 'O campo :attribute tem que ser numerico.',
            'regex' => 'O campo :attribute tem que ser float.'
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
