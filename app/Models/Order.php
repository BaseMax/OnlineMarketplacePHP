<?php

namespace App\Models;

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
}
