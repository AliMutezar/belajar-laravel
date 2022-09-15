<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Ahmad Ali Mutezar');

        $this->get('/hello-again')
            ->assertSeeText('Hello Sahira Salsabila');
    }


    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText("This is my world Fulan bin Fulan");
    }


    // kita bisa test template tanpa menggunakan routing
    public function testTemplateWithoutRoute()
    {
        $this->view('hello', ['nama' => 'Fulanah bin Fulan'])
            ->assertSeeText('Hello Fulanah bin Fulan');

        $this->view('hello.world', ['nama' => 'Mukmin'])
            ->assertSeeText('This is my world Mukmin');
    }
}
