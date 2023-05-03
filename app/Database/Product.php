<?php

namespace App\Database;

use PDO;

class Product extends Database
{
    protected static string $get_all = "SELECT * FROM {table};";
    protected static string $get_by_id = "SELECT * FROM {table} WHERE id = {id};";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $sql = self::$get_all;

        $stmt = self::$db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id()
    {
    }
}
