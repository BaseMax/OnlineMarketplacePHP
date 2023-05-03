<?php

namespace App\Facades;

class Request extends Facade
{
    public static function method(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public static function path(): string
    {
        $path = $_SERVER["REQUEST_URI"] ?? false;
        $position = strpos($path, "?");

        if (!$position) return $path;
        else return substr($path, 0, $position);
    }
}
