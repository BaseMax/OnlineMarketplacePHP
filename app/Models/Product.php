<?php

namespace App\Models;

use App\Database\Product as DatabaseProduct;
use App\Facades\Response;
use Exception;

class Product extends Model
{
    public int $id;
    public string $title;
    public string $description;
    public float $price;
    public int $category_id;
    public int $seller_id;
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
        parent::__construct();

        $this->created_at = date('Y-m-d H:i:s', time());
        $this->updated_at = date('Y-m-d H:i:s', time());
    }

    public static function find(int $id): Product|bool
    {
        $product = self::_find($id);

        if ($product) {
            $product = (new Product())->load($product);
            return $product;
        }
        return false;
    }

    private static function _find(int $id): array|bool
    {
        $product = (new DatabaseProduct())->get_by_id($id);

        return $product;
    }

    private function load(array $product): Product
    {
        foreach ($product as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public static function findOrFail(int $id): ?Product
    {
        try {
            $product = self::find($id);
            return $product;
        } catch (Exception $e) {
            exit;
        }
    }

    public static function all(): array
    {
        $databaseProduct = new DatabaseProduct();

        return $databaseProduct->get_all();
    }

    public function toString(): array
    {
        return [
            "id"          => $this->id ?? 0,
            "title"       => $this->title,
            "description" => $this->description,
            "price"       => $this->price,
            "category_id" => $this->category_id,
            "seller_id"   => $this->seller_id,
            "created_at"  => $this->created_at,
            "updated_at"  => $this->updated_at
        ];
    }

    public function save(): string
    {
        $product = $this->toString();
        return DatabaseProduct::create($product);
    }

    public function __toString()
    {
        return Response::json($this->toString());
    }

    public static function destroy(int $id): string
    {
        return DatabaseProduct::Delete($id);
    }
}
