<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        return view('website.cart');
    }

    public function add(Request $request) {}

    public function update(Request $request) {}

    public function remove(Request $request) {}

    public function clear() {}
}
