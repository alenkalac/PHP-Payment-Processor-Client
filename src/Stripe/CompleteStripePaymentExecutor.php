<?php

namespace SymfonyPayments\Stripe;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SymfonyPayments\Common\TransactionResponse;

class CompleteStripePaymentExecutor {

    private $url;
    private $sessionId;

    public function __construct($url, $sessionId) {
        $this->url = $url;
        $this->sessionId = $sessionId;
    }

    /**
     * @throws GuzzleException
     */
    public function buildAndExecute(): TransactionResponse {
        $body = [
            "sessionId" => $this->sessionId
        ];

        $client = new Client([
            "headers" => [
                "Content-Type" => "application/json"
            ]
        ]);

        $data = $client->put($this->url, [
            "body" => json_encode($body)
        ]);

        return StripeTransactionResponse::fromData($data->getBody()->getContents());
    }

}