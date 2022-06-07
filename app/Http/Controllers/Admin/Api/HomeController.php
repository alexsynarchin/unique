<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
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
        $free =   $check_uniques -> whereHas('reports', function ($query){
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
       return [
           'auto' => $auto_arr,
           'free' => $free_arr
       ];
    }
}
