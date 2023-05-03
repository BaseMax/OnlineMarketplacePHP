<?php

namespace App\Controllers;

use App\Facades\Hash;
use App\Facades\JWT;
use App\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        $jwt = Response::json([
            JWT::encode([
                "name"   => "ali",
                "family" => "ahmadi",
                "age"    => 20
            ])
        ]);


        return Response::json(JWT::decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoiYWxpIiwiZmFtaWx5IjoiYWhtYWRpIiwiYWdlIjoyMH0.9mmNMJDM821fqZi4Nm4ODDZIdr080DIcPU0mH5N78ug'));
    }

    public function show()
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
