<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Utils\UserUtils;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function login_invalidRequestWithShortValues_shouldReturnValidationErrorAnd400Status(): void {
        // Arrange
        $loginRequest = [
            'login' => 'short',
            'password' => 'short'
        ];

        $expectedValidationErrorResponseWithoutErrorsField = [
            'type' => '/errors/validation',
            'title' => 'Ошибка валидации',
            'status' => Response::HTTP_BAD_REQUEST
        ];

        $expectedValidationErrors = [
            'login' => [
                'login должен быть не меньше 8 символов'
            ],
            'password' => [
                'password должен быть не меньше 8 символов'
            ]
        ];

        // Act
        $response = $this->postJson('/api/auth/login', $loginRequest);

        // Assert
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertCookie(config('session.cookie'));
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->whereAll($expectedValidationErrorResponseWithoutErrorsField)
                ->etc());
        $response->assertJsonValidationErrors($expectedValidationErrors);
    }
}
