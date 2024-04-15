<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changeEmailRequest extends FormRequest
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
            'token' => ['required', 'numeric', 'digits:6'],
            'new_email' => ['required', 'email', 'confirmed'],
            'password' => ['required'],
        ];
    }
}
