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

        $categories = Category::where('isDeleted', 0)->get();
        $products = Product::where('isDeleted', 0)->get();

        return view('website.products', compact('categories', 'products'));
    }

    public function productDetail($id)
    {
        $categories = Category::where('isDeleted', 0)->get();
        $product = Product::find($id);
        return view('website.detail', compact('categories', 'product'));
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
