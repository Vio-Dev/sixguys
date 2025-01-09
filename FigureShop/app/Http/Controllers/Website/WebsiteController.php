<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Rating;
use Flasher\Prime\FlasherInterface;
use App\Models\Post;
use App\Models\User;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('status', 'public')->where('isDeleted', 0)->orderBy('created_at', 'desc')->get();
          $renderPosts = Post::with('user')->where('status', 'published')->where('isDeleted', 0)->orderBy('created_at', 'desc')->paginate(12);
        return view('website.index', compact('products', 'renderPosts'));
    }
    public function product( Request $request)
    {
         $query = Product::where('isDeleted', 0)->where('status', 'public');

    // Filter by categories
    if ($request->filled('categories')) {
        $categoryIds = $request->categories;
        $subCategoryIds = Category::whereIn('parent_id', $categoryIds)->pluck('id')->toArray();
        $allCategoryIds = array_merge($categoryIds, $subCategoryIds);
        $query->whereIn('category_id', $allCategoryIds);
    }
    if($request->filled('subcategories')){
        $query->whereIn('category_id', $request->subcategories);
    }

    if ($request->filled('minPrice') || $request->filled('maxPrice')) {
        $minPrice = $request->get('minPrice', 0);
        $maxPrice = $request->get('maxPrice', PHP_INT_MAX);
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    // Get the filtered products with pagination
    $products = $query->paginate(12);
        return view('website.product.index', compact('products'));
    }

    public function productDetail($id)
    {
         $comments = Rating::with('user')->where('product_id', $id)->where('isHidden', 0)->get();
        $product = Product::with('images', 'category')->where('status', 'public')->where('id', $id)->with('variants.variantValue.variant')->first();
        return view('website.product.detail', compact('product', 'comments'));
    }

    public function productComment(Request $request ,FlasherInterface $flasher)
    {

        $request->validate([
            'comment' => 'required',
            'product_id' => 'required',
        ]);

        $comments = new Rating();
        $comments->comment = $request->comment;
        $comments->product_id = $request->product_id;
        $comments->rating = $request->rating;
        $comments->user_id = auth()->user()->id;
        $comments->save();
        $flasher->addSuccess('Bình luận của bạn đã được gửi');
        return back();
    }
    public function productDelete(Request $request ,FlasherInterface $flasher)
    {
        $comment = Rating::find($request->id);
        $comment->isHidden = 1;
        $comment->save();
        $flasher->addSuccess('Bình luận của bạn đã được xóa');
        return back();
    }


    // public function about()
    // {
    //     return view('website.about');
    // }

    // public function contact()
    // {
    //     return view('website.contact');
    // }

    public function blog()
    {
       $renderPosts = Post::with('user')->where('status', 'published')->orderBy('created_at', 'desc')->where('isDeleted', 0)->paginate(12);
        return view('website.post.index', compact('renderPosts'));
    }

}
