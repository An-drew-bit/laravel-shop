<?php

namespace Tests\Feature\App\Http\Controllers\Profile;

use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    public function test_profile_page_status(): void
    {
        $user = UserFactory::new()->create([
            'id' => 1,
            'name' => 'Test 2',
            'email' => 'test2@mail.com',
            'password' => 12345
        ]);

        auth()->login($user);

        $response = $this->get("/profile/1/edit");

        $response->assertStatus(200);
    }

    public function test_can_user_update_profile()
    {
        $user = User::where('id', 1)->firstOrFail();

        $user->update([
            'email' => 'test22@mail.com',
            'password' => 54321
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test22@mail.com'
        ]);
    }
}
