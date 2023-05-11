<?php

namespace App\Controllers;

use App\Exceptions\OrderException;
use App\Facades\Request;
use App\Facades\Response;
use App\Models\Order;
use Rakit\Validation\Validator;

class OrderController extends Controller
{
    public function index()
    {
        return Response::json(Order::all());
    }

    public function show(int $id)
    {
        $order = Order::find($id);

        if (!$order) return Response::notFound();

        return $order;
    }

    public function store()
    {
        $data = Request::post();

        $validation = (new Validator())->make($data, [
            "buyer_id"    => "required|numeric",
            "product_id"  => "required|numberic",
            "quantity"    => "required|numeric",
            "amount"      => "required|numeric",
            "status"      => "required|in:pending,completed,cancelled",
        ]);

        $validation->validate();

        if ($validation->fails()) OrderException::error("data validation failed", 403);

        return Order::create($data);
    }

    public function update(int $id)
    {
        $data = Request::update();

        $validation = (new Validator())->make($data, [
            "quantity"  => "numeric",
            "amount"    => "numeric",
            "status"    => "in:pending,completed,cancelled"
        ]);


        $validation->validate();

        if ($validation->fails()) OrderException::error("data validation failed", 403);

        return Order::update($id, $data);
    }

    public function destroy(int $id)
    {
        return Order::destroy($id);
    }
}
