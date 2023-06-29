<?php

namespace App\Http\Requests\Order;

use Domain\Order\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer.first_name' => ['required', 'string'],
            'customer.last_name' => ['required', 'string'],
            'customer.email' => ['required', 'email:dns'],
            'customer.phone' => ['required', new PhoneRule()],
            'customer.city' => ['required'],
            'customer.address' => ['required'],
            'create_account' => ['bool'],
            'password' => request()->boolean('create_account')
                ? ['required', 'confirmed', Password::default()]
                : ['sometimes'],
            'delivery_type_id' => ['required', 'exists:delivery_types,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'amount' => ['required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'customer.first_name' => __('customer.first_name'),
            'customer.last_name' => __('customer.last_name'),
            'customer.email' => __('customer.email'),
            'customer.phone' => __('customer.phone'),
            'customer.city' => __('customer.city'),
            'customer.address' => __('customer.address'),
        ];
    }
}
