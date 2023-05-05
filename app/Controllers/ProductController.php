<?php

namespace App\Controllers;

use App\Facades\Hash;
use App\Facades\JWT;
use App\Facades\Response;
use App\Models\Product;
use DateTime;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::find(1);

        if ($product) {
            return $product;
        }

        return Response::notFound();
    }

    public function show()
    {
        $data = [
            "id"          => 2,
            "title"       => "this is title2 of product",
            "description" => "this is a full descriptive text2",
            "price"       => 29,
            "category_id" => 1,
            "seller_id"   => 1,
        ];

        $product = new Product();

        $product->id = $data["id"];
        $product->title = $data["title"];
        $product->description = $data["description"];
        $product->price = $data["price"];
        $product->category_id = $data["category_id"];
        $product->seller_id = $data["seller_id"];


        return $product->save();


        return Response::json($data);
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
