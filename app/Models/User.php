<?php

namespace App\Models;

use DateTime;

class User extends Model
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $remember_token;
    public string $role;
    public DateTime $created_at;
    public DateTime $updated_at;
}
