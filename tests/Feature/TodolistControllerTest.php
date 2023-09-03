<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'alfian',
            'todolist' => [
                'id' => '1',
                'todo' => 'alfian'
            ]
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('alfian');
    }

    public function testSaveTodoFailed()
    {
        $this->withSession([
            'user' => 'alfian',
            'todo' => []
        ])->post('/todolist')->assertSeeText('Todo is required');
    }

    public function testSaveTodoSuccess()
    {
        $this->withSession([
            'user' => 'alfian'
        ])->post('/todolist', [
            'todo' => 'alfian'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "alfian",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "al"
                ],
                [
                    "id" => "2",
                    "todo" => "fian"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
