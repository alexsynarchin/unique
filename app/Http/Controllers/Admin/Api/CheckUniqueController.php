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
        $checkUniqueQuery = CheckUnique::query();



        return CheckUniqueResource::collection(
            $checkUniqueQuery -> whereHas('reports.checkSystem') -> with('reports.checkSystem')
            ->orderBy('created_at', 'desc')
            ->paginate($limit));
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
