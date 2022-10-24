<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ReestablishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'unique:users',
                'confirmed',
                Password::default()
            ],
            'password_confirmation' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => __('passwords.password'),
            'password_confirmation' => __('passwords.password_repeat'),
        ];
    }
}
