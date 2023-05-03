<?php

namespace App\Database;

use App\Facades\Config;
use PDO;

class Database
{
    protected static PDO $db;

    public function __construct()
    {
        $dsn = Config::dsn();
        $user = Config::user();
        $password = Config::password();

        self::$db = new PDO($dsn, $user, $password);
    }
}
