<?php

namespace App\Models;

use App\Database\Payment as DatabasePayment;
use DateTime;

class Payment extends Model
{
    public int $id;
    public int $order_id;
    public float $amount;
    public string $status;
    public string $payment_gateway;
    public int $transaction_id;
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
        parent::__construct();

        $this->created_at = date('Y-m-d H:i:s', time());
        $this->updated_at = date('Y-m-d H:i:s', time());
    }

    public static function create(array $data): array
    {
        $instance = new self;
        $data["created_at"] = $instance->created_at;
        $data["updated_at"] = $instance->updated_at;
        return DatabasePayment::create($data);
    }
}
