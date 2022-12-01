<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo_codes = PromoCode::all();

        return $promo_codes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
           'name' => 'required',
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:1',
            'max_count' => 'required',
            'range' => 'required',
        ], [
            'range.required' => 'Выберите срок действия промокода',
            'discount.min' => 'Введите размер скидки'
        ]);

        $start_time = date('Y-m-d H:i:s',  strtotime($request ->get('range')[0]));
        $end_time = date('Y-m-d H:i:s', strtotime($request ->get('range')[1]));
        $promo_code = PromoCode::create([
            'name' => $request->get('name'),
            'discount_type' => $request->get('discount_type'),
            'discount' => $request->get('discount'),
            'max_count' => $request->get('max_count'),
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);


        return $promo_code;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = PromoCode::findOrFail($id);
        return $promo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promo = PromoCode::findOrFail($id);
        $promo -> update($request->all());
        return $promo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = PromoCode::findOrFail($id);
        $promo->delete();
        return $promo;
    }
}
