<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ReportMail;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function testMail()
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail(1);
        //dd($report->checkSystem);
        return new \App\Mail\ReportMail('', $report);
    }

    public function sendTestMail()
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail(1);
        Mail::to('gwynbleid11@yandex.ru')->send(new ReportMail('/storage/reports/1/report-1.pdf', $report));
    }
}
