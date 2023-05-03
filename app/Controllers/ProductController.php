<?php

namespace App\Controllers;

use App\Facades\Hash;
use App\Facades\JWT;
use App\Facades\Response;
use App\Models\Product;

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
