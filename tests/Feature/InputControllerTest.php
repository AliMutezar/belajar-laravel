<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
   
    public function testRequestInput()
    {

        // Query parameter dengan method get
        $this->get('/input/hello?name=Ali')
            ->assertSeeText("Hello Ali");
        
        
        // Request Body dengan method post
        $this->post('/input/hello', [
            'name' => 'Ali'
        ])->assertSeeText("Hello Ali");
    }


    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Ali',
            ]
        ])->assertSeeText("Hello Ali");
    }


    // Bisa di cobain di postman
    public function testInputAll()
    {
        $this->post('/input/hello/inputAll', [
            'name' => [
                'first' => 'Ahmad Ali',
                'last' => 'Mutezar'
            ]
        ])->assertSeeText("name")
                ->assertSeeText("first")->assertSeeText("Ahmad Ali")
                ->assertSeeText("last")->assertSeeText("Mutezar");
    }


    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name"  =>  "Mac Book Pro M2",
                    "price" =>  25000000
                ],
                [
                    "name"  =>  "Hp Pavilion 13",
                    "price" =>  14000000
                ]
            ]
        ])->assertSeeText("Mac Book Pro M2")->assertSeeText("Hp Pavilion 13");
    }
}
