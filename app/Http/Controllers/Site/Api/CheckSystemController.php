<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckSystem;
use Illuminate\Http\Request;

class CheckSystemController extends Controller
{
    public function index()
    {
        $systems = CheckSystem::orderBy('menuindex','asc')->orderBy('created_at','desc')->get();
        return $systems;
    }
}
