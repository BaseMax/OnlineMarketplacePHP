<?php

namespace App\Models;

use App\Database\Order as DatabaseOrder;
use App\Exceptions\OrderException;
use App\Facades\Response;

class Order extends Model
{
    public int $id;
    public string $title;
    public string $description;
    public float $price;
    public int $category_id;
    public int $seller_id;
    public string|null $created_at;
    public string|null $updated_at;

    public function __construct()
    {
        parent::__construct();

        $this->created_at = date('Y-m-d H:i:s', time());
        $this->updated_at = date('Y-m-d H:i:s', time());
    }

    public static function all(): array
    {
        return DatabaseOrder::all();
    }

    public static function find(int $id): array|bool
    {
        $order = DatabaseOrder::find($id);

        if (!$order) return false;

        return $order;
    }

    public static function create(array $data): string
    {
        $order = DatabaseOrder::create($data);

        return Response::json($order);
    }

    public static function destroy(int $id): string
    {
        return DatabaseOrder::destroy($id);
    }

    public static function update(int $id, array $data): array
    {
        $product = Product::find($id);

        if (!$product) {
            return OrderException::error("product not found", 404);
        }
        return DatabaseOrder::update($id, $data);
    }
}
