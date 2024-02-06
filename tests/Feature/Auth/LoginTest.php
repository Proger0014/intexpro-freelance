<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Tests\Utils\UserUtils;
use App\Constants\Errors\AuthErrorConstants;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use App\Constants\Errors\ValidationErrorConstants;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $expectedResponse = [
            'authenticatedUserId' => $user->id
        ];

        // Act
        $response = $this->postJson('/api/auth/login', $loginRequest);

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($expectedResponse);
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
            'type' => ValidationErrorConstants::TYPE,
            'title' => ValidationErrorConstants::TITLE,
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

    /**
     * @test
     */
    public function login_validRequestWithInvalidCredentials_shouldReturnInvalidLoginOrPasswordErrorAnd400Status(): void {
        // Arrange
        $loginRequest = [
            'login' => 'login_invalid_credential',
            'password' => 'password_invalid_credential'
        ];

        $expectedError = [
            'type' => AuthErrorConstants::TYPE_INVALID_LOGIN_OR_PASSWORD,
            'title' => AuthErrorConstants::TITLE_INVALID_LOGIN_OR_PASSWORD,
            'status' => Response::HTTP_BAD_REQUEST,
            'detail' => AuthErrorConstants::DETAIL_INVALID_LOGIN_OR_PASSWORD
        ];

        // Act
        $response = $this->postJson('/api/auth/login', $loginRequest);

        // Assert
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertCookie(config('session.cookie'));
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->whereAll($expectedError));
    }
}
