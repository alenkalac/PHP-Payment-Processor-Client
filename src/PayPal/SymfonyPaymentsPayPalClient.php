<?php

namespace SymfonyPayments\PayPal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SymfonyPayments\Common\TransactionResponse;
use SymfonyPayments\Items;

/** @deprecated  */
class SymfonyPaymentsPayPalClient {
    private const PAYPAL_URI = "/api/payments/paypal";

    private $url;
    private $client;

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

    /**
     * @param $amount
     * @param string $currency
     * @param Items|null $items
     * @param null $returnUrl
     * @param null $cancelUrl
     * @return string
     * @throws GuzzleException
     */
    public function createPaymentWithCurrency($amount, string $currency = "USD", Items $items = null, $returnUrl = null, $cancelUrl = null): string {
        $body = [
            "amount" => $amount,
            "currency" => $currency,
            "return_url" => $returnUrl,
            "cancel_url" => $cancelUrl
        ];

        if($items != null) {
            $body["items"] = $items->getItems();
        }

        $data = $this->client->post($this->url . self::PAYPAL_URI, [
            "body" => json_encode($body)
        ]);

        return $data->getBody()->getContents();
    }

    /**
     * @param $amount
     * @param Items|null $items
     * @param $returnUrl
     * @param $cancelUrl
     * @return string
     * @throws GuzzleException
     */
    public function createPayment($amount, Items $items = null, $returnUrl = null, $cancelUrl = null): string {
        return $this->createPaymentWithCurrency($amount, "USD", $items, $returnUrl, $cancelUrl);
    }

    /**
     * @param $payerId
     * @param $orderId
     * @param null $refundCallbackUrl
     * @return TransactionResponse
     * @throws GuzzleException
     */
    public function completePayment($payerId, $orderId, $refundCallbackUrl = null): TransactionResponse {
        $body = [
            "payerID" => $payerId,
            "orderID" => $orderId,
        ];

        if($refundCallbackUrl != null) {
            $body['refund_callback'] = $refundCallbackUrl;
        }

        $data = $this->client->put($this->url . self::PAYPAL_URI, [
            "body" => json_encode($body)
        ]);

        return PayPalTransactionResponse::fromData($data->getBody()->getContents());
    }
}
