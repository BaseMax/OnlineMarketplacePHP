<?php

namespace App\Controllers;

use App\Facades\Response;
use App\Models\User;

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

    public function update()
    {
    }

    public function destroy()
    {
    }
}
