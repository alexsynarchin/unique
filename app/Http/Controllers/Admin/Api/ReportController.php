<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sendReport(Request $request)
    {

        $request->validate([
            'report_file' => 'required',

        ], [
            'report_file.required' => 'Прикрепите файл отчета'
        ]);
    }
}
