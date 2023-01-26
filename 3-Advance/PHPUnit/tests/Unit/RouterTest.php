<?php

declare(strict_types = 1);

namespace Tests\Unit;


use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{


    /** @test */
    public function it_registers_a_route(): void
    {
        // Givin that we are a router object
        $router = new Router();

        // When we call a register method
        $router->register('get','/users',['Users', 'index']);

        $expected =[
            'get' => [
                '/users' => ['Users', 'index'],
            ],
        ];

        // then we assert route was registered
        $this->assertEquals($expected, $router->routes());
    }
}