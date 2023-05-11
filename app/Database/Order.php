<?php

namespace App\Database;

use App\Exceptions\OrderException;
use App\Facades\Response;
use Exception;
use PDO;

class Order extends Database
{
    protected static string $get_all = "SELECT * FROM orders;";
    protected static string $get_by_id = "SELECT * FROM orders WHERE `id` = {id};";
    protected static string $create_order =  "INSERT INTO orders ({columns}) VALUES ({values});";
    protected static string $delete_order = "DELETE FROM orders WHERE `id` = {id};";
    protected static string $update_order = "UPDATE orders SET {sets} WHERE `id` = {id};";

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

    public static function create(array $data): array
    {
        new self;

        unset($data["id"]);
        $sql = self::$create_order;
        $sql = self::setColumns($sql, array_keys($data));
        $sql = self::setValues($sql, array_values($data));

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return OrderException::error($e->getMessage());
        }

        return self::find(self::$db->lastInsertId());
    }

    public static function destroy(int $id): string
    {
        new self;

        $sql = self::setId(self::$delete_order, $id);

        $stmt = self::$db->prepare($sql);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            OrderException::error($e->getMessage());
        }

        return Response::json([
            "detail" => "order deleted successfuly"
        ]);
    }

    public static function update(int $id, array $data): array
    {
        new self;


        unset($data["id"]);
        $sql = self::setId(self::$update_order, $id);
        $sql = self::setParams($sql, $data);


        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return OrderException::error($e->getMessage());
        }

        return self::find($id);
    }
}
