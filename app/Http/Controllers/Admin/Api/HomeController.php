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
    public function index()
    {
      /*  $check_uniques = (new CheckUnique) -> newQuery();

       /* $manual =  $check_uniques -> whereHas('reports', function ($query){
            $query->whereHas('checkSystem', function ($query) {
                $query->where('manual', 1);
            });
        });
        $auto =  $check_uniques -> whereHas('reports', function ($query){
          $query->where('api_id', '!=', null);
        })->orderBy('id','desc');

        $autoCount = $auto -> count();
        $autoItems = $auto;
        $autoCountToday = $auto;
        $autoItems = $autoItems->get(['id', 'created_at'])->take(5);
        $autoCountToday = $autoCountToday-> where('created_at', '>=', Carbon::today())->count();
        $auto_arr = [
            'count' => $autoCount,
            'countToday' => $autoCountToday,
            'items' => $autoItems
        ];
        $check_uniques = (new CheckUnique) -> newQuery();
        $free = $check_uniques -> whereHas('reports', function ($query){
            $query->whereDoesntHave('uniqueOrder');
        })->orderBy('id','desc');
        $freeItems = $free;
        $freeCount = $free -> count();
        $freeItems = $freeItems->get(['id', 'created_at'])->take(5);
        $freeCountToday = $free;
        $freeCountToday = $freeCountToday-> where('created_at', '>=', Carbon::today())->count();

       $free_arr = [
           'count' => $freeCount,
           'countToday' => $freeCountToday,
           'items' => $freeItems
       ];
        $check_uniques = (new CheckUnique) -> newQuery();
       $manual = $check_uniques -> whereHas('reports', function ($query){
         $query->where('api_id', null);
       })->orderBy('id','desc');
        $manualCount = $manual -> count();
        $manualItems = $manual;
        $manualCountToday = $manual;
        $manualItems = $manualItems-> get(['id','created_at'])->take(5);
        $manualCountToday = $manualCountToday-> where('created_at', '>=', Carbon::today())->count();
        $manual_arr = [
            'count' => $manualCount,
            'countToday' => $manualCountToday,
            'items' => $manualItems
        ];
       $rewrites = Rewrite::orderBy('id','desc');
       $rewritesCount = $rewrites-> count();
        $rewritesCountToday = $rewrites;
        $rewritesItems = $rewrites;
        $rewritesItems = $rewritesItems-> get(['id'])->take(5);
       $rewritesCountToday = $rewritesCountToday ->  where('created_at', '>=', Carbon::today()->addHours(5))->count();

       $rewrites_arr = [
           'count' => $rewritesCount,
           'countToday' => $rewritesCountToday,
           'items' => $rewritesItems
       ];
       $sum = UniqueOrder::where('status', 'paid')->sum('sum');
       $sumToday = UniqueOrder::where('created_at', '>=',  Carbon::today()->addHours(5)) -> where('status', 'paid') -> sum('sum');
       $sum_arr = [
           'all' => $sum,
           'sumToday' => $sumToday,
       ];
       return [
           'auto' => $auto_arr,
           'free' => $free_arr,
           'rewrites' => $rewrites_arr,
           'sum' => $sum_arr,
           'manual' => $manual_arr
       ];*/
    }
}
