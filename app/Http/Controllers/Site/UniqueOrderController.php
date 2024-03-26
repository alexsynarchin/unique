<?php

namespace App\Http\Controllers\Site;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Jobs\SendAdminReport;
use App\Mail\AdminReportMail;
use App\Models\CheckUnique;
use App\Models\Setting;
use App\Models\UniqueOrder;
use App\Services\mailConfigService;
use App\Services\PaymentRobokassa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use UnitPay;

class UniqueOrderController extends Controller
{
    protected $paymentRobokassa;
    public function __construct(PaymentRobokassa $paymentRobokassa)
    {
        $this -> paymentRobokassa = $paymentRobokassa;
    }
    public function success(Request $request)
    {
        $order = UniqueOrder::findOrFail($request->get('account'));
        $url = $order->url;

        return view('site.order.success', ['url'=> $url, 'error'=> '']);
    }

    public function fail(Request $request)
    {
        //dd($request->all());
        $order = UniqueOrder::findOrFail($request->get('account'));
        $check_unique = CheckUnique::findOrFail($order->check_unique_id);
        $description = 'Проверка уникальности';
        $url = UnitPay::getPayUrl($order->sum, $order->id, $check_unique->email, !$order->russia, $description);
        return view('site.order.fail', ['url' => $url]);
    }

    public function robokassaSuccess(Request $request)
    {
       $payment_data =  $this -> paymentRobokassa->success($request->all());
       if($payment_data['status']) {
           $order = $payment_data['order'];
           $url = $order->url;
           $order -> status = 'paid';
           $order -> save();
           return view('site.order.success', ['url'=> $url, 'error'=> '']);
       } else {
           abort(404);
       }
    }
    public function robokassaFail(Request $request)
    {
        $order = UniqueOrder::findOrFail($request->get('InvId'));
        $check_unique = CheckUnique::findOrFail($order->check_unique_id);
        $description = 'Проверка уникальности';
        $url =  $this -> paymentRobokassa -> createPayment($order);
        return view('site.order.fail', ['url' => $url]);
    }

    public function test()
    {
        //$mailConfigService = new mailConfigService();
        //$mailConfig = $mailConfigService -> generateConfig('smtp');
        //dd($mailConfig);
        return view('site.order.test');
    }
}
