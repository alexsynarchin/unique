<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;

class CheckReportController extends Controller
{
    public function show($id)
    {
        $check_unique = CheckUnique::findOrFail($id);
        if($check_unique->orders()->exists()) {
            $orders = $check_unique->orders()->get();
            foreach ($orders as $order) {
                if($order->status !== 'paid') {
                    return  redirect(route('main-page'));
                }
            }
        }
        return view('site.check-report.show', ['id' => $id]);
    }
}
