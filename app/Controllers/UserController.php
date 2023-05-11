<?php

namespace App\Controllers;

use App\Facades\Request;
use App\Facades\Response;
use App\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    public function index()
    {
        return Response::json(User::all());
    }

    public function show(int $id)
    {
        $user = User::find($id);

        if ($user) {
            return $user;
        }
        return Response::notFound();
    }

    public function update(int $id)
    {
        $data = Request::post();

        $validation = (new Validator())->make($data, [
            "name" => "max:255",
            "email" => "email|max:255",
            "password" => "max:255",
        ]);

        $validation->validate();

        $updatedUser = User::update($id, $data);
        return $updatedUser;
    }

    public function destroy(int $id)
    {
        return User::destroy($id);
    }
}
