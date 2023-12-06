<?php

namespace App\Services;

class PaymentRobokassa
{
    private function createPayment($order)
    {
        //test passwords
        // pass 1 Ka4e1x1jwQIU4enhHA8Y
        // pass 2 bIG09xvJo3BtGdZ2w6hI

        //passwords

        // pass 1 DSqzfD7deaz1RQb530Ij
        // pass 2 nV2qFGc5X55BLIbJcY9f

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
