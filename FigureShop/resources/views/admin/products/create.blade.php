@extends('layouts.admin')

@section('title', 'Tạo mới sản phẩm | FigureShop')
@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Tạo sản phẩm</h2>
        </div>
        <form action={{ route('admin.products.store') }} method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-4" type="submit">
            @csrf
            @method('POST')
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Thông tin sản phẩm</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Tên sản
                            phẩm</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </div>
                    <div>
                        <label for="price" class="block font-medium">Giá sản phẩm</label>
                        <input type="text" name="price" id="price"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </div>
                    <div>
                        <label for="inStock" class="block font-medium">Số lượng</label>
                        <input type="text" name="inStock" id="inStock"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </div>
                    <div>
                        <label for="unit" class="block font-medium">Đơn vị tính</label>
                        <input type="text" name="unit" id="unit"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </div>
                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Khuyến mãi</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="discount" class="block font-medium">Giảm giá</label>
                        <input type="text" name="discount" id="discount"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </div>

                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Mô tả sản phẩm</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Mô tả ngắn
                        </label>
                        <textarea>
                        Mô tả ngắn
                        </textarea>
                    </div>
                    <div>
                        <label for="name" class="block font-medium">Mô tả sản phẩm</label>
                        <textarea>
                        Mô tả sản phẩm
                        </textarea>
                    </div>

                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Media</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" id="image"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">

                    </div>
                    <div>
                        <label for="name" class="block font-medium">Ảnh sản phẩm</label>
                        <input type="file" name="image[]" id="image" multiple
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </div>

                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Danh mục sản phẩm</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Tên danh mục</label>
                        <select name="category" id="category"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="">
                <button type="submit" class="bg-blue-500 p-2 rounded-md text-white">Tạo sản phẩm</button>
                <a href={{ route('admin.products.list') }} class="bg-blue-500 p-2 rounded-md text-white">Hủy</a>
            </div>


        </form>
    </div>
@endsection
