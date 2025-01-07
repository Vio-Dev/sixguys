<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        // Lọc các danh mục có isDeleted = 0 và phân trang
        $adminCategories = Category::where('isDeleted', 0)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('admin.categories.index', compact('adminCategories'));
    }

    public function create()
    {
        $subCategories = Category::where('isDeleted', 0)
            ->whereNull('parent_id')
            ->get();
        return view('admin.categories.create', compact('subCategories'));
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate(
            [
                'name' => "required|min:3|max:100|string",
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute không ít hơn :min ký tự.',
                'max' => ':attribute không vượt quá :max ký tự.',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );

        $input = $request->all();

        $category = Category::create($input);

        if ($category) {
            $flasher->addFlash('success', 'Thêm thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.categories.list');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $subCategories = Category::where('isDeleted', 0)
            ->whereNull('parent_id')
            ->get();
        return view('admin.categories.update', compact('category', "subCategories"));
    }

    public function update(Request $request, string $id, FlasherInterface $flasher)
    {
        $request->validate(
            [
                'name' => "required|min:3|max:100|string",
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute không ít hơn :min ký tự.',
                'max' => ':attribute không vượt quá :max ký tự.',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        if ($category->save()) {
            $flasher->addFlash('success', 'Cập nhật thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.categories.list');
    }

    public function destroy(string $id, FlasherInterface $flasher)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // Cập nhật isDeleted thành 1
        if ($category->update(['isDeleted' => 1])) {
            $flasher->addFlash('success', 'Danh mục xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa. Vui lòng thử lại', [], 'Thất bại');
        }

        // Chuyển hướng về danh sách danh mục
        return redirect()->route('admin.categories.list');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $categories = Category::where('name', 'LIKE', "%{$searchTerm}%")
            ->where('isDeleted', 0)
            ->paginate(10);
        return view("admin.categories.index", compact("categories"));
    }
}
