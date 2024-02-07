<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Tests\Utils\RoleUtils;
use Tests\Utils\UserUtils;
use Illuminate\Testing\TestResponse;
use App\Constants\Errors\AuthErrorConstants;
use Illuminate\Foundation\Testing\WithFaker;
use App\Constants\Errors\UsersErrorConstants;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Constants\Errors\CommonErrorConstants;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register_unauthenticatedUser_shouldReturnMessageUnauthenticatedAndStatus401(): void {
        // Arrange
        $registerRequest = [
            'login' => 'new_user@new',
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

    /**
     * @test
     */
    public function register_executorUser_shouldReturnMessageForbiddenAndStatus403(): void {
        // Arrange
        $executor = UserUtils::getUserWithRole('executor');

        $loginRequest = [
            'login' => $executor->login,
            'password' => 'password'
        ];

        /**
         * если будет ошибка валидации, значит, нужно фиксить routes/api middleware на register
         */
        $registerRequest = [
            'login' => 'new_user@new',
            'password' => 'password',
            'roles' => [0]
        ];

        $expectedError = [
            'message' => 'User does not have the right permissions.'
        ];

        $cookie = $this->postJson('/api/auth/login', $loginRequest)
            ->getCookie(config('session.cookie'));

        // Act
        $response = $this->withCookie(config('session.cookie'), $cookie->getValue())
            ->postJson('/api/auth/register', $registerRequest);

        // Assert
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->whereAll($expectedError)
                ->etc());
    }

    /**
     * @test
     */
    public function register_customerUser_shouldReturnStatus204(): void {
        // Arrange
        $customer = UserUtils::getUserWithRole('customer');
        $executorRoleId = RoleUtils::getRoleIdWithName('executor');

        $loginRequest = [
            'login' => $customer->login,
            'password' => 'password'
        ];

        $registerRequest = [
            'login' => 'new_user@new',
            'password' => 'password',
            'roles' => [
                $executorRoleId
            ]
        ];

        $cookie = $this->postJson('/api/auth/login', $loginRequest)
            ->getCookie(config('session.cookie'));

        // Act
        $response = $this->withCookie(config('session.cookie'), $cookie->getValue())
            ->postJson('/api/auth/register', $registerRequest);

        // Assert
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @test
     */
    public function register_customerUserDoubleSameUse_shouldReturnErrorExistsAndStatus400(): void {
        // Arrange
        $customer = UserUtils::getUserWithRole('customer');
        $executorRoleId = RoleUtils::getRoleIdWithName('executor');

        $loginRequest = [
            'login' => $customer->login,
            'password' => 'password'
        ];

        $registerRequest = [
            'login' => 'new_user@new',
            'password' => 'password',
            'roles' => [
                $executorRoleId
            ]
        ];

        $expectedError = [
            'type' => CommonErrorConstants::TYPE_EXISTS,
            'title' => UsersErrorConstants::TITLE_EXISTS,
            'status' => Response::HTTP_BAD_REQUEST,
            'detail' => UsersErrorConstants::DETAIL_EXISTS
        ];

        $cookie = $this->postJson('/api/auth/login', $loginRequest)
            ->getCookie(config('session.cookie'));

        $action = fn(): TestResponse => $this->withCookie(config('session.cookie'), $cookie->getValue())
            ->postJson('/api/auth/register', $registerRequest);

        // Act
        $action();
        $response = $action();

        // Assert
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson($expectedError);
    }

    /**
     * @test
     */
    public function register_customerUserCreateAdminRole_shouldReturnErrorForbiddenAndStatus403(): void {
        // Arrange
        $customer = UserUtils::getUserWithRole('customer');
        $adminRoleId = RoleUtils::getRoleIdWithName('admin');

        $loginRequest = [
            'login' => $customer->login,
            'password' => 'password'
        ];

        $registerRequest = [
            'login' => 'new_user@new',
            'password' => 'password',
            'roles' => [
                $adminRoleId
            ]
        ];

        $expectedError = [
            'type' => AuthErrorConstants::TYPE_FORBIDDEN,
            'title' => AuthErrorConstants::TITLE_FORBIDDEN,
            'status' => Response::HTTP_FORBIDDEN,
            'detail' => AuthErrorConstants::DETAIL_FORBIDDEN
        ];

        $cookie = $this->postJson('/api/auth/login', $loginRequest)
            ->getCookie(config('session.cookie'));

        // Act
        $response = $this->withCookie(config('session.cookie'), $cookie->getValue())
            ->postJson('/api/auth/register', $registerRequest);

        // Assert
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $response->assertJson($expectedError);
    }
}
