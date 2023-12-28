<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentRobokassa;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentRobokassa;

    public function __construct(PaymentRobokassa $paymentRobokassa)
    {
        $this -> paymentRobokassa = $paymentRobokassa;
    }
    public function payment(Request $request)
    {
        $request->validate([]);
    }

    public function robokassaPayment(Request $request)
    {
        $this -> paymentRobokassa->paymentResult($request);
    }
}
