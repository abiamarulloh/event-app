<?php

namespace App\Providers;

use Midtrans\Config;
use Midtrans\CoreApi;
use GuzzleHttp\Client;

class MidtransDisbursementService
{
    protected $client;

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        $this->client = new Client();
    }

    public function disburse($data)
    {
        $params = [
            "payment_type" => "bank_transfer",
            "transaction_details" => [
                "order_id" => uniqid(),
                "gross_amount" => $data['amount'],
            ],
            "bank_transfer" => [
                "bank" => $data['bank'],
                "account_number" => $data['account_number'],
                "account_holder_name" => $data['account_holder_name'],
            ],
            "amount" => $data['amount'],
            "description" => $data['description'],
        ];

        try {
            $response = CoreApi::charge($params);
            return $response;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getTransactions()
    {
        $response = $this->client->request('GET', 'https://api.sandbox.midtrans.com/v2/transactions', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(Config::$serverKey . ':'),
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
