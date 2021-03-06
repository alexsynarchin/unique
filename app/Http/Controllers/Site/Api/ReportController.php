<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminReportMail;
use App\Mail\ReportMail;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Models\Setting;
use App\Services\CheckUnique\CheckUniqueService;
use App\Services\GeneratePdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::with('checkSystem')->findOrFail($id);
        //dd($report->data['urls'][0]);
       // dd($this->getWordsFromString($report->data['clear_text']));
        //$text_array = $this->getWordsFromString();
        return $report;
    }

    public function getUid(Request $request, $id)
    {
        $service = new CheckUniqueService();
        $report = Report::findOrFail($id);
        $check_unique = $report->checkUnique()->first();
        $uid = $service->getUid($check_unique->plainText);
        $report->uid = $uid;
        $report->save();
    }

    public function getResult(Request $request, $id)
    {

        $report = Report::findOrFail($id);
        $service = new CheckUniqueService();
        $result = $service->getResult($report->uid);
        if($result['error']['code']){
            return $report;
        }
        $report -> data = json_decode($result['result_json']);
        $report->result = true;
        $report->save();
        $check_system = $report -> checkSystem;
        $percent = 0;
        if($check_system->api_id !=1 && $report->data['unique'] != 100) {
            $data = $report->data;
            if($check_system->api_id ===2) {
                if($data['unique'] < 1) {
                    $percent = 20;
                } else {
                    $percent = 5;
                }
            }
            if($check_system->api_id ===3) {
                if($data['unique'] < 1) {
                    $percent = 15;
                } else {
                    $percent = 3;
                }

            }

            if($check_system->api_id ===4) {
                if($data['unique'] < 1) {
                    $percent = 11;
                } else {
                    $percent = 2;
                }

            }

            $percent = ($data['unique']/100) * $percent;
            $data['unique'] = $data['unique'] + $percent;
            if($data['unique'] > 100) {
                $data['unique'] = 100;
            }
            $data['unique'] = round($data['unique'], 2);
            $report->data = $data;
            $report->save();
        }
        return $report;
    }

    public function sendEmail(Request $request, $id)
    {
        $generatePdfService = new GeneratePdfService();
        $link = $generatePdfService -> generate($id);
        Mail::to($request->get('email'))->send(new ReportMail($link));
        $exists= Setting::where('group', 'common')->where('name','email_admin')->exists();

        if($exists) {
            $setting = Setting::where('group', 'common')->where('name','email_admin') ->firstOrFail();
            $email = $setting -> value;
            $email = explode(',', $email);
        } else {
            $email = ['alexsynarchin@gmail.com'];
        }
        $form = [
            'link' => $link
        ];
        foreach ($email as $recipient) {
            Mail::to($recipient)->send(new AdminReportMail($form));
        }
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
        $generatePdfService = new GeneratePdfService();
        $link = $generatePdfService -> generate($id);
        return $link;
    }
}
