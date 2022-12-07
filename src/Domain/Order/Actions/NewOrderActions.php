<?php

namespace Domain\Order\Actions;

use Domain\Order\Actions\Contracts\NewOrderContract;
use Domain\Order\Models\Order;
use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\DTO\NewUserDTO;
use Illuminate\Foundation\Http\FormRequest;

final class NewOrderActions implements NewOrderContract
{
    public function __invoke(FormRequest $request): Order
    {
        $registerAction = app(RegisteredContract::class);

        $customer = $request->get('customer');

        if ($request->boolean('create_account')) {
            $registerAction(NewUserDTO::make(
                $customer['first_name'] . ' ' . $customer['last_name'],
                $customer['email'],
                $customer['password'],
            ));
        }

        return Order::query()->create([
            'user_id' => auth()->id() ?? null,
            'payment_method_id' => $request->get('payment_method_id'),
            'delivery_type_id' => $request->get('delivery_type_id'),
        ]);
    }
}
