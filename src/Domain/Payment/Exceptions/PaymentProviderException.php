<?php

namespace Domain\Payment\Exceptions;

use Exception;

class PaymentProviderException extends Exception
{
    public static function providerRequired(): self
    {
        return new self('Provider is required');
    }
}
