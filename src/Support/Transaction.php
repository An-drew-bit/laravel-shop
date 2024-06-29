<?php

declare(strict_types=1);

namespace Support;

use Closure;
use Throwable;
use Illuminate\Support\Facades\DB;

final class Transaction
{
    /**
     * @throws Throwable
     */
    public static function run(Closure $callback, Closure $finished = null, Closure $onError = null)
    {
        try {
            DB::beginTransaction();

            return tap($callback(), function ($result) use ($finished) {
                if (!is_null($finished)) {
                    $finished($result);
                }

                DB::commit();
            });

        } catch (Throwable $exception) {
            DB::rollBack();

            if (!is_null($onError)) {
                $onError($exception);
            }

            throw $exception;
        }
    }
}
