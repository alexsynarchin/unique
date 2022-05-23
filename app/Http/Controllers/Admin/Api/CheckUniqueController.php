<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use Illuminate\Http\Request;

class CheckUniqueController extends Controller
{
    public function index()
    {
        $check_uniques = CheckUnique::with('reports')->get();
        return $check_uniques;
    }

    public function show($id)
    {

    }
}
