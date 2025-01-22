<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Services\ContentBlock\GetPageBlocksService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    protected $getPageBlocksService;

    public function __construct(GetPageBlocksService $getPageBlocksService)
    {
        $this->getPageBlocksService = $getPageBlocksService;
    }

    public function index(Request $request)
    {

        $lists= ['reviews-list'];
        $lists = $this->getPageBlocksService->lists($lists);
        $reviews = $lists['reviews-list'];

        if($request->get('filter') !== 'all'){
            $reviews = array_filter($reviews, function ($item) use ($request){
                return $item['type']['value'] === $request->get('filter');
            });
        }
        $dates = array();
        foreach ($reviews as $key => $row) {
            $dates[$key] =strtotime(strtr($row['date'], ['.' => '-']));
        }

        if($request->get('sort') == 'asc'){
           array_multisort($dates, SORT_ASC, $reviews);
        } else {
             array_multisort($dates, SORT_DESC, $reviews);
        }

        return $reviews;
    }
}
