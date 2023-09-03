<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Psy\TabCompletion\Matcher\FunctionsMatcher;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo(): void
    {
        $this->todolistService->saveTodo("1", "alfian"); 

        $todolist = Session::get("todolist");
        foreach($todolist as $value){
            self::assertEquals("1", $value['id']);
            self::assertEquals("alfian", $value['todo']);
        }
    }

    public function testGetTodoListNotEmpty() 
    {
        $expected = [
            [
                "id" => "2",
                "todo" => "al"
            ],
            [
                "id" => "3",
                "todo" => "fian"
            ]
        ];

            $this->todolistService->saveTodo("2", "al");
            $this->todolistService->saveTodo("3", "fian");

            self::assertEquals($expected, $this->todolistService->getTodoList());
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "alfian");
        $this->todolistService->saveTodo("2", "budi");

        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("3");
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("1");
        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("2");
        self::assertEquals(0, sizeof($this->todolistService->getTodoList()));
    }

}