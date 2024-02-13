<?php

namespace App\Http\Requests;

use App\Exceptions\ErrorValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AddProductAtCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !empty($this->only(['id', 'quantity']));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['numeric'],
            'quantity' => ['numeric'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ErrorValidationException($validator->errors()->first());
    }
}
