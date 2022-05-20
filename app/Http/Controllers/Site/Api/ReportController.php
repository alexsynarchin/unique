<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Services\CheckUnique\CheckUniqueService;
use Illuminate\Http\Request;

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
        return $report;
    }

    private function getWordsFromString($string)
    {
        if (preg_match_all("/\b(\w+)\b/ui", $string, $matches)) {
            return $matches[1];
        }

        return array();
    }
}
