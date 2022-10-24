<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EditProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'string', 'unique:users'],
            'password' => ['nullable', 'confirmed', Password::default()],
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => __('passwords.current'),
            'password_confirmation' => __('passwords.password')
        ];
    }
}
