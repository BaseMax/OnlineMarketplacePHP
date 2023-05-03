<?php

namespace App\Facades;

class Response extends Facade
{
    public static function statusCode(int $statusCode): void
    {
        http_response_code($statusCode);
    }
}
