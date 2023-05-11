<?php

namespace App\Exceptions;

use App\Facades\Response;
use Exception as MainException;

class Exception extends MainException
{
    public static function error(string $error = "error in server", int $status = 500): void
    {
        Response::statusCode($status);
        echo Response::json([
            "detail" => $error
        ]);
        exit;
    }
}
