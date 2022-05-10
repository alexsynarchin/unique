<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckReportController extends Controller
{
    public function show($id)
    {
        return view('site.check-report.show', ['id' => $id]);
    }
}
