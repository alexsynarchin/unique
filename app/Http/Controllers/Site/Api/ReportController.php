<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateReportPdf;
use App\Mail\AdminReportMail;
use App\Mail\ReportMail;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Models\Setting;
use App\Services\CheckUnique\CheckUniqueService;
use App\Services\GeneratePdfService;
use App\Services\ReportHighLightTextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\Report\ReportService;
class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::with('checkSystem')->findOrFail($id);
        //dd($report->data['urls'][0]);
       // dd($this->getWordsFromString($report->data['clear_text']));
        //$text_array = $this->getWordsFromString();
        if(!$report->text && isset($report->data['clear_text'])) {
            $report->text = $report->data['clear_text'];
            $report->save();
        } elseif (!$report->text) {
            $symbols = $report->checkSystem -> symbols_count;
            $text = mb_substr($report -> CheckUnique ->plainText, 0, $symbols);
            $report->text = $text;
            $report->save();
        }

        if(!$report->params) {
            $reportService = new ReportService();
            $params = $reportService->calcTextParams($report->text);
            $report->params = $params;
            $report->save();
        }

        if(!$report->highlight_text && $report->result && $report->checkSystem -> api_id && !$report->error_code) {
            $highLightService = new ReportHighLightTextService();
            $report->highlight_text = $highLightService->highLightText($report['data'], $report->checkSystem->checkApi -> title);
            $report->save();
        }
        return $report;
    }

    public function getUid(Request $request, $id)
    {
        $service = new CheckUniqueService();
        $report = Report::findOrFail($id);
        $check_unique = $report->checkUnique()->first();
        $symbols = $report->checkSystem -> symbols_count;
        $uid = $service->getUid(mb_substr($check_unique->plainText, 0, $symbols));
        $report->uid = $uid;
        $report->save();
    }

    public function getResult(Request $request, $id)
    {
        $service = new CheckUniqueService($id);
        $report = $service->getResult();

        return $report;
    }

    public function sendEmail(Request $request, $id)
    {
        $generatePdfService = new GeneratePdfService();
        $link = $generatePdfService -> generate($id);
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        Mail::to($request->get('email'))->send(new ReportMail($link, $report));

    }

    public function highlightUrl(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $highLightService = new ReportHighLightTextService();
        $highlight_text = $highLightService->highLightText($report['data'], $report->checkSystem->checkApi -> title, $request->get('index'));
        return $highlight_text;
    }

    private function getWordsFromString($string)
    {
        if (preg_match_all("/\b(\w+)\b/ui", $string, $matches)) {
            return $matches[1];
        }

        return array();
    }

    public function downloadPdf($id)
    {
        $report=Report::findOrFail($id);
        if($report->filename) {
            $link = '/storage/reports/' . $report->checkUnique->id . '/' . $report->filename;

        } else {
            $generatePdfService = new GeneratePdfService();
            $link = $generatePdfService -> generate($id);
        }

        return $link;
    }
}
