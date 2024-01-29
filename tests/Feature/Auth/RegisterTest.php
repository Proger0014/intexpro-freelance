<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register_unauthenticatedUser_shouldReturnMessageUnauthenticatedAndStatus401(): void {
        // Arrange
        $registerRequest = [
            'login' => 'login_login',
            'password' => 'password_password'
        ];

        $expectedError = [
            'message' => 'Unauthenticated.'
        ];

        // Act
        $response = $this->postJson('/api/auth/register', $registerRequest);

        // Assert
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJson($expectedError);
    }
}
