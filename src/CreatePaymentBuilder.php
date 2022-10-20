<?php

namespace SymfonyPayments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CreatePaymentBuilder {
    private const API_URI = "/api/payment/";

    private $url;
    private $client;
    private $gateway = "paypal";
    private $currency = "USD";
    private $amount;
    private $returnUrl;
    private $cancelUrl;
    private $items;

    /**
     * @param string $url location of the SymfonyPayments
     */
    public function __construct(string $url) {
        $this->url = $url;

        $this->client = new Client([
            "headers" => [
                "Content-Type" => "application/json"
            ]
        ]);
    }

    public function withPayPal():CreatePaymentBuilder {
        $this->gateway = "paypal";
        return $this;
    }

    public function withStripe(): CreatePaymentBuilder {
        $this->gateway = "stripe";
        return $this;
    }

    public function withCurrency($currency): CreatePaymentBuilder {
        $this->currency = $currency;
        return $this;
    }

    public function withAmount($amount): CreatePaymentBuilder {
        $this->amount = $amount;
        return $this;
    }

    public function withItems($items): CreatePaymentBuilder {
        $this->items = $items;
        return $this;
    }

    public function withReturnUrl($returnUrl): CreatePaymentBuilder {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    public function withCancelUrl($cancelUrl): CreatePaymentBuilder {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function buildAndExecute(): string {
        $body = [
            "amount" => $this->amount,
            "currency" => $this->currency,
            "return_url" => $this->returnUrl,
            "cancel_url" => $this->cancelUrl
        ];

        if($this->items != null) {
            $body["items"] = $this->items->getItems();
        }

        $data = $this->client->post($this->url . self::API_URI . $this->gateway, [
            "body" => json_encode($body)
        ]);

        return $data->getBody()->getContents();
    }

}