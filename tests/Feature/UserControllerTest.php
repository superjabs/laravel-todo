<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('login');
    }

    public function testLoginPageForMemberOnly()
    {
        $this->withSession([
            'user' => 'alfian'
        ])->get('/login')
        ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'alfian',
            'password' => 'rahasia'
        ])->assertRedirect('/')->assertSessionHas('user', 'alfian');
    }

    public function testLoginForMemberAlreadyLogin()
    {
        $this->withSession([
            'user' => 'alfian'
        ])->post('/login', [
            'user' => 'alfian',
            'password' => 'rahasia'
        ])->assertRedirect('/');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('user or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])->assertSeeText('user or password is wrong');
    }

    public function testLogout()
    {
        $this->withSession([
            'user' => 'alfian'
        ])->post('/logout')
        ->assertRedirect('/')
        ->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }

}
