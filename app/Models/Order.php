<?php

namespace App\Models;

use DateTime;

class Order extends Model
{
    public int $id;
    public string $title;
    public string $description;
    public float $price;
    public int $category_id;
    public int $seller_id;
    public DateTime $created_at;
    public DateTime $updated_at;
}
