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
