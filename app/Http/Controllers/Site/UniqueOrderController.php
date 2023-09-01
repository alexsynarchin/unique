<?php

namespace App\Http\Controllers\Site;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Jobs\SendAdminReport;
use App\Mail\AdminReportMail;
use App\Models\CheckUnique;
use App\Models\Setting;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use UnitPay;

class UniqueOrderController extends Controller
{
    public function success(Request $request)
    {
        $order = UniqueOrder::findOrFail($request->get('account'));
        $url = $order->url;
        SendAdminReport::dispatch($order)->delay(now());
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
}
