<?php

namespace App\Facades;

class Helper extends Facade
{
    public static function escape(string $path): string
    {
        $escapedPath = preg_quote($path, '/');

        return str_replace("\{id\}", "([^\/]+)", $escapedPath);
    }

    public static function check(string $path, string $uri): bool|int
    {
        $escapedPath = preg_quote($path, '/');

        $newPath = str_replace("\{id\}", "([^\/]+)", $escapedPath);

        preg_match('/^' . $newPath . '$/', $uri, $matches);

        if (count($matches) === 0) return false;
        else if ($matches[1]) return $matches[1];
        else return false;
    }

    public static function match(string $path, string $route): ?string
    {
        preg_match('/^' . $route . '$/', $path, $matches);

        if (count($matches) === 0) return null;
        else if (isset($matches[1])) return $matches[1];
        else return $matches[0];
    }
}
