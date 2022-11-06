<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\NewPasswordController;
use Domain\User\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewPasswordPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_registered_page_status(): void
    {
        $this->get(action([NewPasswordController::class, 'show']))
            ->assertOk();
    }

    public function can_user_reestablish_password(): void
    {
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@mail.com',
            'password' => 123456
        ]);

        /* @var Authenticatable $user */
        $user = User::query()->where('email', 'test@mail.com')->first();

        $user->forceFill([
            'password' => 654321
        ]);

        $user->save();

        $this->assertTrue($user->save());

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.com',
            'password' => 654321
        ]);
    }
}
