<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $request->validate([]);
    }

    public function robokassaPayment(Request $request)
    {
        $payment = new \Idma\Robokassa\Payment(
            'ProveritUniq', 'QwCiH7R1Rj411fuFIViD', 'EQx7SRfy3ak0LC8S2FUW', false
        );

        $payment
            ->setInvoiceId(22)
            ->setSum(5)
            ->setDescription('Проверка уникальности текста');

// redirect to payment url
        return $payment->getPaymentUrl();
    }
}
