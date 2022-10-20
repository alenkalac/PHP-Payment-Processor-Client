<?php

namespace SymfonyPayments\PayPal;

use SymfonyPayments\Common\PayerDetails;
use SymfonyPayments\Common\TransactionResponse;

class PayPalTransactionResponse {
    public static function fromData($data): TransactionResponse {
        $data = json_decode($data);

        $response = new TransactionResponse();
        $response->setOrderId($data->orderId);
        $response->setTransactionId($data->transactionId);
        $response->setAmount($data->amount);
        $response->setStatus($data->status);
        $response->setTimestamp($data->timestamp);
        $response->setPayer(self::getPayerDetails($data));

        return $response;
    }

    private static function getPayerDetails($data): PayerDetails {
       $data = json_decode($data->payer);

       $payer = new PayerDetails();
       $payer->email = $data->email_address;
       $payer->fullName = $data->name->given_name . " " . $data->name->surname;

       return $payer;
    }
}
