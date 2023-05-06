<?php

namespace App\Database;

use App\Exceptions\ProductException;
use App\Facades\Response;
use Exception;
use PDO;

class Product extends Database
{
    protected static string $get_all = "SELECT * FROM products;";
    protected static string $get_by_id = "SELECT * FROM products WHERE id = {id};";
    protected static string $create_product = "INSERT INTO products ({columns}) VALUES ({values});";
    protected static string $delete_product = "DELETE FROM products WHERE `id` = {id};";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all(): array
    {
        $sql = self::$get_all;

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return ProductException::error($e->getMessage());
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id(int $id): array|bool
    {
        $sql = self::setId(self::$get_by_id, $id);

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return ProductException::error($e->getMessage());
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function setId(string $sql, int $id): string
    {
        return str_replace("{id}", $id, $sql);
    }

    public static function create(array $data): string
    {
        new self;
        unset($data["id"]);
        $sql = self::$create_product;
        $sql = self::setColumns($sql, array_keys($data));
        $sql = self::setValues($sql, array_values($data));

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return ProductException::error($e->getMessage());
        }

        return Response::success("product created successfuly");
    }

    public static function delete(int $id): string
    {
        new self;
        $sql = self::$delete_product;
        $sql = self::setId($sql, $id);

        $stmt = self::$db->prepare($sql);

        try {
            if ($stmt->execute()) return Response::success("product deleted successfuly");
        } catch (Exception $e) {
            return ProductException::error($e->getMessage());
        }
    }
}
