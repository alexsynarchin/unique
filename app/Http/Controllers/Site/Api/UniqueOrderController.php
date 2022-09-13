<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;

class UniqueOrderController extends Controller
{
    public function store(Request $request)
    {
        $order = UniqueOrder::create($request->all());
    }
}
