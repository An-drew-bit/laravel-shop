<?php

declare(strict_types=1);

namespace Domain\Payment\States;

final class PendingState extends PaymentState
{
    public static string $name = 'pending';
}
