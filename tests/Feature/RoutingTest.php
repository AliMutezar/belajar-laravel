<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{


    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText("Belajar Laravel di Programmer Zaman Now");
    }


    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }


    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText("404 by Programmer Zaman Now");

        $this->get('/nggaadalagi')
            ->assertSeeText("404 by Programmer Zaman Now");
    }


    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText("Product 1");
        $this->get('/products/2')
            ->assertSeeText("Product 2");

        $this->get('/products/2/items/XXX')
            ->assertSeeText("Product 2, Item XXX");
    }

    public function testRouteRegex()
    {
        $this->get('/categories/100')
            ->assertSeeText("Category 100");
        
        $this->get('/categories/bukanAngka')
            ->assertSeeText("404 by Programmer Zaman Now");
    }

    public function testRouteOptional()
    {
        $this->get('/users/14')
            ->assertSeeText("User 14");
        
        $this->get('/users/')
            ->assertSeeText("User 404");
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/mutezar')
            ->assertSeeText("Conflict mutezar");
        
        // ini akan error, karena posisi route-nya ada di no.2, kalo mau success harus di tempatkan di nomor 1
        $this->get('/conflict/ali')
            ->assertSeeText("Conflict Ahmad Ali Mutezar");
    }
}
