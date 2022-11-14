<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    public function created(): void
    {
        Cache::forget('brands_home_page');
    }
}
