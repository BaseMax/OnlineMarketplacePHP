<?php

namespace App\Controllers;

use App\Exceptions\CategoryException;
use App\Facades\Request;
use App\Facades\Response;
use App\Models\Category;
use Rakit\Validation\Validator;

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
        $data = Request::post();
        $validation = (new Validator())->make($data, [
            "name" => "required|max:255",
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return CategoryException::error("name of category is required", 403);
        }

        $category = new Category();

        $category->name = $data["name"];

        $category->save();

        return Response::json([
            "detail" => "success"
        ]);
    }

    public function update(int $id)
    {
        $data = Request::update();

        $validation = (new Validator())->make($data, [
            "name" => "max:255",
        ]);

        $validation->validate();

        $updatedCategory = Category::update($id, $data);
        return $updatedCategory;
    }

    public function destroy(int $id)
    {
        return Category::destroy($id);
    }
}
