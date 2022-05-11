<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Services\CheckUnique\CheckUniqueService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = CheckUnique::findOrFail($id);

        return $report;
    }

    public function getUid(Request $request, $id)
    {
        $service = new CheckUniqueService();
        $report = CheckUnique::findOrFail($id);
        $uid = $service->getUid($report->plainText);
        $report->uid = $uid;
        $report->save();
    }

    public function getResult(Request $request, $id)
    {

        $report = CheckUnique::findOrFail($id);
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
}
