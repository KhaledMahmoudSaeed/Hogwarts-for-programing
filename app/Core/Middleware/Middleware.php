<?php

namespace App\Core\Middleware;

use App\Core\Middleware\Auth\Guest;
use App\Core\Middleware\Auth\Authenticated;
use App\Core\Middleware\Auth\Headmaster;
use App\Core\Middleware\Auth\Professor;

class Middleware
{
    // map all exists middlewares to its classes using resolve method
    private const MIDDLEWARE_CLASSES = [
        'guest' => Guest::class,
        'auth' => Authenticated::class,
        'professor' => Professor::class,
        'headmaster' => Headmaster::class,
    ];

    public function resolve($key, $uri)
    {
        $middleware = static::MIDDLEWARE_CLASSES[$key];

        return (new $middleware)->handle($uri);
    }
}