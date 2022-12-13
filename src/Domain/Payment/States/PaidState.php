<?php

declare(strict_types=1);

namespace Domain\Payment\States;

final class PaidState extends PaymentState
{
    public static string $name = 'paid';
}
