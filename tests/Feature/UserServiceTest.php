<?php

namespace Tests\Feature;

use App\Providers\UserServiceProvider;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login('alfian', 'rahasia'));
    }

    public function testUserNotFound()
    {
        self::assertFalse($this->userService->login('al', 'rahasia'));
    }

    public function testWrongPassword()
    {
        self::assertFalse($this->userService->login('alfian', 'alfian123'));
    }

}
