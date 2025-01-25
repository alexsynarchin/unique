<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ReportHandleNeedPayment;
use App\Jobs\SendAdminReport;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;

class CloudPaymentsController extends Controller
{
    public function success(Request $request)
    {
        $order = UniqueOrder::findOrFail($request->get('order_id'));
        $order->status = 'paid';
        $order->save();
        ReportHandleNeedPayment::dispatch($order)->delay(now());
        SendAdminReport::dispatch($order, 'smtp')->delay(now());
        return $order->url;
    }
}
