<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendAdminReport;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Models\Setting;
use App\Models\UniqueOrder;
use App\Services\PaymentRobokassa;
use Illuminate\Http\Request;
use App\Jobs\NeedPayment;
use UnitPay;

class UniqueOrderController extends Controller
{
    protected $paymentRobokassa;
    public function __construct(PaymentRobokassa $paymentRobokassa)
    {
        $this -> paymentRobokassa = $paymentRobokassa;
    }
    public function store(Request $request)
    {
        $order_data = $request->all();

        if(!$order_data['russia'])  {
            $order_data['sum'] = $order_data['sum_not_ru'];
            $order_data['currency'] = $order_data['currency_not_ru'];
            if(Setting::where('group', 'payment') -> where('name', 'payment_not_ru')->exists()) {
                $payment_not_ru = Setting::where('group', 'payment') -> where('name', 'payment_not_ru')->first();
                $order_data['paymentType'] = $payment_not_ru -> value;
            } else {
                $order_data['paymentType'] =  'robokassa';
            }
        } else {
            if(Setting::where('group', 'payment') -> where('name', 'payment_ru')->exists()) {
                $payment_ru = Setting::where('group', 'payment') -> where('name', 'payment_ru')->first();
                $order_data['paymentType'] = $payment_ru -> value;
            } else {
                $order_data['paymentType'] =  'unitpay';
            }
            $order_data['currency'] = $order_data['currency_ru'];
        }

        $order = UniqueOrder::create($order_data);
        foreach ($request->get('reports') as $report_id) {
            $report = Report::findOrFail($report_id);
            $report -> unique_order_id = $order->id;
            $report->save();
        }

        $check_unique = CheckUnique::findOrFail($order->check_unique_id);
        $description = 'Проверка уникальности';

        if(!$order_data['russia'] && $order->paymentType === 'robokassa') {
          $url =  $this -> paymentRobokassa -> createPayment($order);
        } elseif ($order->paymentType === 'cloudpayments') {
            $url = route('cloud-payments.show-payment-page',['order_id'=>$order->id]);
        }
        else {
            $netting = !$request->get('russia');
            $url = UnitPay::getPayUrl($order->sum, $order->id, $check_unique->email, $netting, $description);
        }

        //SendAdminReport::dispatch($order, 'smtp')->delay(now());
        NeedPayment::dispatch($order, $url, 'smtp')->delay(now()->addMinutes(2)); //->addMinutes(2)
        return $url;
    }

    public function storeFree(Request  $request)
    {
        $order_data = $request->all();

        if(!$order_data['russia'])  {
            $order_data['sum'] = $order_data['sum_not_ru'];
            $order_data['currency'] = $order_data['currency_not_ru'];
            if(Setting::where('group', 'payment') -> where('name', 'payment_not_ru')->exists()) {
                $payment_not_ru = Setting::where('group', 'payment') -> where('name', 'payment_not_ru')->first();
                $order_data['paymentType'] = $payment_not_ru -> value;
            } else {
                $order_data['paymentType'] =  'robokassa';
            }
        } else {
            if(Setting::where('group', 'payment') -> where('name', 'payment_ru')->exists()) {
                $order_data['sum'] = $order_data['sum_ru'];
                $payment_ru = Setting::where('group', 'payment') -> where('name', 'payment_ru')->first();
                $order_data['paymentType'] = $payment_ru -> value;
            } else {
                $order_data['paymentType'] =  'unitpay';
            }
            $order_data['currency'] = $order_data['currency_ru'];
        }
        $description = $order_data['service'];
        $order_data['description'] = $description;
        $order_data['type'] = 2;
        $order_data['check_unique_id'] = 0;
        $order = UniqueOrder::create($order_data);


        if(!$order_data['russia'] && $order->paymentType === 'robokassa') {
            $url =  $this -> paymentRobokassa -> createPayment($order);
        } elseif ($order->paymentType === 'cloudpayments') {
            $url = route('cloud-payments.show-payment-page',['order_id'=>$order->id]);
        }
        else {
            $netting = !$request->get('russia');
            $url = UnitPay::getPayUrl($order->sum, $order->id, $order_data['email'], $netting, $description);
        }

        //SendAdminReport::dispatch($order, 'smtp')->delay(now());
        return $url;
    }
}
