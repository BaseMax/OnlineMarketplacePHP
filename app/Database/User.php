<?php

namespace App\Database;

use App\Exceptions\UserException;
use Exception;
use PDO;

class User extends Database
{
    protected static string $get_all_users = "SELECT * FROM users;";

    public function __construct()
    {
        parent::__construct();
    }

    public static function all(): array|bool
    {
        new self;

        $sql = self::$get_all_users;

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return UserException::error($e->getMessage());
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
