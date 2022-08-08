<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckSystem;
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
        if($request->get('price_type') !=='null') {
            if($request->get('price_type')=== 0) {
                $check_uniques = $check_uniques -> whereHas('reports', function ($query) use ($request){
                    $query->whereHas('checkSystem', function ($query) use ($request) {
                        $query->where('price', '=', 0);
                    });
                });
            } else {
                $check_uniques = $check_uniques -> whereHas('reports', function ($query) use ($request){
                    $query->whereHas('checkSystem', function ($query) use ($request) {
                        $query->where('price',  '>', 0);
                    });
                });
            }
        }

        if($request->get('system') !==null) {
            $check_uniques = $check_uniques -> whereHas('reports', function ($query) use ($request){
                $query->whereHas('checkSystem', function ($query) use ($request) {
                    $query->where('id', $request->get('system'));
                });
            });
        }

        $check_uniques = $check_uniques->with(['reports.checkSystem', 'services']) ->orderBy('created_at', 'desc')->get();
        return $check_uniques;
    }

    public function show($id)
    {

    }

    public function getSystems()
    {
        $systems = CheckSystem::all('id', 'title');
        return $systems;
    }
}
