<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Processes\AssignCustomer;
use App\Processes\AssignProducts;
use App\Processes\ChangeStateToPending;
use App\Processes\CheckProductQuantities;
use App\Processes\ClearCart;
use App\Processes\DecreaseProductsQuantities;
use Domain\Order\Actions\Contracts\NewOrderContract;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;
use Domain\Order\Processes\OrderProcess;
use DomainException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): Factory|View|Application
    {
        $items = cart()->items();

        if ($items->isEmpty()) {
            throw new DomainException('Корзина пуста');
        }

        return view('front.order.index', [
            'items' => $items,
            'payments' => PaymentMethod::query()->get(),
            'deliveries' => DeliveryType::query()->get()
        ]);
    }

    public function handle(OrderRequest $request, NewOrderContract $contract): RedirectResponse
    {
        $order = $contract($request);

        (new OrderProcess($order))
            ->processes([
                new CheckProductQuantities(),
                new AssignCustomer(request('customer')),
                new AssignProducts(),
                new ChangeStateToPending(),
                new DecreaseProductsQuantities(),
                new ClearCart(),
            ])->run();

        return to_route('home');
    }
}
