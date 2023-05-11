<?php

namespace App\Database;

use App\Exceptions\CategoryException;
use App\Facades\Response;
use Exception;
use PDO;

class Category extends Database
{
    protected static string $all_categories = "SELECT * FROM categories;";
    protected static string $get_by_id = "SELECT * FROM categories WHERE `id` = {id};";
    protected static string $delete_category = "DELETE FROM categories WHERE `id` = {id};";
    protected static string $create_category = "INSERT INTO category ({columns}) VALUES ({values});";

    public function __construct()
    {
        parent::__construct();
    }

    public static function all(): array|bool
    {
        new self;
        $sql = self::$all_categories;

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return CategoryException::error($e->getMessage());
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
            return CategoryException::error($e->getMessage());
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete(int $id): string
    {
        new self;
        $sql = self::$delete_category;
        $sql = self::setId($sql, $id);

        $stmt = self::$db->prepare($sql);

        try {
            if ($stmt->execute()) return Response::success("category deleted successfuly");
        } catch (Exception $e) {
            return CategoryException::error($e->getMessage());
        }
    }

    public static function create(array $data): string
    {
        new self;
        unset($data["id"]);
        $sql = self::$create_category;
        $sql = self::setColumns($sql, array_keys($data));
        $sql = self::setValues($sql, array_values($data));

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return CategoryException::error($e->getMessage());
        }

        return Response::success("category created successfuly");
    }
}
