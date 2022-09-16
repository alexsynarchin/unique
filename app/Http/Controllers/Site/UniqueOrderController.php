<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use UnitPay;

class UniqueOrderController extends Controller
{
    public function success(Request $request)
    {
        $order = UniqueOrder::findOrFail($request->get('account'));
        return redirect(route('report', $order -> check_unique_id));
    }

    public function fail(Request $request)
    {
        //dd($request->all());
        $order = UniqueOrder::findOrFail($request->get('account'));
        $check_unique = CheckUnique::findOrFail($order->check_unique_id);
        $description = 'Проверка уникальности';
        $url = UnitPay::getPayUrl($order->sum, $order->id, $check_unique->email, $description);
        return view('site.order.fail', ['url' => $url]);
    }
}
