<?php

namespace App\Controllers;

use App\Exceptions\PaymentException;
use App\Facades\Config;
use App\Facades\Helper;
use App\Facades\Request;
use App\Facades\Response;
use App\Models\Payment;
use CurlHandle;
use Rakit\Validation\Validator;

class PaymentController extends Controller
{
    protected static string $PENDING = "pending";
    protected static string $COMPLETED = "completed";
    protected static string $FAILED = "failed";
    protected static string $TOKEN = "https://nextpay.org/nx/gateway/token";
    protected static string $callback_uri = "http://localhost:5000/api/callback";
    protected static CurlHandle $curl;
    protected static string $payment_uri = "https://nextpay.org/nx/gateway/payment/";
    protected static string $verify = "https://nextpay.org/nx/gateway/verify";

    public function __construct()
    {
        parent::__construct();

        self::$curl = curl_init();
        self::set_headers();
    }

    public function pay()
    {
        $data = Request::post();

        $validation = (new Validator())->make($data, [
            "order_id" => "required|numeric",
            "amount"   => "required|numeric"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            PaymentException::error("order_id and amount is required", 403);
        }
        $response = $this->token_creator($data["order_id"], $data["amount"]);

        $response = Helper::decode($response);

        Payment::create([
            "order_id"        => $data["order_id"],
            "amount"          => $data["amount"],
            "status"          => "pending",
            "payment_gateway" => self::$payment_uri . $response["trans_id"],
            "transaction_id"  => $response["trans_id"],
        ]);

        return Response::json([
            "payment_uri" => self::$payment_uri . $response["trans_id"],
            "trans_id"    => $response["trans_id"]
        ]);
    }

    protected function token_creator(int $order_id, int $amount)
    {
        $data = [
            "order_id"     => $order_id,
            "amount"       => $amount,
            "api_key"      => Config::api_key(),
            "callback_uri" => self::$callback_uri
        ];

        self::set_postFields($data);

        $response = curl_exec(self::$curl);

        return $response;
    }

    protected static function set_headers(): void
    {
        curl_setopt_array(self::$curl, [
            CURLOPT_URL             => self::$TOKEN,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => '',
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_CUSTOMREQUEST   => 'POST',
        ]);
    }

    protected static function set_postFields(array $data): void
    {
        $urlEncoded_data = Helper::urlEncode_format($data);

        curl_setopt_array(self::$curl, [
            CURLOPT_POSTFIELDS => $urlEncoded_data
        ]);
    }

    public function complete()
    {
        $data = Request::get();

        if ($this->verify($data["trans_id"], $data["amount"])) {
            return Payment::update_success($data["trans_id"]);
        } else {
            return Payment::update_failed($data["trans_id"]);
        }
    }

    protected function verify(string $trans_id, int $amount): bool
    {
        $data = [
            "trans_id" => $trans_id,
            "amount"   => $amount,
            "apy_key"  => Config::api_key()
        ];

        self::set_postFields($data);

        $response = Helper::decode(curl_exec(self::$curl));

        if ($response["code"] === 0) return true;
        return false;
    }
}
