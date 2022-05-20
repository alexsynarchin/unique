<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {

    }
    public function reviewPdf($id)
    {
        $report = CheckUnique::findOrFail($id);
        return view('site.pdf.index', ['report' => $report]);
    }
}
