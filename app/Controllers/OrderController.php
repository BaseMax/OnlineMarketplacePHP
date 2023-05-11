<?php

namespace App\Controllers;

use App\Facades\Response;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return Response::json(Order::all());
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
