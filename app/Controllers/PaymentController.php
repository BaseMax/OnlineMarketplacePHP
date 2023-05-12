<?php

namespace App\Controllers;

use App\Exceptions\PaymentException;
use App\Facades\Config;
use App\Facades\Helper;
use App\Facades\Request;
use App\Facades\Response;
use CurlHandle;
use Rakit\Validation\Validator;

class PaymentController extends Controller
{
    protected static string $PENDING = "pending";
    protected static string $COMPLETED = "completed";
    protected static string $FAILED = "failed";
    protected static string $TOKEN = "https://nextpay.org/nx/gateway/token";
    protected static string $callback_uri = "http://localhost:5000/callback";
    protected static CurlHandle $curl;
    protected static string $payment_uri = "https://nextpay.org/nx/gateway/payment/";

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

        return Response::json([
            "payment_uri" => self::$payment_uri . $response["trans_id"],
            "trans_id" => $response["trans_id"]
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
            CURLOPT_URL => self::$TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ]);
    }

    protected static function set_postFields(array $data): void
    {
        $urlEncoded_data = Helper::urlEncode_format($data);

        curl_setopt_array(self::$curl, [
            CURLOPT_POSTFIELDS => $urlEncoded_data
        ]);
    }
}
