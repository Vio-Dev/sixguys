@extends('layouts.admin')
@section('title', 'Danh sách bài đăng | FigureShop')

@section('content')
    @php
        $statusData = [
            'draft' => ['label' => 'Bản nháp', 'class' => 'bg-gray-200 text-gray-600'],
            'published' => ['label' => 'Đã đăng', 'class' => 'bg-green-100 text-green-600'],
        ];
    @endphp


    <div class="py-2 ">
        <h2 class="text-[24px] font-bold">Danh sách bài đăng</h2>
    </div>
    <div class="py-4">
        <a href="{{ route('admin.blogs.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tạo mới bài đăng</a>
    </div>
    <div class="py-4">
        <form action="">
            @csrf
            <input type="text" placeholder="Tìm kiếm bài đăng"
                class="p-2 border border-gray-300 dark:border-gray-700 rounded-md">
            <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Tìm kiếm</button>
        </form>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mt-3">
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tiêu đề bài đăng</th>
                    <th scope="col" class="px-6 py-3 text-center">Mô tả ngắn</th>
                    <th scope="col" class="px-6 py-3 text-center">Trạng thái</th>
                    <th scope="col" class="px-6 py-3 text-center">Người tạo</th>
                    <th scope="col" class="px-6 py-3 text-center">Ngày tạo</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                        <td scope="row"
                            class=" flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ asset($blog->thumbnail) }}" class=" object-cover w-15 h-15"
                                alt="{{ $blog->name }}">
                            {{ $blog->name }}

                        </td>
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $blog->shortDecription }}
                        </td>
                        <td scope="row" class="">
                            <div
                                class="px-2 py-1 w-full font-semibold text-center leading-tight rounded-full {{ $statusData[$blog->status]['class'] ?? 'bg-gray-200 text-gray-600' }}">
                                {{ $statusData[$blog->status]['label'] ?? 'Không xác định' }}
                            </div>
                        </td>

                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $blog->user->name }}
                        </td>
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $blog->created_at->format('d/m/Y H:i') }}
                        </td>

                        {{-- <td class="flex px-6 py-4" scope="row">
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="ms-3">
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
                        <td class="px-6 py-4">
                            <a
                                href="{{ route('admin.blogs.edit', $blog->id) }}"class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline">
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Không có bài đăng nào.</td>
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
