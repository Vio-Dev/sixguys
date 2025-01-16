<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Models\Variant;
use App\Models\ProductVariant;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('isDeleted', 0)
            ->with('variants.variantValue.variant')
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
        $adminVariants = Variant::with('values')->where('isDeleted', 0)->get();


        return view('admin.products.create', compact('categories', 'adminVariants'));
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
                'inStock' => "required|numeric|min:0|max:99999999.99",
                'unit' => "required|alpha|min:1|max:20",
                'price' => "required|numeric|min:1|max:99999999.99",
                'description' => "required|string|min:1",
                'shortDescription' => "required|string|min:1|max:1000",
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
                'alpha' => ':attribute phải là chữ',
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
        // $inStock = $input->inStock;
        // $inStock = $request->inStock;
        // if ($inStock < 0)
        // {
        //     $flasher->addFlash('error', 'Đã xảy ra lỗi khi thêm sản phẩm. Vui lòng thử lại.', [], 'Thất bại');
        //     return back();
        // }
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
                    $url = 'uploads/products/'  . $imageName; // Đường dẫn lưu DB

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


        if ($request->has('variant_name')) {
            foreach ($request->variant_name as $index => $variantName) {
                if ($variantName) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_value_id' => $request->variant_values[$index] ?? null,
                        'price' => $request->variant_price[$index] ?? null,
                        'inStock' => $request->variant_inStock[$index] ?? null,
                        'hasSold' => 0,
                        'status' => 'public',
                        'isDeleted' => 0,
                    ]);
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
        $product = Product::with(['images', 'variants.variantValue.variant'])->findOrFail($id);

        $categories = Category::where('isDeleted', 0)->get();
        $images = Media::where('product_id', $id)->get();
        $adminVariants = Variant::with('values')->where('isDeleted', 0)->get();
        $ProductVariant = ProductVariant::where('product_id', $id)->get();

        return view('admin.products.update', compact('product', 'categories', 'images', 'adminVariants', 'ProductVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        // Validate request
        $request->validate(
            [
                'name' => "required|string|max:100",
                'inStock' => "required|numeric|min:0|max:99999999.99",
                'unit' => "required|alpha|min:1|max:20",
                'price' => "required|numeric|min:1|max:99999999.99",
                'description' => "required|string|min:1",
                'shortDescription' => "required|string|min:1|max:1000",
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
                'alpha' => ':attribute phải là chữ',
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

        // Find the product by ID
        $product = Product::findOrFail($id);

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

        // Update the product
        $product->update($input);

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
        if ($request->has('variant_name')) {
            // Delete existing variants
            ProductVariant::where('product_id', $product->id)->delete();

            // Create new variants
            foreach ($request->variant_name as $index => $variantName) {
                if ($variantName) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_value_id' => $request->variant_values[$index] ?? null,
                        'price' => $request->variant_price[$index] ?? null,
                        'inStock' => $request->variant_inStock[$index] ?? null,
                        'hasSold' => 0,
                        'status' => 'public',
                        'isDeleted' => 0,
                    ]);
                }
            }
        }


        // Thông báo kết quả
        if ($product) {
            $flasher->addFlash('success', 'Sản phẩm đã được cập nhật thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm. Vui lòng thử lại.', [], 'Thất bại');
        }


        return redirect()->route("admin.products.list");
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

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
            ->where('isDeleted', 0)
            ->paginate(10);
        return view("admin.products.index", compact("products"));
    }
}
