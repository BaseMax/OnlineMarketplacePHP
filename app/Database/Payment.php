<?php

namespace App\Database;

use App\Exceptions\PaymentException;
use Exception;
use PDO;

class Payment extends Database
{
    protected static string $insert_payment = "INSERT INTO payments ({columns}) VALUES ({values});";
    protected static string $get_by_id = "SELECT * FROM payments WHERE `id` = {id};";
    protected static string $update = "UPDATE payments SET `status` = {status} WHERE `transaction_id` = {id};";


    public function __construct()
    {
        parent::__construct();
    }

    public static function create(array $payment_data): array
    {
        new self;
        unset($data["id"]);
        $sql = self::$insert_payment;
        $sql = self::setColumns($sql, array_keys($payment_data));
        $sql = self::setValues($sql, array_values($payment_data));

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            return PaymentException::error($e->getMessage());
        }

        return self::get_by_id(self::$db->lastInsertId());
    }

    protected static function get_by_id(int $id): array
    {
        $sql = self::$get_by_id;
        $sql = self::setId($sql, $id);

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            PaymentException::error($e->getMessage());
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update_success(string $trans_id): bool
    {
        return self::update($trans_id, "completed");
    }

    public static function update_failed(string $trans_id): bool
    {
        return self::update($trans_id, "failed");
    }

    private static function update(string $trans_id, string $status): bool
    {
        new self;

        $sql = self::$update;
        $sql = self::setId($sql, $trans_id);
        $sql = self::setStatus($sql, $status);

        try {
            $stmt = self::$db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            PaymentException::error($e->getMessage());
        }

        return true;
    }

    private static function setStatus(string $sql, string $status): string
    {
        return str_replace("{status}", $status, $sql);
    }
}
