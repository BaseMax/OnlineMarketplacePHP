<?php

namespace App\Exceptions;

use App\Facades\Response;

class ProductException extends Exception
{
    public static function error_in_insert(string $error = "error in server"): string
    {
        Response::statusCode(500);
        echo Response::json([
            "detail" => $error
        ]);
        exit;
    }
}
