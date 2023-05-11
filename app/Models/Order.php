<?php

namespace App\Models;

use App\Database\Order as DatabaseOrder;

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
}
