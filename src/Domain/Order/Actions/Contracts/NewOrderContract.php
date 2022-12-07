<?php

namespace Domain\Order\Actions\Contracts;

use Domain\Order\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

interface NewOrderContract
{
    // todo make dto latter
    public function __invoke(FormRequest $request): Order;
}
