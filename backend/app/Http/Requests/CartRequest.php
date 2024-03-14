<?php

namespace App\Http\Requests;

use App\Rules\CepRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class CartRequest extends FormRequest
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
            'cupon' => ['sometimes', 'alpha_num'],
            'cep' => ['sometimes', new CepRule],
            'update_qty' => ['sometimes', 'array'],
            'update_qty.id' => ['required_with:update_qty', 'numeric'],
            'update_qty.qty' => ['required_with:update_qty', 'numeric', 'min:1'],
            'delete_item' => ['sometimes', 'required', 'numeric'],

        ];
    }

    /*  protected function failedValidation(Validator $validator): void
     {

     } */
}
