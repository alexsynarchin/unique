<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\Rewrite;
use App\Models\UniqueOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $return = [];
        if($type === 'rewrites') {
            $rewrites = Rewrite::query()->select('id', 'created_at')->orderBy('id','desc');
            $rewritesCount = $rewrites-> count();
            $rewritesCountToday = $rewrites;
            $rewritesItems = $rewrites;
            $rewritesItems = $rewritesItems->take(5)->get();
            $rewritesCountToday = $rewritesCountToday ->  where('created_at', '>=', Carbon::today()->addHours(5))->count();

            $return = [
                'count' => $rewritesCount,
                'countToday' => $rewritesCountToday,
                'items' => $rewritesItems
            ];
        }
        if($type === 'sum') {
            $sum = UniqueOrder::where('status', 'paid')->sum('sum');
            $sumToday = UniqueOrder::where('created_at', '>=',  Carbon::today()->addHours(5)) -> where('status', 'paid') -> sum('sum');
            $return = [
                'all' => $sum,
                'sumToday' => $sumToday,
            ];
        }
        if($type === 'auto') {
            $auto = CheckUnique::query()->select('id', 'created_at') -> whereHas('reports', function ($query){
                $query->where('api_id', '!=', null);
            })->orderBy('id','desc');
            $autoCount = $auto -> count();
            $autoItems = $auto;
            $autoCountToday = $auto;
            $autoItems = $autoItems->take(5)->get();
            $autoCountToday = $autoCountToday-> where('created_at', '>=', Carbon::today())->count();
            $return = [
                'count' => $autoCount,
                'countToday' => $autoCountToday,
                'items' => $autoItems
            ];
        }
        if($type === 'free') {
            $free = CheckUnique::query()->select('id', 'created_at')-> whereHas('reports', function ($query){
                $query->where('unique_order_id', NULL);
            })->orderBy('id','desc');
            $freeCount = $free -> count();
            $freeItems = $free->take(5)->get();
            $freeCountToday = $free;
            $freeCountToday = $freeCountToday-> where('created_at', '>=', Carbon::today())->count();

            $return = [
                'count' => $freeCount,
                'countToday' => $freeCountToday,
                'items' => $freeItems
            ];
        }
        if($type === 'manual') {
            $manual  = CheckUnique::query()->select('id', 'created_at')-> whereHas('reports', function ($query){
                $query->where('api_id', null);
            })->orderBy('id','desc');
            $manualCount = $manual -> count();
            $manualItems = $manual;
            $manualCountToday = $manual;
            $manualItems = $manualItems->take(5)->get();
            $manualCountToday = $manualCountToday-> where('created_at', '>=', Carbon::today())->count();
            $return = [
                'count' => $manualCount,
                'countToday' => $manualCountToday,
                'items' => $manualItems
            ];
        }
        return $return;
    }
}
