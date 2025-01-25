<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Jobs\ReportHandleNeedPayment;
use App\Jobs\SendAdminReport;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use UnitPay;


class UnitPayController extends Controller
{
    /**
     * Search the order in your database and return that order
     * to paidOrder, if status of your order is 'paid'
     *
     * @param Request $request
     * @param $order_id
     * @return bool|mixed
     */
    public function searchOrder(Request $request, $order_id)
    {
        $order = UniqueOrder::where('id', $order_id)->first();
        if($order) {

            // Else your field doesn` has value like 'paid', you can change this value
            $order['status'] = ('1' == $order['status']) ? 'paid' : false;
            ReportHandleNeedPayment::dispatch($order)->delay(now());
            return $order;
        }

        return false;
    }

    /**
     * When paymnet is check, you can paid your order
     *
     * @param Request $request
     * @param $order
     * @return bool
     */
    public function paidOrder(Request $request, $order)
    {
        $order->status = 'paid';
        $order->save();
        SendAdminReport::dispatch($order, 'smtp')->delay(now());
        //

        return true;
    }

    /**
     * Start handle process from route
     *
     * @param Request $request
     * @return mixed
     */
    public function handlePayment(Request $request)
    {
        //$order = UniqueOrder::findOrFail($request->input('params.account'));
        return UnitPay::handle($request, false);
    }

    public function handlePaymentNetting(Request $request)
    {
        //$order = UniqueOrder::findOrFail($request->input('params.account'));
        return UnitPay::handle($request, true);
    }
}
