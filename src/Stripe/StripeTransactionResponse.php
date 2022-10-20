<?php

namespace SymfonyPayments\Stripe;

use SymfonyPayments\Common\PayerDetails;
use SymfonyPayments\Common\TransactionResponse;

class StripeTransactionResponse {

    public static function fromData($data): TransactionResponse {
        $data = json_decode($data);

        $response = new TransactionResponse();

        $response->setOrderId($data->id);
        $response->setTransactionId($data->id);
        $response->setAmount($data->amount_total);
        $response->setStatus($data->payment_status);
        $response->setTimestamp($data->created);
        $response->setPayer(self::getPayerDetails($data));

        return $response;
    }

    private static function getPayerDetails($data): PayerDetails {
        $payer = new PayerDetails();
        $payer->email = $data->email;
        $payer->fullName = $data->name;

        return $payer;
    }

}