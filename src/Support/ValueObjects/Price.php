<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

final class Price implements Stringable
{
    use Makeable;

    private array $currencies = [
        'RUB' => '₽'
    ];

    public function __construct(
        private readonly int $value,
        private readonly string $currency = 'RUB',
        private readonly int $precision = 100
    )
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        if (!isset($this->currencies[$currency])) {
            throw new InvalidArgumentException('Currency not allowed');
        }
    }

    public function getValue(): int
    {
        return $this->value / $this->precision;
    }

    public function getRaw(): int|float
    {
        return $this->value;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSymbol(): string
    {
        return $this->currencies[$this->currency];
    }

    public function __toString(): string
    {
        return number_format($this->getValue(), 2, ',', ' ')
            . ' ' . $this->getSymbol();
    }
}
