<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisteredPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registered_page_status()
    {
        $response = $this->get('/registered');

        $response->assertStatus(200);
    }

    public function test_add_user_in_database()
    {
        User::factory()->create([
            'id' => 10,
            'name' => 'Test',
            'email' => 'test@mail.com',
            'password' => '12345qwerty',
        ]);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'name' => 'Test'
        ]);
    }

    public function test_can_user_registered()
    {
        $response = $this->post('/registered', [
            'name' => 'Test2',
            'email' => 'test11@mail.com',
            'password' => '12345qwertyW',
            'password_confirmation' => '12345qwertyW'
        ]);

        $response->assertRedirect('/email/verify');

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'name' => 'Test2',
        ]);
    }
}
