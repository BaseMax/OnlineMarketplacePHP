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

    public function show()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
