<?php

namespace SymfonyPayments;

use SymfonyPayments\PayPal\CompletePayPalPaymentExecutor;
use SymfonyPayments\Stripe\CompleteStripePaymentExecutor;

class CompletePaymentBuilder {
    private const API_URI = "/api/payment/";

    private $url;

    /**
     * @param string $url location of the SymfonyPayments
     */
    public function __construct(string $url) {
        $this->url = $url;
    }

    public function forPayPal(): CompletePayPalPaymentExecutor {
        return new CompletePayPalPaymentExecutor($this->url . self::API_URI . "paypal");
    }

    public function forStripe($sessionId): CompleteStripePaymentExecutor {
        return new CompleteStripePaymentExecutor($this->url . self::API_URI . "stripe", $sessionId);
    }
}