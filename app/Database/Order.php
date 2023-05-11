<?php

namespace App\Database;

use App\Exceptions\OrderException;
use Exception;
use PDO;

class Order extends Database
{
    protected static string $get_all = "SELECT * FROM orders;";
    protected static string $get_by_id = "SELECT * FROM orders WHERE `id` = {id};";

    public function __construct()
    {
        parent::__construct();
    }

    public static function all(): array
    {
        new self;

        $sql = self::$get_all;

        $stmt = self::$db->prepare($sql);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            OrderException::error($e->getMessage());
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        new self;

        $sql = self::setId(self::$get_by_id, $id);

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return OrderException::error($e->getMessage());
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
