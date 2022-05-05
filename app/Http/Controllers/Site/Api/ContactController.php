<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function consultation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);
        return $request->all();
    }
}
