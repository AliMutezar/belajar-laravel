<?php

namespace App\Data;

class Bar
{
    // class bar memiliki depedencies ke class Foo (Bar depends-on Foo / Foo dependency untuk Bar)
    public Foo $foo;
    
    // __construct digunakan untuk melakukan dependency injection
    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function bar(): string
    {
        return $this->foo->foo() . ' and Bar';
    }
}