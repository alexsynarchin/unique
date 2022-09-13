<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
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

        //dd(App::call(config('unitpay.searchOrder'), ['order_id' => $request->input('params.account')]));
        return UnitPay::handle($request);
    }
}
