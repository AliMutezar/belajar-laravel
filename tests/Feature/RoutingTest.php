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
}
