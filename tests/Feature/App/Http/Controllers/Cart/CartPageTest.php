<?php

namespace Tests\Feature\App\Http\Controllers\Cart;

use App\Http\Controllers\Cart\CartController;
use Database\Factories\Domain\Product\ProductFactory;
use Domain\Cart\CartManager;
use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CartManager::fake();
    }

    public function createNewProduct(): Product
    {
        $product = ProductFactory::new()->create();

        return $product;
    }

    public function test_it_is_empty_cart(): void
    {
        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('front.cart.index')
            ->assertViewHas('items', collect([]));
    }

    public function test_it_is_not_empty_cart(): void
    {
        cart()->add($this->createNewProduct());

        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('front.cart.index')
            ->assertViewHas('items', cart()->items());
    }

    public function test_it_added_success(): void
    {
        $this->assertEquals(0, cart()->countItem());

        $this->post(action([CartController::class, 'add'], $this->createNewProduct()), ['quantity' => 4]);

        $this->assertEquals(4, cart()->countItem());
    }

    public function test_it_quantity_changed(): void
    {
        cart()->add($this->createNewProduct(), 4);

        $this->assertEquals(4, cart()->countItem());

        $this->post(action([CartController::class, 'quantity'], cart()->items()->first()), ['quantity' => 8]);

        $this->assertEquals(8, cart()->countItem());
    }

    public function test_it_delete_success(): void
    {
        cart()->add($this->createNewProduct(), 4);

        $this->assertEquals(4, cart()->countItem());

        $this->delete(action([CartController::class, 'delete'], cart()->items()->first()));

        $this->assertEquals(0, cart()->countItem());
    }

    public function test_it_truncate_success(): void
    {
        cart()->add($this->createNewProduct(), 4);

        $this->assertEquals(4, cart()->countItem());

        $this->delete(action([CartController::class, 'truncate']));

        $this->assertEquals(0, cart()->countItem());
    }
}
