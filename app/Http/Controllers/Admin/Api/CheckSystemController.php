<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckSystem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
class CheckSystemController extends Controller
{
    public function index()
    {
        $systems = CheckSystem::with('checkApi')->with('media')->orderBy('menuindex','asc')->orderBy('created_at','desc')->get();
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


        $system = CheckSystem::create($request->except(['logo', 'logoName', 'report_file']));

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $upload_folder = 'public/check-systems/files/' . $system->id;
            $filename = $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
        }
        
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
        ], [
            'title.required' => 'Введите название системы проверки',
        ]);

        $system = CheckSystem::findOrFail($id);
        $system->update($request->except(['logo', 'logoName', 'file']));

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $upload_folder = 'public/check-systems/files/' . $system->id;
            $filename = $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
        }
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
