<?php

namespace Core\Middleware;

class Authenticated
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve($key)
    {
        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("no matching middleware found for key {$key}");
        }

        (new $middleware)->handle();
    }
}
