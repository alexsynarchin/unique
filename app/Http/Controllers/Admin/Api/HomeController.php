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
        $check_uniques = (new CheckUnique) -> newQuery();

       /* $manual =  $check_uniques -> whereHas('reports', function ($query){
            $query->whereHas('checkSystem', function ($query) {
                $query->where('manual', 1);
            });
        });*/
        $auto =  $check_uniques -> whereHas('reports', function ($query){
            $query->whereHas('checkSystem', function ($query) {
                $query->where('manual', 0);
            });
        })->orderBy('id','desc')->get();

        $autoCount = $auto -> count();
        $autoCountToday = $auto-> where('created_at', Carbon::today())->count();
        $auto = $auto->take(5);

        $auto_arr = [
            'count' => $autoCount,
            'countToday' => $autoCountToday,
            'items' => $auto
        ];
        $check_uniques = (new CheckUnique) -> newQuery();
        $free = $check_uniques -> whereHas('reports', function ($query){
            $query->whereHas('checkSystem', function ($query) {
                $query->where('manual', 0);
                $query->where('price', 0);
            });
        })->orderBy('id','desc')->get();
        $freeCount = $auto -> count();
        $freeCountToday = $auto-> where('created_at', Carbon::today())->count();
        $free = $free->take(5);
       $free_arr = [
           'count' => $freeCount,
           'countToday' => $freeCountToday,
           'items' => $free
       ];
        $check_uniques = (new CheckUnique) -> newQuery();
       $manual = $check_uniques -> whereHas('reports', function ($query){
           $query->whereHas('checkSystem', function ($query) {
               $query->where('manual', 1);
           });
       })->orderBy('id','desc')->get();
        $manualCount = $manual -> count();
        $manualCountToday = $manual-> where('created_at', Carbon::today())->count();
        $manual = $manual->take(5);
        $manual_arr = [
            'count' => $manualCount,
            'countToday' => $manualCountToday,
            'items' => $manual
        ];
       $rewrites = Rewrite::orderBy('id','desc')->get();
       $rewritesCount = $rewrites-> count();
       $rewritesCountToday = $rewrites ->  where('created_at', Carbon::today())->count();
       $rewrites = $rewrites->take(5);
       $rewrites_arr = [
           'count' => $rewritesCount,
           'countToday' => $rewritesCountToday,
           'items' => $rewrites
       ];
       $sum = UniqueOrder::sum('sum');
       $sumToday = UniqueOrder::where('created_at', Carbon::today()) -> sum('sum');
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
       ];
    }
}
