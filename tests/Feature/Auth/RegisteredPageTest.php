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
}
