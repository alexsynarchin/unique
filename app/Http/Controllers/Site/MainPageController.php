<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\Report;
use App\Services\ContentBlock\GetPageBlocksService;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    protected $getPageBlocksService;

    public function __construct(GetPageBlocksService $getPageBlocksService)
    {
        $this->getPageBlocksService = $getPageBlocksService;
    }

    public function show()
    {
        $types = ['mp-utp'];
        $lists = ['mp-ratings'];
        $blocks = $this->getPageBlocksService->index($types);
        $lists = $this->getPageBlocksService->lists($lists);
        return view('site.home.index', ['blocks' => $blocks, 'lists' => $lists]);
    }

    public function reviewPdf($id)
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        return view('site.pdf.index', ['report' => $report]);
    }
}
