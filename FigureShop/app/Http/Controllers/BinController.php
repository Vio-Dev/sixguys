<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Media;
use App\Models\Variant;
use Flasher\Prime\FlasherInterface;
use App\Models\VariantValue;

class BinController extends Controller
{
    // category

    public function category()
    {
        $binCategories = Category::where('isDeleted', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('admin.bin.category', compact('binCategories'));
    }

    public function destroyCategory(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // xóa danh mục
        if ($category->delete()) {
            $flasher->addFlash('success', 'Danh mục xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa. Vui lòng thử lại', [], 'Thất bại');
        }
        return redirect()->route('admin.bin.category.list');
    }

    public function updateCategory(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // Cập nhật isDeleted thành 1
        if ($category->update(['isDeleted' => 0])) {
            $flasher->addFlash('success', 'Khôi phục thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi Khôi phục. Vui lòng thử lại', [], 'Thất bại');
        }

        // Chuyển hướng về danh sách danh mục
        return redirect()->route('admin.bin.category.list');
    }

    // blogs

    public function blog()
    {
        $blogs = Post::where('isDeleted', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('admin.bin.blog', compact('blogs'));
    }
    public function destroyBlogs(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $blogs = Post::findOrFail($id);

        // xóa danh mục
        if ($blogs->delete()) {
            $flasher->addFlash('success', 'Bài đăng xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa. Vui lòng thử lại', [], 'Thất bại');
        }
        return redirect()->route('admin.bin.blogs.list');
    }

    public function updateBlogs(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $blogs = Post::findOrFail($id);

        // Cập nhật isDeleted thành 1
        if ($blogs->update(['isDeleted' => 0])) {
            $flasher->addFlash('success', 'Khôi phục thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi Khôi phục. Vui lòng thử lại', [], 'Thất bại');
        }

        // Chuyển hướng về danh sách danh mục
        return redirect()->route('admin.bin.blogs.list');
    }
    // products
    public function product()
    {
        $products = Product::where('isDeleted', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('admin.bin.product', compact('products'));
    }
    public function destroyProducts(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $product = Product::findOrFail($id);

        // xóa Media
        $media = Media::where('product_id', $product->id)->get();
        foreach ($media as $item) {
            $item->delete();
        }
        if ($product->delete()) {
            $flasher->addFlash('success', 'Sản phẩm xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa. Vui lòng thử lại', [], 'Thất bại');
        }
        return redirect()->route('admin.bin.products.list');
    }

    public function updateProducts(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $product = Product::findOrFail($id);

        // Cập nhật isDeleted thành 1
        if ($product->update(['isDeleted' => 0])) {
            $flasher->addFlash('success', 'Khôi phục thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi Khôi phục. Vui lòng thử lại', [], 'Thất bại');
        }

        // Chuyển hướng về danh sách danh mục
        return redirect()->route('admin.bin.products.list');
    }


     // variants
    public function variant()
    {
        $adminVariants = Variant::where('isDeleted', 1)
            ->with('deletedValues')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

            // dd($adminVariants);
        return view('admin.bin.variant', compact('adminVariants'));
    }
    public function destroyVariants(string $id, FlasherInterface $flasher)
    {
       $adminVariants = Variant::findOrFail($id);

        if ($adminVariants->delete()) {
            $flasher->addFlash('success', 'Biến thể đã được xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa biến thể. Vui lòng thử lại.', [], 'Thất bại');
        }
        return redirect()->route('admin.bin.variants.list');
    }

    public function updatevariants(string $id, FlasherInterface $flasher)
    {
        $adminVariants = Variant::findOrFail($id);

        if ($adminVariants->update(['isDeleted' => 0])) {
            $flasher->addFlash('success', 'Khôi phục biến thể thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi khôi phục biến thể. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.bin.variants.list');
    }
     public function destroyValue(string $id, FlasherInterface $flasher)
    {
       $adminVariants = VariantValue::findOrFail($id);

        if ($adminVariants->delete()) {
            $flasher->addFlash('success', 'Biến thể đã được xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa biến thể. Vui lòng thử lại.', [], 'Thất bại');
        }
        return redirect()->route('admin.bin.variants.list');
    }

    public function updateValue(string $id, FlasherInterface $flasher)
    {
        $adminVariants = VariantValue::findOrFail($id);

        if ($adminVariants->update(['isDeleted' => 0])) {
            $flasher->addFlash('success', 'Khôi phục biến thể thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi khôi phục biến thể. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.bin.variants.list');
    }
}
