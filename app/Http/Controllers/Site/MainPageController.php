<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\Report;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {

    }
    public function reviewPdf($id)
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        return view('site.pdf.index', ['report' => $report]);
    }
}
