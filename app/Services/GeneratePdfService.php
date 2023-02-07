<?php

namespace App\Services;

use App\Models\Report;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class GeneratePdfService
{
    public function generate($id)
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        $link =  "reports/". $report->check_unique_id."/report-" .$report->id.".pdf";
        Storage::makeDirectory('public/reports/'. $report->check_unique_id);
        $setting = Setting::where('name', 'phone_header')->firstOrFail();
        $html = view('site.pdf.index', ['report' => $report, 'phone' => $setting->value])->render();
        Browsershot::html($html)
            ->noSandbox()
            ->showBackground()
            ->format('a4')
            ->noSandbox()
            ->waitUntilNetworkIdle()
            ->setNodeBinary('/usr/bin/node')
            ->timeout(240)
            ->setNpmBinary('/usr/bin/npm')
            ->save(Storage::disk('local')->path('public/' . $link));
        $report->filename = "report-" . $report->id . ".pdf";
        $report->save();
        return '/storage/' . $link;
    }
}
