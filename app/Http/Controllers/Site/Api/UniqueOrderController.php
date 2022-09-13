<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use UnitPay;

class UniqueOrderController extends Controller
{
    public function store(Request $request)
    {
        $order = UniqueOrder::create($request->all());
        $check_unique = CheckUnique::findOrFail($order->check_unique_id);
        $description = 'Проверка уникальности';
        $url = UnitPay::getPayUrl($order->sum, $order -> id, $check_unique->email, $description);
        return $url;
    }


}
