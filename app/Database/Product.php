<?php

namespace App\Database;

use PDO;

class Product extends Database
{
    protected static string $get_all = "SELECT * FROM products;";
    protected static string $get_by_id = "SELECT * FROM products WHERE id = {id};";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all(): array
    {
        $sql = self::$get_all;

        $stmt = self::$db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id(int $id): array|bool
    {
        $sql = self::setId(self::$get_by_id, $id);

        $stmt = self::$db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function setId(string $sql, int $id): string
    {
        return str_replace("{id}", $id, $sql);
    }
}
