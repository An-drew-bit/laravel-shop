<?php

namespace Support;

use Closure;
use Domain\User\Events\AfterSessionRegenerated;

final class SessionRegenerator
{
    public static function run(Closure $callback = null): void
    {
        $old = session()->getId();

        session()->invalidate();

        session()->regenerateToken();

        if (!is_null($callback)) {
            $callback();
        }

        event(new AfterSessionRegenerated($old, session()->getId()));
    }
}
