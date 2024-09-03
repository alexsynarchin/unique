<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ContactOrderController extends Controller
{
    public function index()
    {
        $contacts = Order::orderBy('created_at', 'DESC') ->get();
        return $contacts;
    }

    public function show($id)
    {
        $contact = Order::findOrFail($id);
        $contact -> status = 2;
        $contact->save();
        return $contact;
    }
}
