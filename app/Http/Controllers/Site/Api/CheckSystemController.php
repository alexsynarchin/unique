<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckSystem;
use Illuminate\Http\Request;

class CheckSystemController extends Controller
{
    public function index()
    {
        $systems = CheckSystem::all();
        return $systems;
    }
}
