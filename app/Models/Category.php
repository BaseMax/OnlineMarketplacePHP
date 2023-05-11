<?php

namespace App\Models;

use App\Database\Category as DatabaseCategory;

class Category extends Model
{
    public int $id;
    public string $name;
    public string|null $created_at;
    public string|null $updated_at;

    public static function all(): array
    {
        return DatabaseCategory::all();
    }
}
