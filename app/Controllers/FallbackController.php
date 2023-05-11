<?php

namespace App\Controllers;

use App\Facades\Response;

class FallbackController extends Controller
{
    public function fallback()
    {
        return Response::json([
            "detail" => "route not found"
        ]);
    }
}
