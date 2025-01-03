@extends('layouts.admin')
@section('title', 'Danh sách danh mục | FigureShop')

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Danh sách danh mục</h2>
        </div>

        <div class="py-4">
            <form action="">
                @csrf
                <input type="text" placeholder="Tìm kiếm danh mục"
                    class="p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div>

        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Tạo danh mục</h2>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mt-3">
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tên danh mục</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($binCategories as $category)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->name }}
                        </th>
                        <td class="flex items-center px-6 py-4">
                            <form action="{{ route('admin.bin.category.update', $category->id) }}" method="POST"
                                class="ms-3">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmUpdate(this)"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Khôi phục</button>
                                <script>
                                    function confirmUpdate(button) {
                                        Swal.fire({
                                            title: 'Bạn có chắc chắn muốn khôi phục?',
                                            text: "Hành động này không thể hoàn tác!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Khôi phục',
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
                            <form action="{{ route('admin.bin.category.destroy', $category->id) }}" method="POST"
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">Không có danh mục nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Phân trang -->
        <div class="mt-4 p-3">
            {{ $binCategories->links('pagination::tailwind') }}
        </div>
    </div>


@endsection
