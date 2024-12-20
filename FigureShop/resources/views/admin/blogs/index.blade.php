@extends('layouts.admin')
@section('title', 'Danh sách bài đăng | FigureShop')

@section('content')
    <div>
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Danh sách bài đăng</h1>
            <a href={{ route('admin.blogs.create') }}
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Thêm mới</a>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mt-3">
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tiêu đề bài đăng</th>
                    <th scope="col" class="px-6 py-3">Mô tả ngắn</th>
                    <th scope="col" class="px-6 py-3">Trạng thái</th>
                    <th scope="col" class="px-6 py-3">Người tạo</th>
                    <th scope="col" class="px-6 py-3">Ngày tạo</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $blog->name }}
                        </th>
                        {{-- <td class="flex items-center px-6 py-4">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    class="ms-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Xóa</button>
                                    <script>
                                        function confirmDelete(button) {
                                            Swal.fire({
                                                title: 'Bạn có chắc chắn muốn xóa?',
                                                text: "Hành động này không thể hoàn tác!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Xóa',
                                                cancelButtonText: 'Hủy'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Nếu người dùng xác nhận, submit form
                                                    button.closest('form').submit();
                                                }
                                            });
                                        }
                                    </script>
                                </form>
                            </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Không có danh mục nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Phân trang -->
        <div class="mt-4 p-3">
            {{ $blogs->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
