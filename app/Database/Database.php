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

    protected static function setColumns(string $sql, array $columns): string
    {
        $implode = '`' . implode('`, `', $columns) . '`';

        return str_replace("{columns}", $implode, $sql);
    }

    protected static function setValues(string $sql, array $values): string
    {
        $implode = "'" . implode("', '", $values) . "'";

        return str_replace("{values}", $implode, $sql);
    }

    protected static function setId(string $sql, int|string $id): string
    {
        return str_replace("{id}", $id, $sql);
    }


    protected static function setParams(string $sql, array $data): string
    {
        $update_values = '';

        foreach ($data as $key => $value)
            $update_values .= "$key='$value', ";

        $update_values = rtrim($update_values, ', ');

        return str_replace("{sets}", $update_values, $sql);
    }
}
