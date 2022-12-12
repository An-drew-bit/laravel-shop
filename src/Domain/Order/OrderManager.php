<?php

declare(strict_types=1);

namespace Domain\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Processes\AssignCustomer;
use App\Processes\AssignProducts;
use App\Processes\ChangeStateToPending;
use App\Processes\CheckProductQuantities;
use App\Processes\ClearCart;
use App\Processes\DecreaseProductsQuantities;
use Domain\Order\Actions\Contracts\NewOrderContract;
use Domain\Order\DTO\OrderCustomerDTO;
use Domain\Order\DTO\OrderDTO;
use Domain\Order\Processes\OrderProcess;

final class OrderManager
{
    public function handle(OrderRequest $request, NewOrderContract $contract): void
    {
        $customer = OrderCustomerDTO::fromArray($request->get('customer'));

        $order = $contract(
            OrderDTO::make(...$request->only(['payment_method_id', 'delivery_type_id', 'password'])),
            $customer,
            $request->boolean('create_account')
        );

        (new OrderProcess($order))
            ->processes([
                new CheckProductQuantities(),
                new AssignCustomer($customer),
                new AssignProducts(),
                new ChangeStateToPending(),
                new DecreaseProductsQuantities(),
                new ClearCart(),
            ])->run();
    }
}
