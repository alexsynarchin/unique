<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiAccount;
use Illuminate\Http\Request;

class ApiAccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = ApiAccount::where('api_id', $request->get('id'))->orderBy('menuindex','asc')->orderBy('created_at','desc')->get();
        return $accounts;
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'key'=>'required',

        ]);
        $account = ApiAccount::create($request->all());
        return $account;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'key'=>'required',
            'password' => 'required'
        ]);
        $account = ApiAccount::findOrFail($id);
        $account-> update($request->all());
        return $account;
    }

    public function show($id)
    {
        $account = ApiAccount::findOrFail($id);
        return $account;
    }

    public function destroy($id)
    {
        $account = ApiAccount::findOrFail($id);
        $account->delete();
        return $account;
    }
}
