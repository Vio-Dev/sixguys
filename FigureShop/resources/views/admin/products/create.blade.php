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
        <div class="flex gap-4">
            <button type="button" id="simpleProductBtn" class="py-2 px-4 bg-blue-500 text-white rounded-md"
                aria-pressed="true">
                Sản phẩm đơn
            </button>
            <button type="button" id="variantProductBtn" class="py-2 px-4 bg-gray-300 text-black rounded-md"
                aria-pressed="false">
                Sản phẩm có biến thể
            </button>
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
                        @error('inStock')
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
                        <label for="thumbnail" class="block font-medium">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" id="thumbnail" onchange="previewPostImages()"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <div id="postImagesPreview" class="flex gap-2 mt-2"></div>
                        @error('thumbnail')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block font-medium">Ảnh sản phẩm</label>
                        <input type="file" name="images[]" id="image" multiple onchange="previewProductsImages()"
                            class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <div id="ProductsImage" class="flex gap-2 mt-2"></div>
                        @error('images')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
            <div id="variantSection" class="hidden mt-4">
                <div>
                    <h2>Biến Thể</h2>
                </div>
                <div class="p-2 shadow-md sm:rounded-lg" x-data="variantManager()">
                    <template x-for="(variant, index) in variants" :key="index">
                        <div class="grid grid-cols-2 gap-4 variant-item">
                            <div class="w-full">
                                <label for="variant_name" class="block font-medium">Tên biến thể</label>
                                <select :name="'variant_name[' + index + ']'" x-model="variant.name"
                                    class="variant_name w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                                    <option value="">Chọn biến thể</option>
                                    @foreach ($adminVariants as $variant)
                                        <option :value="{{ $variant->id }}">{{ $variant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="variant_values" class="block font-medium">Giá trị biến thể</label>
                                <select :name="'variant_values[' + index + ']'" x-model="variant.value"
                                    class="variant_values w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                                    <option value="">Chọn giá trị</option>
                                    @foreach ($adminVariants as $variant)
                                        @if ($variant->values->count())
                                            @foreach ($variant->values as $value)
                                                <option :value="{{ $value->id }}"
                                                    data-variant-id="{{ $variant->id }}">{{ $value->value }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="variant_price" class="block font-medium">Giá biến thể</label>
                                <input type="text" :name="'variant_price[' + index + ']'" x-model="variant.price"
                                    class="variant_price w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                                @error('variant_price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="variant_inStock" class="block font-medium">Số lượng</label>
                                <input type="text" :name="'variant_inStock[' + index + ']'" x-model="variant.inStock"
                                    class="variant_inStock w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                                @error('variant_inStock')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="button" @click="removeVariant(index)"
                                class="remove-variant bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded mt-2">Xóa</button>
                        </div>
                    </template>
                    <button type="button" @click="addVariant"
                        class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded mt-2">Thêm biến thể</button>
                </div>

                <script>
                    function variantManager() {
                        return {
                            variants: [{
                                name: '',
                                value: '',
                                price: '',
                                inStock: ''
                            }],
                            addVariant() {
                                this.variants.push({
                                    name: '',
                                    value: '',
                                    price: '',
                                    inStock: ''
                                });
                            },
                            removeVariant(index) {
                                this.variants.splice(index, 1);
                            }
                        }
                    }
                </script>

            </div>
            <div class="">
                <button type="submit" class="bg-blue-500 p-2 rounded-md text-white">Tạo sản phẩm</button>
                <a href={{ route('admin.products.list') }} class="bg-red-500 p-2 rounded-md text-white">Hủy</a>
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

        const simpleProductBtn = document.getElementById('simpleProductBtn');
        const variantProductBtn = document.getElementById('variantProductBtn');

        // Hàm để kích hoạt trạng thái nút
        function activateButton(activeBtn, inactiveBtn) {
            // Kích hoạt nút được chọn
            activeBtn.classList.add('bg-blue-500', 'text-white');
            activeBtn.classList.remove('bg-gray-300', 'text-black');
            activeBtn.setAttribute('aria-pressed', 'true');

            // Vô hiệu hóa nút không được chọn
            inactiveBtn.classList.add('bg-gray-300', 'text-black');
            inactiveBtn.classList.remove('bg-blue-500', 'text-white');
            inactiveBtn.setAttribute('aria-pressed', 'false');
        }

        // Gắn sự kiện click cho các nút
        simpleProductBtn.addEventListener('click', () => {
            activateButton(simpleProductBtn, variantProductBtn);
            document.getElementById('variantSection').classList.add('hidden'); // Ẩn phần biến thể
        });

        variantProductBtn.addEventListener('click', () => {
            activateButton(variantProductBtn, simpleProductBtn);
            document.getElementById('variantSection').classList.remove('hidden'); // Hiện phần biến thể
        });
    </script>
@endsection
