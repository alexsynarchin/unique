<?php

namespace App\Http\Controllers\Site;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Mail\AdminReportMail;
use App\Models\Setting;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
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


        $exists= Setting::where('group', 'common')->where('name','email_admin')->exists();

        if($exists) {
            $setting = Setting::where('group', 'common')->where('name','email_admin') ->firstOrFail();
            $email = $setting -> value;
            $email = explode(',', $email);
        } else {
            $email = ['alexsynarchin@gmail.com'];
        }

        foreach ($email as $recipient) {
            AppHelper::setMailConfig();
            try {
                Mail::to(trim($recipient))->send(new AdminReportMail($order));
            } catch (\Exception $e) { // alternatively use \Exception
                // dump error

            }
        }
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
