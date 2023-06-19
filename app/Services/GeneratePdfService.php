<?php

namespace App\Services;

use App\Models\Report;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;
class GeneratePdfService
{
    public function generate($id)
    {
        $report = Report::with(['checkSystem' => function($query){
            $query->select('id','title');
        }, 'checkUnique' => function($query) {
            $query->select('id', 'slug', 'symbolsCount','wordsCount', 'pages');
        }])->findOrFail($id);
        $link =  "reports/". $report->check_unique_id."/report-" .$report->id.".pdf";
        Storage::makeDirectory('public/reports/'. $report->check_unique_id);
        $setting = Setting::where('name', 'phone_header')->firstOrFail();
        $pdf = PDF::loadView('site.pdf.index2', ['report' => $report, 'phone' => $setting->value]);
        Storage::put('public/' . $link, $pdf->output());
        $report->filename = "report-" . $report->id . ".pdf";
        $report->save();
        return '/storage/' . $link;
    }
}
