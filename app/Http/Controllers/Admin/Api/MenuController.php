<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function list($position){

        $menu = Menu::where('position',$position)->get();
        return $menu;
    }
    public function store(Request $request)
    {
        $menu = Menu::create($request->all());
        return $menu;
    }
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu ->update($request->all());
        return $menu;
    }
    public function remove($id)
    {
        $menuItem = Menu::findOrFail($id);
        $menuItem ->delete();
        return 'success';
    }

    public function sort() {

    }
}
