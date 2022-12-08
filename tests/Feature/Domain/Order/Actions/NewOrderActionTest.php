<?php

namespace Tests\Feature\Domain\Order\Actions;

use Domain\Order\Actions\Contracts\NewOrderContract;
use Domain\Order\DTO\OrderCustomerDTO;
use Domain\Order\DTO\OrderDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewOrderActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_order_created(): void
    {
        $actions = app(NewOrderContract::class);

        $request = [
            'first_name' => 'test',
            'last_name' => 'testov',
            'email' => 'test@mail.com',
            'phone' => '73654471808',
            'city' => 'Test city',
            'address' => 'Test street, 18'
        ];

        $actions(
            OrderDTO::make(...[1, 2, 'querty123AA']),
            OrderCustomerDTO::fromArray($request),
            false
        );

        $this->assertDatabaseHas('orders', [
            'status' => 'new',
            'delivery_type_id' => 2,
            'payment_method_id' => 1
        ]);
    }
}
