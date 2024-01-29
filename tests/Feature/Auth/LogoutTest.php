<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Utils\UserUtils;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function logout_authenticatedUser_shouldReturnStatus204(): void {
        // Arrange
        $user = UserUtils::getUserWithRole('executor');

        $loginRequest = [
            'login' => $user->login,
            'password' => 'password'
        ];

        $loginCookie = $this->postJson('/api/auth/login', $loginRequest)
            ->getCookie(config('session.cookie'));

        // Act
        $response = $this->withCookie(config('session.cookie'), $loginCookie->getValue())
            ->postJson('/api/auth/logout');

        // Assert
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
