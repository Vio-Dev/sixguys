@extends('layouts.admin')

@section('title', 'Cập nhật sản phẩm | FigureShop')


@php
    $status = [
        'public' => ['label' => 'Công khai', 'class' => 'bg-gray-200 text-gray-600'],
        'draft' => ['label' => 'Bản nháp', 'class' => 'bg-gray-200 text-gray-600'],
    ];
@endphp

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Cập nhật sản phẩm</h2>
        </div>
        <form action={{ route('admin.products.update', ['id' => $product->id]) }} method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-4" type="submit">
            @csrf
            @method('PUT')
            <div class="p-2 shadow-md sm:rounded-lg">
                <h3 class="text-[18px] font-medium">Thông tin sản phẩm</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="w-full">
                        <label for="name" class="block font-medium">Tên sản
                            phẩm</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="price" class="block font-medium">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="{{ $product->price }}"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="inStock" class="block font-medium">Số lượng</label>
                        <input type="text" name="inStock" id="inStock" value="{{ $product->inStock }}"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        @error('unit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="unit" class="block font-medium">Đơn vị tính</label>
                        <input type="text" name="unit" id="unit" value="{{ $product->unit }}"
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
                        <input type="text" name="discount" id="discount" value="{{ $product->discount }}"
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
                        <textarea name="shortDescription">
                        {{ $product->shortDescription }}
                        </textarea>
                        @error('shortDescription')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block font-medium">Mô tả sản phẩm</label>
                        <textarea name="description">
                       {{ $product->description }}
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
                        <label for="thumbnailInput" class="block font-medium">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" id="thumbnailInput" onchange="previewPostImages()"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <div id="postImagesPreview" class="flex gap-2 mt-2"></div>
                        <img id="defaultthumbnail" src="{{ asset($product->thumbnail) }}" alt="Default Image"
                            class="w-20 h-20 object-cover rounded-md border border-gray-300">
                    </div>
                    <div>
                        <label for="imagesInput" class="block font-medium">Ảnh sản phẩm</label>
                        <input type="file" name="images[]" id="imagesInput" multiple onchange="previewProductsImages()"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <div id="ProductsImage" class="flex gap-2 mt-2"></div>
                        <div class="flex gap-2 mt-2">
                            @foreach ($images as $image)
                                <img id="defaultProductsImages" src="{{ asset($image->url_img) }}" alt="Product Image"
                                    class="w-20 h-20 object-cover rounded-md border border-gray-300">
                            @endforeach
                        </div>

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
        function previewPostImages() {
            const file = document.querySelector('#thumbnailInput').files[0]; // Lấy file đầu tiên
            const preview = document.getElementById('postImagesPreview'); // Lấy container preview
            const defaultThumbnail = document.getElementById('defaultthumbnail'); // Lấy ảnh mặc định

            preview.innerHTML = ''; // Xóa nội dung cũ

            if (file && file.type.startsWith('image/')) {
                // Ẩn ảnh mặc định
                if (defaultThumbnail) {
                    defaultThumbnail.style.display = 'none';
                }

                const reader = new FileReader();
                reader.onloadend = function() {
                    const img = document.createElement('img');
                    img.src = reader.result; // Gán ảnh mới vào src
                    img.alt = "New Thumbnail";
                    img.width = 100; // Đặt chiều rộng cố định
                    img.classList.add('rounded-md', 'border', 'border-gray-300', 'shadow-sm', 'p-1');
                    preview.appendChild(img); // Thêm ảnh mới vào preview
                };
                reader.readAsDataURL(file); // Đọc file
            } else {
                alert('Vui lòng chọn tệp ảnh hợp lệ.');
            }
        }



        function previewProductsImages() {
            const files = document.querySelector('#imagesInput').files; // Lấy danh sách file
            const previewContainer = document.getElementById('ProductsImage'); // Container preview
            const defaultImages = document.getElementById('defaultProductsImages'); // Lấy tất cả ảnh mặc định

            previewContainer.innerHTML = ''; // Xóa nội dung cũ

            // Ẩn tất cả ảnh mặc định
            defaultImages.forEach(image => {
                image.style.display = 'none';
            });

            if (files.length === 0) {
                alert('Vui lòng chọn ít nhất một ảnh.');
                return;
            }

            // Hiển thị từng file ảnh
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.startsWith('image/')) {
                    alert(`Tệp "${file.name}" không phải là ảnh hợp lệ.`);
                    continue;
                }

                const reader = new FileReader();
                reader.onloadend = function() {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.alt = `Image ${i + 1}`;
                    img.width = 100; // Đặt chiều rộng cố định
                    img.classList.add('rounded-md', 'border', 'border-gray-300', 'shadow-sm', 'p-1');
                    previewContainer.appendChild(img); // Thêm ảnh mới vào container preview
                };
                reader.readAsDataURL(file); // Đọc file
            }
        }
    </script>
@endsection
