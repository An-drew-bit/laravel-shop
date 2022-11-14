<?php

namespace Tests\Unit\Support\ValueObjects;

use Support\ValueObjects\Price;
use Tests\TestCase;

class PriceTest extends TestCase
{
    public function test_it_success(): void
    {
        $price = Price::make(10000);

        $this->assertInstanceOf(Price::class, $price);

        $this->assertEquals(100, $price->value());
        $this->assertEquals(10000, $price->raw());
        $this->assertEquals('RUB', $price->currency());
    }

    public function test_it_invalid_currency(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Price::make(-100000);
        Price::make(10000, 'USD');
    }
}
