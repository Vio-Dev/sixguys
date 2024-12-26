@extends('layouts.admin')

@section('title', 'Tạo mới sản phẩm | FigureShop')

@php
    $status = [
        'public' => ['label' => 'Công khai', 'class' => 'bg-gray-200 text-gray-600'],
        'draft' => ['label' => 'Bản nháp', 'class' => 'bg-gray-200 text-gray-600'],
    ];
@endphp

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
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="price" class="block font-medium">Giá sản phẩm</label>
                        <input type="text" name="price" id="price"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="inStock" class="block font-medium">Số lượng</label>
                        <input type="text" name="inStock" id="inStock"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        @error('unit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="unit" class="block font-medium">Đơn vị tính</label>
                        <input type="text" name="unit" id="unit"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        @error('unit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
                        @error('discount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Mô tả sản phẩm</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Mô tả ngắn
                        </label>
                        <textarea name="shortDescription" class="min-h-[700px]">
                        Mô tả ngắn
                        </textarea>
                        @error('shortDescription')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block font-medium">Mô tả sản phẩm</label>
                        <textarea name="description" class="min-h-[700px]">
                        Mô tả sản phẩm
                        </textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Media</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" id="image" onchange="previewPostImages()"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <div id="postImagesPreview" class="flex gap-2 mt-2"></div>
                    </div>
                    <div>
                        <label for="name" class="block font-medium">Ảnh sản phẩm</label>
                        <input type="file" name="images[]" id="image" multiple onchange="previewProductsImages()"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <div id="ProductsImage" class="flex gap-2 mt-2"></div>
                    </div>

                </div>
            </div>
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Danh mục sản phẩm</h3>

                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Tên danh mục</label>
                        <select name="category_id" id="category_id"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">

                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Trạng thái</label>
                        <select name="status" id="status"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                            @foreach ($status as $key => $value)
                                <option value={{ $key }}>{{ $value['label'] }}</option>
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
    <script>
        // Preview a single featured image
        function previewCoverImage() {
            const file = document.querySelector('input[name="featured_image"]').files[0]; // Get the selected file
            const previewContainer = document.getElementById('coverImagePreview'); // Get the preview container

            if (file) {
                const reader = new FileReader();

                reader.onloadend = function() {
                    // Create an img element to display the preview
                    let imgElement = document.createElement('img');
                    imgElement.src = reader.result; // Set the image source
                    imgElement.style.width = '150px';
                    imgElement.style.height = 'auto';
                    imgElement.style.objectFit = 'cover';
                    imgElement.classList.add('rounded');

                    previewContainer.innerHTML = ''; // Clear old content
                    previewContainer.appendChild(imgElement); // Add the image to the preview
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        }

        // Preview multiple post images
        function previewPostImages() {
            const files = document.querySelector('input[name="thumbnail"]').files; // Get the selected files
            const preview = document.getElementById('postImagesPreview'); // Get the preview container
            preview.innerHTML = ''; // Clear old previews

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onloadend = function() {
                    // Create an img element to display each preview
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.alt = "Preview Post Image";
                    img.width = 100; // Set a fixed width for each preview
                    img.classList.add('rounded-md', 'border', 'border-gray-300', 'shadow-sm', 'p-1');
                    preview.appendChild(img); // Add the image to the preview
                };

                if (file) {
                    reader.readAsDataURL(file); // Read the file as a data URL
                }
            }
        }

        function previewProductsImages() {
            const files = document.querySelector('input[name="images[]"]').files; // Lấy danh sách file
            const previewContainer = document.getElementById('ProductsImage'); // Container preview
            previewContainer.innerHTML = ''; // Xóa nội dung cũ

            // Duyệt qua từng file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onloadend = function() {
                    // Tạo phần tử img để hiển thị preview
                    const img = document.createElement('img');
                    img.src = reader.result; // Set src từ file đã đọc
                    img.alt = "Preview Image";
                    img.width = 100; // Đặt chiều rộng cố định
                    img.classList.add('rounded-md', 'border', 'border-gray-300', 'shadow-sm', 'p-1');
                    previewContainer.appendChild(img); // Thêm vào container
                };

                if (file) {
                    reader.readAsDataURL(file); // Đọc file
                }
            }
        }
    </script>
@endsection
