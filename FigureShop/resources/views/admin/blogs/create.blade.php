<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tạo bài đăng | FigureShop</title>
    <script src="https://cdn.tiny.cloud/1/rw1556z5vgoik9fmr5u44kck2kqrsou9fmbylvglsyjovwur/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</head>

<body>
    @extends('layouts.admin')
    @section('name', 'Tạo bài đăng | FigureShop')
    @section('content')
        <div class="flex justify-between items-center p-4">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Tạo bài đăng</h2>
            <a href="{{ Route('admin.blogs.list') }}" class="flex items-center gap-2 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span>Danh sách bài đăng</span>
            </a>
        </div>

        <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiêu đề bài
                    đăng</label>
                <input type="text" name="name" id="name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Nhập tiêu đề bài đăng">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Short Description -->
            <div class="mb-5">
                <label for="shortDecription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô tả
                    ngắn</label>
                <input type="text" name="shortDecription" id="shortDecription"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Nhập mô tả ngắn">
                @error('shortDecription')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-5">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trạng
                    thái</label>
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="draft">Bản nháp</option>
                    <option value="published">Đã đăng</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô tả</label>
                <textarea name="description" id="description"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Nhập nội dung bài đăng"></textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail -->
            <div class="mb-5">
                <label for="thumbnail" class="block font-medium">Ảnh trong bài viết</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" multiple
                    onchange="previewPostImages()" class="w-full p-2 border border-gray-300 rounded-md">
                <div id="postImagesPreview" class="flex gap-2 mt-2"></div>
            </div>


            <div class="flex justify-end gap-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Tạo Bài đăng
                </button>
                <a href="{{ route('admin.blogs.list') }}"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Hủy
                </a>
            </div>
        </form>
    @endsection
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
    </script>


</body>

</html>
