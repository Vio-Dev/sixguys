<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
     public function index()
    {
         $user = Auth::user();

        return view('website.checkout.index', compact('user'));
    }
}
