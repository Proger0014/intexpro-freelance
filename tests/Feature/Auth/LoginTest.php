<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Utils\UserUtils;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function login_validRequest_shouldReturn204(): void
    {
        // Arrange
        $user = UserUtils::getUserWithRole('executor');
        $loginRequest = [
            'login' => $user->login,
            'password' => 'password'
        ];

        // Act
        $response = $this->postJson('/api/auth/login', $loginRequest);

        // Assert
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $response->assertCookie(config('session.cookie'));
    }
}
