<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;

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
        return view('site.order.fail');
    }
}
