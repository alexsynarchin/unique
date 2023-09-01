<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessEmailTest;
use App\Mail\ReportMail;
use App\Models\Report;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function testMail()
    {
        $order = UniqueOrder::findOrFail(122456);
        ProcessEmailTest::dispatch($order)->delay(now());
    }

    public function sendTestMail()
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail(1);
        Mail::to('gwynbleid11@yandex.ru')->send(new ReportMail('/storage/reports/1/report-1.pdf', $report));
    }
}
