<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName, $firstName2);
        // var_dump(Config::all());
    }
    
    // Sebenernya facades itu manggil dependency dari service container
    public function testConfigDepedency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');
        $firstName = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName, $firstName2);
        self::assertEquals($firstName, $firstName3);

        var_dump($config->all());
    }


    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Ali Keren');

        $firstName = Config::get('contoh.author.first');
        self::assertEquals("Ali Keren", $firstName);
    }
}
