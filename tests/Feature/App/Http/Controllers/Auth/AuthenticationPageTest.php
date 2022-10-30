<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthenticatedController;
use Database\Factories\Domain\User\Models\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_page_status(): void
    {
        $response = $this->get(action([AuthenticatedController::class, 'show']));

        $response->assertStatus(200);
    }

    public function test_can_user_auth(): void
    {
        UserFactory::new()->create([
            'id' => 1,
            'name' => 'Test1',
            'email' => 'test1@mail.com',
            'password' => 12345
        ]);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'name' => 'Test1',
        ]);

        $response = $this->post('/login', [
            'email' => 'test1@mail.com',
            'password' => 12345
        ]);

        $response->assertRedirect('/');
    }

    public function test_can_user_logout(): void
    {
        $user = UserFactory::new()->create([
            'id' => 2,
            'name' => 'Test2',
            'email' => 'test12@mail.com',
            'password' => 12345
        ]);

        $this->actingAs($user)
            ->get(action([AuthenticatedController::class, 'logout']));

        $this->assertGuest();
    }
}
