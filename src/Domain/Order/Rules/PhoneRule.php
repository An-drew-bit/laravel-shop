<?php

namespace Domain\Order\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{

    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $value);
    }

    public function message(): string
    {
        return __('validation.regex');
    }
}
