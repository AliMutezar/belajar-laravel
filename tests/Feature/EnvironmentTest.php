<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtube = env("YOUTUBE");

        self::assertEquals("Programmer Zaman Now", $youtube);
    }

    public function testDefault()
    {
        // bisa pake begini tapi harus use support\env
        // $author = Env::get('AUTHOR', 'Ali');

        $author = env("AUTHOR", "Ali");
        self::assertEquals("Ali", $author);
    }
}
