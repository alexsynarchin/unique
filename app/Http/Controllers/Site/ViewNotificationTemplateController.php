<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;

class ViewNotificationTemplateController extends Controller
{
    public function needPaymentNotification()
    {
        $order = UniqueOrder::with('checkUnique', 'reports.checkSystem')->findOrFail(13);
        return view('mails.report-admin',['order' =>$order]);
    }
}
