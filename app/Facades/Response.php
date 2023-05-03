<?php

namespace App\Facades;

class Response extends Facade
{
    public static function statusCode(int $statusCode = 200): void
    {
        http_response_code($statusCode);
    }

    public static function json(array $data): string
    {
        header("Content-Type: application/json");

        return json_encode($data);
    }
}
