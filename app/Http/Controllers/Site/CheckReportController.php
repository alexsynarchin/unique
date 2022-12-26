<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;

class CheckReportController extends Controller
{
    public function show($slug)
    {
        $check_unique = CheckUnique::firstOrFail($slug);
        if($check_unique->orders()->exists()) {
            $orders = $check_unique->orders()->get();
            foreach ($orders as $order) {
                if($order->status !== 'paid') {
                    return  redirect(route('main-page'));
                }
            }
        }
        return view('site.check-report.show', ['id' => $check_unique->id]);
    }
}
