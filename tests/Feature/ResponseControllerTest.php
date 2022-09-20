<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
   
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }


    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Ahmad Ali')->assertSeeText('Mutezar')
            ->assertHeader("content-type", "application/json")
            ->assertHeader("author", "Programmer Zaman Now")
            ->assertHeader("App", "Belajar Laravel");
    }


    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("hello Ahmad Ali Mutezar");
    }


    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => 'Ahmad Ali',
                'lastName'  => 'Mutezar'
            ]);
    }

    
    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }


    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload("Ahmad Ali.png");
    }
}
