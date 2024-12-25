<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\VariantValue;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminVariants = Variant::where('isDeleted', 0)
            ->with('values')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.variants.index', compact('adminVariants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $input = $request->except('_token');
        $values = $request->values;
        $variant = Variant::create($input);

        if (is_array($values)) {
            foreach ($values as $value) {
                VariantValue::create([
                    'variant_id' => $variant->id,
                    'value' => $value
                ]);
            }
        }
        if ($variant->wasRecentlyCreated) {
            $flasher->addFlash('success', 'Thêm biến thể thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi thêm biến thể. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.variants.list');
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
        $variant = Variant::findOrFail($id);

        return view('admin.variants.update ', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, FlasherInterface $flasher)
    {
        //

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $input = $request->except('_token');

        $variant = Variant::findOrFail($id);

        $variant->update($input);

        if ($variant->wasChanged()) {
            $flasher->addFlash('success', 'Cập nhật biến thể thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi cập nhật biến thể. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.variants.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FlasherInterface $flasher)
    {
        $variant = Variant::findOrFail($id);

        $variant->isDeleted = 1;
        $variant->save();

        if ($variant->isDeleted) {
            $flasher->addFlash('success', 'Sản phẩm đã được xóa thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.', [], 'Thất bại');
        }
        return redirect()->route('admin.variants.list');
    }
    public function destroyValue(string $id, FlasherInterface $flasher)
    {

        // $value = VariantValue::findOrFail($id);

        // $value->isDeleted = 1;
        // $value->save();

        // if ($value->isDeleted) {
        //     $flasher->addFlash('success', 'Sản phẩm đã được xóa thành công!', [], 'Thành công');
        // } else {
        //     $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.', [], 'Thất bại');
        // }
        // return back();
    }
}
