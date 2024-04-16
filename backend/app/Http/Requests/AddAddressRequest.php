<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAddressRequest extends FormRequest
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
            "name" => ['required', 'max:255'],
            "address_type" => ['required', 'size:1'],
            "Recipient" => ['required', 'min:4', 'max:220'],
            "cep" => ['required', 'size:8'],
            "street" => ['required', 'max:300'],
            "number" => ['sometimes', 'max:100'],
            "complement" => ['sometimes', 'max:300'],
            "neighborhood" => ['required', 'max:225'],
            "city" => ['required', 'max:170'],
            "uf" => ['required', 'size:2'],
            "reference" => ['sometimes', 'max:320'],
            "main" => ['sometimes', 'boolean'],
        ];
    }
}
