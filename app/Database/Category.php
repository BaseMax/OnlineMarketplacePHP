<?php

namespace App\Database;

use App\Exceptions\CategoryException;
use Exception;
use PDO;

class Category extends Database
{
    protected static string $all_categories = "SELECT * FROM categories;";
    protected static string $get_by_id = "SELECT * FROM categories WHERE `id` = {id};";

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
}
