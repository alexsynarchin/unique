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
       /* $mrh_login = "ProveritUniq";
        $mrh_pass1 = "Ka4e1x1jwQIU4enhHA8Y";
        $inv_id = 678678;
        $inv_desc = 'Проверить+уникальность';
        $out_summ = "50.00";
        $IsTest = 1;
        $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
        $params = [
            'MerchantLogin' => $mrh_login,
            'OutSum' => $out_summ,
            'InvoiceID' => $inv_id,
            'Description' => 'Проверить+уникальнсть',
            'SignatureValue' => $crc,
            'IsTest' => 1
        ];
        $url = 'https://auth.robokassa.kz/Merchant/Index.aspx?' .  urldecode(http_build_query($params)) ;*/
        $payment = new \Idma\Robokassa\Payment(
            'ProveritUniq', 'Ka4e1x1jwQIU4enhHA8Y', 'HSpq9X8Dn5sC0LM0SDrq', true
        );

        $payment
            ->setInvoiceId(1)
            ->setSum(50)
            ->setDescription('Проверка уникальности текста');
        $url = $payment->getPaymentUrl();
        return $url;
    }
}
