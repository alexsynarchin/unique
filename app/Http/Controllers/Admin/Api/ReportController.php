<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sendReport(Request $request, $id)
    {
        $request->validate([
            'report_file' => 'required',

        ], [
            'report_file.required' => 'Прикрепите файл отчета'
        ]);
        $report  = Report::findOrFail($id);

        $data = [
            'unique' => $request->get('unique_percent'),
        ];
        $report->data =$data;
        $report->result = 1;
        $report->save();
        return $report;
    }
}
