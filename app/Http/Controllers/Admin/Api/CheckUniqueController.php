<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;

class CheckUniqueController extends Controller
{
    public function index(Request $request)
    {
        $check_uniques = (new CheckUnique) -> newQuery();

        if($request->get('type') !==null) {
            $check_uniques = $check_uniques -> whereHas('reports', function ($query) use ($request){
               $query->whereHas('checkSystem', function ($query) use ($request) {
                    $query->where('manual', $request->get('type'));
               });
            });
        }
        $check_uniques = $check_uniques->with('reports')->get();
        return $check_uniques;
    }

    public function show($id)
    {

    }
}
