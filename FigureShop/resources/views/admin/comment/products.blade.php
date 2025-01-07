@extends('layouts.admin')
@section('title', 'Danh sách bình luận sản phẩm | FigureShop')

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Quản lý bình luận sản phẩm</h2>
        </div>
        {{-- <div class="py-4">
            <form action="{{ route('admin.categories.search') }}" method="POST">
                @csrf
                <input type="text" name="search" placeholder="Tìm kiếm danh mục"
                    class="p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Tìm kiếm</button>
            </form>
        </div> --}}
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mt-3">

        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tên người bình luận</th>
                    <th scope="col" class="px-6 py-3">Nội dung</th>
                    <th scope="col" class="px-6 py-3">số sao</th>
                    <th scope="col" class="px-6 py-3">Bài đăng</th>
                    <th scope="col" class="px-6 py-3">Bình luận</th>

                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $comment->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $comment->comment }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $comment->rating }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $comment->product->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $comment->isHidden ? 'Đã ẩn' : 'Hiển thị' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap flex gap-2  text-sm font-medium text-left dark:text-white">
                            <form action="{{ route('admin.comments.updateProduct', ['id' => $comment->id]) }}"
                                method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <input type="text" name="id" value="{{ $comment->id }}" hidden>
                                <button type="submit" class="focus:outline-none">Ẩn</button>

                            </form>
                            <form action="{{ route('admin.comments.deleteProduct', ['id' => $comment->id]) }}"
                                method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this)"
                                    class="text-red-600 hover:text-red-900 focus:outline-none">Xóa</button>
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

        @if ($comments->count())
            <div class="mt-4 p-3">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
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
@endsection
