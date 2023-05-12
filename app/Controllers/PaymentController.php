<?php

namespace App\Controllers;

use App\Exceptions\PaymentException;
use App\Facades\Config;
use App\Facades\Request;
use App\Facades\Response;
use GuzzleHttp\Client;
use Rakit\Validation\Validator;

class PaymentController extends Controller
{
    protected static string $PENDING = "pending";
    protected static string $COMPLETED = "completed";
    protected static string $FAILED = "failed";
    protected static string $TOKEN = "https://nextpay.org/nx/gateway/token";
    protected static string $callback_uri = "test.com";
    protected static Client $client;

    public function __construct()
    {
        parent::__construct();

        self::$client = new Client();
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

        $token = $this->token_creator($data["order_id"], $data["amount"]);

        return $token->getBody();
    }

    protected function token_creator(int $order_id, int $amount)
    {
        $data = [
            "order_id"     => $order_id,
            "amount"       => $amount,
            "api_key"      => Config::api_key(),
            "callback_uri" => self::$callback_uri
        ];

        $response = self::$client->post(self::$TOKEN, $data);

        return $response;
    }
}
