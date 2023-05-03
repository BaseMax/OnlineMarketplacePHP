<?php

namespace App\Models;

use DateTime;

class Category extends Model
{
    public int $id;
    public string $name;
    public DateTime $created_at;
    public DateTime $updated_at;
}
