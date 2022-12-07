<?php

namespace Domain\Order\DTO;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final class NewOrderDTO
{
    use Makeable;

    public function __construct(
    ){
    }

    public static function formRequest(Request $request): self
    {
        return self::make(...$request->only());
    }
}
