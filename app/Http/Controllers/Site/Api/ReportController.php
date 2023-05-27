<?php

namespace App\Http\Controllers\Site\Api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Jobs\GenerateReportPdf;
use App\Mail\AdminReportMail;
use App\Mail\ReportMail;
use App\Models\CheckApi;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Models\Setting;
use App\Models\UniqueOrder;
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
        if (!$report->text) {
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

        if(!$report->highlight_text && $report->result && $report-> api_id && !$report->error_code) {
            $highLightService = new ReportHighLightTextService();
            $check_api = CheckApi::findOrFail($report->api_id);
            $report->highlight_text = $highLightService->highLightText($report['data'], $check_api-> title);
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
        $send_status = false;
        if(Setting::where('group', 'common') -> where('name', 'free_email_send') -> exists()) {
            $send_setting = Setting::where('group', 'common') -> where('name', 'free_email_send')->first();
            $send_setting = $send_setting -> value;
            if( ((int) $send_setting) === 1) {
                $send_status = true;
            }
        }


        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        if($report->unique_order_id) {
            $unique_order = UniqueOrder::firstOrFail($report->unique_order_id);
            if($unique_order->status === 'paid') {
                $send_status = true;
            }
        }
        if($send_status ) {
            $generatePdfService = new GeneratePdfService();
            $link = $generatePdfService -> generate($id);
            AppHelper::setMailConfig();
            Mail::to($request->get('email'))->send(new ReportMail($link, $report));
        }

            return $send_status;
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
