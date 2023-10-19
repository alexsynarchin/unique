<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckUniqueResource;
use App\Models\CheckSystem;
use App\Models\CheckUnique;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CheckUniqueController extends Controller
{

    const ITEM_PER_PAGE = 15;
    public function index(Request $request)
    {
        $searchParams = $request->all();

        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $checkUniqueQuery = CheckUnique::query()->select('id', 'email','type','created_at','viewed');

        if(isset($searchParams['system'])) {
           // dd($searchParams['system']);
            $checkUniqueQuery -> whereRelation('reports','system_id',(int) $searchParams['system'] );
        }

        if(isset($searchParams['price_type'])) {
            if((int) $searchParams['price_type'] === 1) {
                $checkUniqueQuery -> whereHas('reports.uniqueOrder' ,function ($q)  {
                    $q -> where('status', 'paid');
                });
            } else if((int) $searchParams['price_type'] === 0) {
                $checkUniqueQuery -> whereDoesntHave('reports.uniqueOrder');
            }

        }
        if(isset($searchParams['type'])) {
            if((int) $searchParams['type'] === 0) {
                $checkUniqueQuery -> whereHas('reports' ,function ($q) {
                    $q -> where('api_id', '!=', NULL);
                });
            } else {
                $checkUniqueQuery -> whereHas('reports' ,function ($q) {
                    $q -> whereNull('api_id');
                });
            }

        }
          $checkUniqueQuery ->whereHas('reports', function ($query){
                $query->where('result', 1)
                    ->orWhere('result', 0)
                    ->when('unique_order_id' !== NULL, function ($query) {
                        $query->whereHas('uniqueOrder',function ($q) {
                            $q -> where('status', 'paid');
                        });
                    })
                    ->orWhere('error_code', '!=', 0);


            });
/*
          $checkUniqueQuery -> whereHas('reports.uniqueOrder', function ($q) {
              $q -> where('status', 'paid');
          })->orDoesntHave('reports.uniqueOrder')->whereHas('reports', function ($q){
              $q->where('need_payment', 0);
          });*/
        return CheckUniqueResource::collection(
            $checkUniqueQuery-> with(['orders', 'services'])->  with(['reports' => function($query){
                $query->where('result', 1)
                    ->orWhere('result', 0)
                    ->when('unique_order_id' !== NULL, function ($query) {
                        $query->whereHas('uniqueOrder',function ($q) {
                            $q -> where('status', 'paid');
                        });
                    })
                    ->orWhere('error_code', '!=', 0);
                $query->select(['id', 'system_id','created_at', 'error_code']);
                $query->with('checkSystem');
            }])
                ->orderBy('created_at', 'desc')
                ->paginate($limit) );
    }

    public function show($id)
    {
        $checkUnique = CheckUnique::findOrFail($id);
        if (!$checkUnique->viewed) {
            $checkUnique->viewed = true;
            $checkUnique->save();
        }
    }

    public function getSystems()
    {
        $systems = CheckSystem::all('id', 'title');
        return $systems;
    }
}
