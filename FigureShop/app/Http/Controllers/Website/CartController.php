<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function index()
    {

        return view('website.cart.index');
    }

    public function add(Request $request)
    {
        dd($request->all());
    }

    public function update(Request $request) {}

    public function remove(Request $request) {}

    public function clear() {}
}
