<?php

declare(strict_types=1);

namespace Domain\Payment\States;

final class CancelledState extends PaymentState
{
    public static string $name = 'failed';
}
