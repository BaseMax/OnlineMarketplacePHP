<?php

namespace App\Database;

use App\Exceptions\OrderException;
use Exception;
use PDO;

class Order extends Database
{
    protected static string $get_all = "SELECT * FROM orders;";

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
}
