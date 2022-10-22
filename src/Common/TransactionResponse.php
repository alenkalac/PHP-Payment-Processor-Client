<?php

namespace SymfonyPayments\Common;

class TransactionResponse {
    public static $TRANSACTION_SUCCESS = "COMPLETE";

    private $orderId;
    private $transactionId;
    private $amount;
    private $status;
    private $timestamp;
    private $payer;

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
    public function getPayer() {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     */
    public function setPayer(PayerDetails $payer): void {
        $this->payer = $payer;
    }

    public function toArray(): array {
        return [
            "orderId" => $this->orderId,
            "transactionId" => $this->transactionId,
            "amount" => $this->amount,
            "status" => $this->status,
            "timestamp" => $this->timestamp,
            "payer" => $this->payer
        ];
    }
}