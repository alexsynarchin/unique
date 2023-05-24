<?php

namespace App\Http\Controllers\Admin\Api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Mail\ReportMail;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function sendReport(Request $request, $id)
    {

        $request->validate([
            'report_file' => 'required',

        ], [
            'report_file.required' => 'Прикрепите файл отчета'
        ]);
        $report  = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);

        $data = [
            'unique' => (int) $request->get('unique_percent'),
        ];
        $filename = $request->file('report_file')->getClientOriginalName();

        $path = $request->file('report_file')->storeAs(
            'public/reports/' . $report->checkUnique->id, $filename
        );
        $report->data =$data;
        $report->result = 1;
        $report->filename = $filename;
        $report->save();
        $link = '/storage/reports/' . $report->checkUnique->id . '/' . $report->filename;
        AppHelper::setMailConfig();
        Mail::to($report->checkUnique->email)->send(new ReportMail($link, $report));

        return $report;
    }
}
