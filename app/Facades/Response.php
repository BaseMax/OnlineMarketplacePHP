<?php

namespace App\Facades;

class Response extends Facade
{
    public static function statusCode(int $statusCode = 200): void
    {
        http_response_code($statusCode);
    }

    public static function json(array $data, int $status = 200): string
    {
        self::statusCode($status);
        header("Content-Type: application/json");

        return json_encode($data);
    }

    public static function notFound(): string
    {
        self::statusCode(404);

        return self::json([
            "detail" => "not found"
        ]);
    }

    public static function success(string $detail = "success"): string
    {
        return Response::json([
            "detail" => $detail
        ]);
    }
}
