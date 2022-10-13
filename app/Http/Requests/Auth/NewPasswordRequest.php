<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class NewPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'current' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::default()]
        ];
    }

    public function attributes(): array
    {
        return [
            'current' => trans('passwords.current'),
            'password' => trans('passwords.password')
        ];
    }
}
