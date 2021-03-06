<?php

namespace SymfonyPayments\PayPal;

class PayPalTransactionResponse {
    private $orderId;
    private $transactionId;
    private $amount;
    private $status;
    private $timestamp;
    private $payer_email;

    public function __construct($data){
        $data = json_decode($data);

        $this->orderId = $data->orderId;
        $this->transactionId = $data->transactionId;
        $this->amount = $data->amount;
        $this->status = $data->status;
        $this->timestamp = $data->timestamp;
        $this->payer_email = $data->payer_email;
    }

    /**
     * @return mixed
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getTransactionId() {
        return $this->transactionId;
    }

    /**
     * @param mixed $transactionId
     */
    public function setTransactionId($transactionId): void {
        $this->transactionId = $transactionId;
    }

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getPayerEmail() {
        return $this->payer_email;
    }

    /**
     * @param mixed $payer_email
     */
    public function setPayerEmail($payer_email): void {
        $this->payer_email = $payer_email;
    }
}