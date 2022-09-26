<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testCurrentURL()
    {
        $this->get('/url/current?name=Ali')
            ->assertSeeText("url/current?name=Ali");
    }

    public function testNamedURL()
    {
        $this->get('/redirect/named')
            ->assertSeeText("/redirect/name/Ali");
    }

    public function testActionURL()
    {
        $this->get('/url/action')
            ->assertSeeText("/form");
    }
}
