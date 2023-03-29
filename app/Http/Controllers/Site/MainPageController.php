<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\Page;
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
        $types = ['mp-utp', 'mp-why', 'mp-process', 'mp-about','mp-reviews', 'mp-faq'];
        $lists = ['mp-ratings', 'mp-why-list', 'mp-process-list', 'mp-about-list', 'mp-about-gallery', 'mp-reviews-list', 'mp-faq-list'];
        $blocks = $this->getPageBlocksService->index($types);
        $lists = $this->getPageBlocksService->lists($lists);
        $page = Page::where('slug', 'home')->firstOrFaile();
        $seo = $page->seo;
        return view('site.home.index', ['blocks' => $blocks, 'lists' => $lists, 'seo' => $seo]);
    }

    public function reviewPdf($id)
    {
        $report = Report::with(['checkSystem', 'checkUnique'])->findOrFail($id);
        return view('site.pdf.index', ['report' => $report]);
    }
}
