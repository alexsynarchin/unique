<?php

namespace App\Services;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class GeneratePdfService
{
    public function generate($id)
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        $link =  "reports/". $report->check_unique_id."/report-" .$report->id.".pdf";
        Storage::makeDirectory('public/reports/'. $report->check_unique_id);
        $html = view('site.pdf.index', ['report' => $report])->render();
        Browsershot::html($html)
            ->noSandbox()
            ->showBackground()
            ->format('a4')
            ->waitUntilNetworkIdle()
            ->setNodeBinary('/usr/bin/node')
            ->setNpmBinary('/usr/bin/npm')
            ->setNodeModulePath("/root/node_modules/")
            ->save(Storage::disk('local')->path('public/' . $link));
        return '/storage/' . $link;
    }
}
