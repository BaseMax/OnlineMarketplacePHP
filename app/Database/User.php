<?php

namespace App\Database;

use App\Exceptions\UserException;
use App\Facades\Response;
use Exception;
use PDO;

class User extends Database
{
    protected static string $get_all_users = "SELECT * FROM users;";
    protected static string $get_by_id = "SELECT * FROM users WHERE `id` = {id};";
    protected static string $delete_user = "DELETE FROM users WHERE `id` = {id};";
    protected static string $update_user = "UPDATE users SET {sets} WHERE `id` = {id};";



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

    public function get_by_id(int $id): array|bool
    {
        $sql = self::setId(self::$get_by_id, $id);

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return UserException::error($e->getMessage());
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete(int $id): string
    {
        new self;
        $sql = self::$delete_user;
        $sql = self::setId($sql, $id);

        $stmt = self::$db->prepare($sql);

        try {
            if ($stmt->execute()) return Response::success("product deleted successfuly");
        } catch (Exception $e) {
            return UserException::error($e->getMessage());
        }
    }

    public static function update(int $id, array $data): array|bool
    {
        new self;

        $sql = self::setId(self::$update_user, $id);
        $sql = self::setParams($sql, $data);


        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return UserException::error($e->getMessage());
        }

        return self::get_by_id($id);
    }
}
