<?php

namespace App\Exceptions;

use App\Facades\Response;

class ProductException extends Exception
{
    public static function error(string $error = "error in server"): void
    {
        Response::statusCode(500);
        echo Response::json([
            "detail" => $error
        ]);
        exit;
    }
}
