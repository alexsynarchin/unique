<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;

class CloudPaymentsController extends Controller
{
    public function showPaymentPage(Request $request)
    {
        if($request->has('order_id'))
        {
            $uniqueOrder = UniqueOrder::findOrFail($request->get('order_id'));
            return view('site.cloud-payments.payment-page', ['order' => $uniqueOrder]);
        } else {
            return redirect('/');
        }


    }
}
