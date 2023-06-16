<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
class TestPdfController extends Controller
{
    public function index()
    {
        //18727
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail(18727);

        $link =  "reports/". $report->check_unique_id."/report-" .$report->id.".pdf";
        Storage::makeDirectory('public/reports/'. $report->check_unique_id);
        $setting = Setting::where('name', 'phone_header')->firstOrFail();
        $pdf = PDF::loadView('site.pdf.index2', ['report' => $report, 'phone' => $setting->value]);
       return view('site.pdf.index2', ['report' => $report, 'phone' => $setting->value]);
       //  return $pdf->download('demo.pdf');
    }
    public function test() {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail(18727);

        $link =  "reports/". $report->check_unique_id."/report-" .$report->id.".pdf";
        Storage::makeDirectory('public/reports/'. $report->check_unique_id);
        $setting = Setting::where('name', 'phone_header')->firstOrFail();
        return view('site.pdf.index', ['report' => $report, 'phone' => $setting->value]);
    }
}
