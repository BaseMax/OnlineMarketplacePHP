<?php

namespace App\Controllers;

use App\Exceptions\UserException;
use App\Facades\Hash;
use App\Facades\JWT;
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

        return Response::json([
            "JWT_token" => JWT::encode([
                "email" => $data["email"],
                "password" => Hash::hash($data["password"])
            ])
        ]);
    }

    public function register()
    {
        $data = Request::post();

        $validation = (new Validator())->make($data, [
            "name" => "required|max:255",
            "email" => "required|max:255",
            "password" => "required",
            "role" => "required"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            UserException::error("something went wrong", 403);
        }

        return User::create($data);
    }
}
