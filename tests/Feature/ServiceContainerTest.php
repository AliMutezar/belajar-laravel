<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    public function testDepedency()
    {
        // Cara manual
        // $foo = new Foo();

        // Menggunakan service container laravel 
        $foo = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo, $foo2);

    }

    public function testBind()
    {
        
        // Kalo pake cara biasa error BindingResolutionException
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        
        // pake bind method kalo semisal di construct memiliki parameter
        $this->app->bind(Person::class, function($app) {
            return new Person('Ali', 'Mutezar');
        });


        // Seakan - akan function closure dia memanggil new Person('Ali', 'Mutezar')
        $person = $this->app->make(Person::class); // closure()
        $person2 = $this->app->make(Person::class); // closure()

        self::assertEquals('Ali', $person->firstName);
        self::assertEquals('Mutezar', $person2->lastName);
        self::assertNotSame($person, $person2);
    }


    // Disarankan pake singleton karena tidak membuat object baru dan tidak memakan memory
    public function testSingleton()
    {
        $this->app->singleton(Person::class, function($app) {
            return new Person('Ali', 'Mutezar');
        });
        
        $person = $this->app->make(Person::class); //  new Person("Ali", "Mutezar"); if not exist 
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('Ali', $person->firstName);
        self::assertEquals('Mutezar', $person2->lastName);
        self::assertSame($person, $person2);
    }

    public function testIntance()
    {
        $person = new Person("Ali", "Mutezar");
        $this->app->instance(Person::class, $person);
        
        $person1 = $this->app->make(Person::class); // person
        $person2 = $this->app->make(Person::class); // person

        self::assertEquals('Ali', $person->firstName);
        self::assertEquals('Mutezar', $person2->lastName);
        self::assertSame($person, $person2);
    }

    public function testDepedencyInjection()
    {

        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app) {
            $foo = $this->app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
        self::assertSame($bar, $bar2);


        // $foo = $this->app->make(Foo::class);
        // $bar = $this->app->make(Bar::class); // ketika bikin bar, secara otomatis constructor di dalamnya akan di inject sebagai object baru oleh laravel

        // self::assertNotSame($foo, $bar->foo);

    }

    public function testInterfaceToClass()
    {
        // singleton(interface, class)

        // bisa pake class seperti ini
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // atau juga bisa pake function closure jika object-nya komplek
        $this->app->singleton(HelloService::class, function($app) {
            return new HelloServiceIndonesia();
        });


        $helloService = $this->app->make(HelloService::class);
        self::assertEquals('Halo Ali', $helloService->hello('Ali'));
    }
}
