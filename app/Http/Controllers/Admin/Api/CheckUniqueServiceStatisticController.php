<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckApi;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckUniqueServiceStatisticController extends Controller
{
    public function services(Request $request)
    {
        $services = CheckApi::whereHas('accounts')->get();
        return $services;
    }

    public function symbolsStatistic(Request $request)
    {

        $start = Carbon::parse($request->get('range')[0]);
        $end = Carbon::parse($request->get('range')[1]);

        $symbols = Report::where('api_id', $request->get('api_id'))
            ->select('id', 'api_id', 'payment_free', 'created_at',  'result', 'need_payment')
            ->where('created_at', '>=', $start->toDateTimeString())
            ->where('created_at', '<=', $end->toDateTimeString())
            ->where('result', 1)
            ->where('payment_free', $request->get('payment_free'))
            ->sum('symbols_count');

        return $symbols;
    }
}
