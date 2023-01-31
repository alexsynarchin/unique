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
        $filename = $request->file('report_file')->getClientOriginalName();

        $path = $request->file('report_file')->storeAs(
            'public/reports/' . $report->id, $filename
        );
        $report->data =$data;
        $report->result = 1;
        $report->filename = $filename;
        $report->save();
        return $report;
    }
}
