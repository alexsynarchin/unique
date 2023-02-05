<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use App\Jobs\NeedPayment;
use UnitPay;

class UniqueOrderController extends Controller
{
    public function store(Request $request)
    {
        $order = UniqueOrder::create($request->all());
        foreach ($request->get('reports') as $report_id) {
            $report = Report::findOrFail($report_id);
            $report -> unique_order_id = $order->id;
            $report->save();
        }

        $check_unique = CheckUnique::findOrFail($order->check_unique_id);
        $description = 'Проверка уникальности';

        $netting = !$request->get('russia');
        $url = UnitPay::getPayUrl($order->sum, $order->id, $check_unique->email, $netting, $description);

        NeedPayment::dispatch($order, $url)->delay(now()->addMinutes(2));
        return $url;
    }


}
