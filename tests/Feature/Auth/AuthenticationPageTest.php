<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_page_status()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_can_user_auth()
    {
        User::factory()->create([
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
}
