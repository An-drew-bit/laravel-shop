<?php

namespace Tests\Feature\Domain\Order\DTO;

use Domain\Order\DTO\OrderCustomerDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderCustomerDTOTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_customer_from_form_request(): void
    {
        $request = [
            'first_name' => 'test',
            'last_name' => 'testov',
            'email' => 'test@mail.com',
            'phone' => '73654471808',
            'city' => 'Test city',
            'address' => 'Test street, 18'
        ];

        $dto = OrderCustomerDTO::fromArray($request);

        $this->assertInstanceOf(OrderCustomerDTO::class, $dto);
    }
}
