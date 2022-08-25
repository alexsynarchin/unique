<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function getMenu($position)
    {
        $menu = Menu::where('position', $position)->get();
        return $menu;
    }
}
