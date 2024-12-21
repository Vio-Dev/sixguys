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
        $categories = Category::where('isDeleted', 0)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
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

        $category = new Category;
        $category->name = $request->name;

        if ($category->save()) {
            $flasher->addFlash('success', 'Thêm thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.categories.list');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.update', compact('category'));
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
}