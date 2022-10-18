<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EditProfileRequest extends FormRequest
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
