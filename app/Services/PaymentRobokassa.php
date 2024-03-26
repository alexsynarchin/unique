<?php

namespace App\Services;
use App\Jobs\SendAdminReport;
use App\Models\UniqueOrder;
class PaymentRobokassa
{

    private $robokassa_user =  'ProveritUniq';
    private $pass_1 = 'e513phF4jILjBYXbj3wW';
    private $pass_2 = 's3RCljNJ67YGIlk9hJ2V';
    private  $test_mode = false;

    public function createPayment($order)
    {

        $payment = new \Idma\Robokassa\Payment(
            $this->robokassa_user, $this->pass_1,
            $this->pass_2, $this->test_mode
        );

        $payment
            ->setInvoiceId($order -> id)
            ->setSum($order -> sum)
            ->setDescription('Проверка уникальности текста');
        $url = $payment->getPaymentUrl();

        return $url;
    }

    public function success($data)
    {
        $payment = new \Idma\Robokassa\Payment(
            $this->robokassa_user, $this->pass_1,
            $this->pass_2, $this->test_mode
        );
        $return = [
            'status' => false,
        ];
        if ($payment->validateSuccess($data)) {
            $order = UniqueOrder::findOrFail($payment->getInvoiceId());
            if ($payment->getSum() == $order->sum) {
                SendAdminReport::dispatch($order, 'smtp')->delay(now());
               $return['status'] = true;
               $return['order'] = $order;
            }
        }

        return $return;
    }

    public function paymentResult($data)
    {
        $payment = new \Idma\Robokassa\Payment(
            $this->robokassa_user, $this->pass_1,
            $this->pass_2, $this->test_mode
        );
        if ($payment->validateSuccess($data)) {
            $order = UniqueOrder::findOrFail($payment->getInvoiceId());
            if ($payment->getSum() == $order->sum) {
                $order->status = 'paid';
                $order->save();
                SendAdminReport::dispatch($order, 'smtp')->delay(now());
            }
            echo $payment->getSuccessAnswer(); // "OK1254487\n"
        }
    }
}
