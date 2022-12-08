<?php

namespace Tests\Feature\Domain\Order\DTO;

use Domain\Order\DTO\OrderDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderDTOTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_order_from_form_request(): void
    {
        $dto = OrderDTO::make(...[1, 2, 'querty123AA']);

        $this->assertInstanceOf(OrderDTO::class, $dto);
    }
}
