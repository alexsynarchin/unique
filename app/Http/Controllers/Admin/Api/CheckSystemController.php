<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckSystem;
use Illuminate\Http\Request;

class CheckSystemController extends Controller
{
    public function index()
    {
        $systems = CheckSystem::with('checkApi')->get();
        return $systems;
    }

    public function show($id)
    {
        $system = CheckSystem::findOrFail($id);
        return $system;
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
        ], [
            'title.required' => 'Введите название системы проверки',
        ]);


        $system = CheckSystem::create($request->except(['logo', 'logoName']));
        if($request -> has('logoName')) {
            $system  ->addMediaFromBase64($request->get('logo'))
                ->toMediaCollection('check-systems');
        }

        if(!$request->get('api_id')) {
            $system->manual = 1;
            $system->save();
        }
        return $system;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'api_id' => 'required'
        ], [
            'title.required' => 'Введите название системы проверки',
            'api_id.required' => 'Выберите сервис api для системы проверки'
        ]);
        $system = CheckSystem::findOrFail($id);
        $system->update($request->except(['logo', 'logoName']));
        if($request -> has('logoName')) {
            $system  ->addMediaFromBase64($request->get('logo'))
                ->toMediaCollection('check-systems');
        }
        return $system;
    }

    public function destroy($id)
    {
        $system = CheckSystem::findOrFail($id);
        $system->delete();
        return 'success';
    }
}
