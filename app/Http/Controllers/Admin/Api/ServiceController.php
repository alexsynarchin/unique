<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('updated_at', 'DESC')->get();
        return $services;
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return $service;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Введите название услуги',
        ]);

        $service = Service::create($request->except('logo','logoName'));
        if($request->has('logoName')) {
            $service   ->addMediaFromBase64($request->get('logo'))
                ->toMediaCollection('services');
        }
        return $service;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Введите название услуги',
        ]);

        $service = Service::findOrFail($id);
        $service -> update($request->except('logo','logoName'));
        if($request->has('logoName')) {
            $service   ->addMediaFromBase64($request->get('logo'))
                ->toMediaCollection('services');
        }

        return $service;
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return $id;
    }
}
