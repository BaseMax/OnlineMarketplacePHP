<?php

namespace App\Controllers;

use App\Exceptions\UserException;
use App\Facades\Request;
use App\Facades\Response;
use App\Models\User;
use Rakit\Validation\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $data = Request::post();

        $validation = (new Validator())->make($data, [
            "email" => "required|max:255",
            "password" => "required"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return UserException::error("email and password required", 403);
        }

        if (!User::check($data["email"], $data["password"])) {
            return Response::json([
                "detail" => "login unsuccessful"
            ], 403);
        }
    }

    public function register()
    {
    }
}
