<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('isDeleted', 0)->get();
        return view('website.index', compact('categories'));
    }
    public function product()
    {
        $products = Product::where('isDeleted', 0)->where('status', 'public')->get();
        return view('website.product.index', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::with('images', 'category')->where('status', 'public')->where('id', $id)->first();
        return view('website.product.detail', compact('product'));
    }

    // public function about()
    // {
    //     return view('website.about');
    // }

    // public function contact()
    // {
    //     return view('website.contact');
    // }

    // public function blog()
    // {
    //     return view('website.blog');
    // }



}
