<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthenticatedController;
use Database\Factories\Domain\User\Models\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_page_success(): void
    {
        $this->get(action([AuthenticatedController::class, 'show']))
            ->assertOk()
            ->assertSee('Вход в аккаунт')
            ->assertViewIs('front.auth.login-mail');
    }

    public function test_it_store_success(): void
    {
        $password = '12334567';

        $user = UserFactory::new()->create([
            'email' => 'test1@mail.com',
            'password' => bcrypt($password)
        ]);

        $request = [
            'email' => $user->email,
            'password' => $password
        ];

        $response = $this->post(action([AuthenticatedController::class, 'store']), $request);

        $response->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_it_logout_success()
    {
        $user = UserFactory::new()->create([
            'email' => 'test12@mail.com',
        ]);

        $this->actingAs($user)
            ->get(action([AuthenticatedController::class, 'logout']));

        $this->assertGuest();
    }

    public function test_it_logout_guest_middleware_fail(): void
    {
        $this->get(action([AuthenticatedController::class, 'logout']))
            ->assertRedirect(route('login'));
    }
}
