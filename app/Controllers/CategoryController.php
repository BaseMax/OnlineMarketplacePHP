<?php

namespace App\Controllers;

use App\Facades\Response;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Response::json(Category::all());
    }

    public function show(int $id)
    {
        $category = Category::find($id);

        if ($category) {
            return $category;
        }
        return Response::notFound();
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
