<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('isDeleted', 0)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::where('isDeleted', 0)->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        // Validate request
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
                'discount' => "numeric|min:0|max:100",
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
                "discount" => "Giảm giá",
            ]
        );

        // Lấy dữ liệu input
        $input = $request->except(['images', 'thumbnail']);
        // Xử lý đường dẫn thư mục lưu file
        $productFolder = public_path('uploads/products');
        if (!file_exists($productFolder)) {
            mkdir($productFolder, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }

        // Handle the thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            if ($thumbnail->isValid()) {
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move($productFolder, $thumbnailName); // Lưu file vào thư mục sản phẩm
                $input['thumbnail'] = 'uploads/products/' . $thumbnailName; // Lưu đường dẫn vào cơ sở dữ liệu
            }
        }

        // Create the product
        $product = Product::create($input);

        // Handle the images
        if ($request->hasFile('images')) {
            $number = 0;
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move($productFolder, $imageName); // Lưu file vào thư mục sản phẩm
                    $url = 'uploads/products/' . $input['name'] . '/' . $imageName; // Đường dẫn lưu DB

                    Media::create([
                        'product_id' => $product->id,
                        'url_img' => $url,
                        'alt_img' => $imageName,
                        'number' => $number,
                    ]);
                    $number++;
                }
            }
        }

        // Thông báo kết quả
        if ($product->wasRecentlyCreated) {
            $flasher->addFlash('success', 'Sản phẩm đã được thêm thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi thêm sản phẩm. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route("admin.products.list");
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
    public function destroy(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $product = Product::findOrFail($id);

        // Cập nhật isDeleted thành 1
        if ($product->update(['isDeleted' => 1])) {
            $flasher->addFlash('success', 'Xóa sản phẩm thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa. Vui lòng thử lại', [], 'Thất bại');
        }

        // Chuyển hướng về danh sách danh mục
        return redirect()->route('admin.products.list');
    }
}