<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthSocialController;
use Cassandra\Exception\DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Mockery\MockInterface;
use Tests\TestCase;

class SocialAuthTest extends TestCase
{
    use RefreshDatabase;

    private function mockSocialiteCallback(string $githubEmail): MockInterface
    {
        $user = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($githubEmail) {
            $mock->shouldReceive('getName')
                ->once()
                ->andReturn(str()->random(10));

            $mock->shouldReceive('getEmail')
                ->once()
                ->andReturn('testing@mail.com');
        });

        Socialite::shouldReceive('driver->user')
            ->once()
            ->andReturn($user);

        return $user;
    }

    private function callBackRequest(): TestResponse
    {
        return $this->get(action(
            [AuthSocialController::class, 'callback'],
            ['driver' => 'github'])
        );
    }

    public function test_it_github_callback_created_user_success(): void
    {
        $githubEmail = 'testing@mail.com';

        $this->assertDatabaseMissing('users', [
            'email' => $githubEmail
        ]);

        $this->mockSocialiteCallback($githubEmail);

        $this->callBackRequest()
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'email' => $githubEmail
        ]);
    }

    public function test_it_driver_not_exception(): void
    {
        $this->expectException(\DomainException::class);

        $this->withoutExceptionHandling()
            ->get(action(
                [AuthSocialController::class, 'redirect'],
                ['driver' => 'vkontakte'])
            );

        $this->withoutExceptionHandling()
            ->get(action(
                    [AuthSocialController::class, 'callback'],
                    ['driver' => 'vkontakte'])
            );
    }
}
