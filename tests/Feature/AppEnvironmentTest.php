<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    public function testAppEnv() 
    {
        // Check environment
        // var_dump(App::environment()); 

        if(App::environment(['prod', 'local','testing'])) {
            self::assertTrue(true);
        }
    }
}
