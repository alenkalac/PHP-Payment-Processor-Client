<?php

namespace SymfonyPayments\PayPal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SymfonyPayments\Common\TransactionResponse;

class CompletePayPalPaymentExecutor {

    private $url;
    private $orderId;
    private $payerId;

    public function __construct($url) {
        $this->url = $url;
    }

    public function withOrderId($orderId): CompletePayPalPaymentExecutor {
        $this->orderId = $orderId;
        return $this;
    }

    public function withPayerId($payerId): CompletePayPalPaymentExecutor {
        $this->payerId = $payerId;
        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function buildAndExecute(): TransactionResponse {
        $body = [
            "payerID" => $this->payerId,
            "orderID" => $this->orderId,
        ];

        $client = new Client([
            "headers" => [
                "Content-Type" => "application/json"
            ]
        ]);

        $data = $client->put($this->url, [
            "body" => json_encode($body)
        ]);

        return PayPalTransactionResponse::fromData($data->getBody()->getContents());
    }

}