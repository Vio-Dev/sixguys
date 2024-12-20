<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => "required|string|max:100",
                'inStock' => "required|numeric|min:1|max:99999999.99",
                'unit' => "required|string|min:1|max:20",
                'price' => "required|numeric|min:1|max:99999999.99",
                'description' => "required|string|min:1|max:1000",
                'shortDescription' => "required|string|min:1|max:255",
                'thumbnail' => "required|image|mimes:jpeg,png,jpg,gif",
                'images' => "required|array|max:20000",
                'images.*' => "image|mimes:jpeg,png,jpg,gif",
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không ít hơn :min',
                'max' => ':attribute không vượt quá :max',
                'mimes' => ':attribute phải có đuôi .jpeg, .png, .jpg, .gif',
                'numeric' => ':attribute phải là một số',
            ],
            [
                'name' => 'Tên sản phẩm',
                'inStock' => 'Số lượng sản phẩm',
                'unit' => 'Đơn vị tính',
                'price' => 'Giá sản phẩm',
                'description' => 'Mô tả sản phẩm',
                'shortDescription' => 'Mô tả ngắn sản phẩm',
                'thumbnail' => 'Hình ảnh đại diện',
                'images' => 'Hình ảnh sản phẩm',
            ]
        );

        $input = $request->all();
        $product = Product::create($input);
        $number = 0;
        foreach ($input['images'] as $image) {
            $imageName = $image->getClientOriginalName();

            $image->move('uploads/products', $imageName);
            $thumbnail = 'uploads/products/' . $imageName;

            image_features::create([
                'product_id' => $product->id,
                'url_img' => $thumbnail,
                'alt_img' => $imageName,
                'number' => $number
            ]);
            $number++;
        }
        return redirect()->route("admin.products.list")->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
