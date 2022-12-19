<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckApi;
use Illuminate\Http\Request;

class CheckApiController extends Controller
{
    public function index()
    {
        $api_list = CheckApi::all();
        return $api_list;
    }

    public function update(Request $request, $id)
    {

    }

    public function show($id)
    {
        
    }
}
