<?php

namespace App\Services;

class PaymentRobokassa
{
    private function createPayment($order)
    {
        //test passwords
        // pass 1 qBy89c5N4pnPnaT9yPPq
        // pass 2 HSpq9X8Dn5sC0LM0SDrq

        //passwords

        // pass 1 QwCiH7R1Rj411fuFIViD
        // pass 2 EQx7SRfy3ak0LC8S2FUW

        $payment = new \Idma\Robokassa\Payment(
            'ProveritUniq', 'qBy89c5N4pnPnaT9yPPq', 'HSpq9X8Dn5sC0LM0SDrq', true
        );

        $payment
            ->setInvoiceId($order->id)
            ->setSum($order->sum)
            ->setDescription('Проверка уникальности текста');

// redirect to payment url
        return $payment->getPaymentUrl();
    }
}
