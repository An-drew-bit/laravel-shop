<?php

namespace Domain\Order\Actions;

use Domain\Order\Actions\Contracts\NewOrderContract;
use Domain\Order\DTO\OrderCustomerDTO;
use Domain\Order\DTO\OrderDTO;
use Domain\Order\Models\Order;
use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\DTO\NewUserDTO;

final class NewOrderActions implements NewOrderContract
{
    public function __invoke(OrderDTO $data, OrderCustomerDTO $customer, bool $createAccount): Order
    {
        $registerAction = app(RegisteredContract::class);

        if ($createAccount) {
            $registerAction(NewUserDTO::make(
                $customer->fullName(),
                $customer->email,
                $data->getPassword(),
            ));
        }

        return Order::query()->create([
            'user_id' => auth()->id() ?? null,
            'payment_method_id' => $data->getPaymentMethodId(),
            'delivery_type_id' => $data->getDeliveryTypeId(),
            'amount' => (int) $data->getAmount(),
        ]);
    }
}
