<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {

        $fileSystem = Storage::disk('local');
        $fileSystem->put("file.txt", "Ahmad Ali Mutezar");
        $content = $fileSystem->get("file.txt");

        self::assertEquals("Ahmad Ali Mutezar", $content);
    }


    public function testSPublic()
    {

        $fileSystem = Storage::disk('public');
        $fileSystem->put("file.txt", "Ahmad Ali Mutezar");
        $content = $fileSystem->get("file.txt");

        self::assertEquals("Ahmad Ali Mutezar", $content);
    }
}
