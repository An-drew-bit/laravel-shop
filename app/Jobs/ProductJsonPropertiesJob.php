<?php

namespace App\Jobs;

use Domain\Product\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductJsonPropertiesJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Product $product,
    ){
    }

    public function handle(): void
    {
        $this->product->updateQuietly([
            'json_properties' => $this->product->properties->keyValues()
        ]);
    }

    public function uniqueId(): mixed
    {
        return $this->product->getKey();
    }
}
