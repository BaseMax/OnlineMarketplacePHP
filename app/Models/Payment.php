<?php

namespace App\Models;

use DateTime;

class Payment extends Model
{
    public int $id;
    public int $order_id;
    public float $amount;
    public string $status;
    public string $payment_gateway;
    public int $transaction_id;
    public DateTime $created_at;
    public DateTime $updated_at;
}
