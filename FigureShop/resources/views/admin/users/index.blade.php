@extends('layouts.admin')
@section('title', 'Danh sách người dùng | FigureShop')

@section('content')
    <div class="py-2 ">
        <h2 class="text-[24px] font-bold">Danh sách người dùng</h2>
    </div>
    <div class="py-4">
        <a href="{{ route('admin.users.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tạo mới người dùng</a>
    </div>
    <form action="">
        @csrf
        @method('GET')
        <div class="flex items-center">
            <input type="text" name="search" id="search" placeholder="Tìm kiếm người dùng"
                class="w-1/3 border border-gray-300 p-2 rounded-lg">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Tìm
                kiếm</button>
        </div>
    </form>
    <div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tên người dùng
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Số điện thoại
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Trạng thái
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ghi chú
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hành động
                    </th>
                </tr>
            </thead>
            <tbody>

                @if ($users->isEmpty())
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td colspan="7" class="px-6 py-4 text-center">Không có người dùng nào</td>
                    </tr>
                @else
                    @foreach ($users as $user)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{-- <span>
                                    @if ($user->avatar == null)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 16 16">
                                            <path fill="currentColor"
                                                d="M11 7c0 1.66-1.34 3-3 3S5 8.66 5 7s1.34-3 3-3s3 1.34 3 3" />
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M16 8c0 4.42-3.58 8-8 8s-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8M4 13.75C4.16 13.484 5.71 11 7.99 11c2.27 0 3.83 2.49 3.99 2.75A6.98 6.98 0 0 0 14.99 8c0-3.87-3.13-7-7-7s-7 3.13-7 7c0 2.38 1.19 4.49 3.01 5.75"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <img src="{{ asset($user->avatar) }}" alt="{{ $user->avatar }}"
                                            class="h-20 w-20 object-cover">
                                    @endif
                                </span> --}}
                                <span>
                                    {{ $user->name }}
                                </span>
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if (!$user->phone)
                                    <span>Trống</span>
                                @else
                                    {{ $user->phone }}
                                @endif
                            </td>


                            <td class="px-6 py-4">
                                @if ($user->status == 0)
                                    <div
                                        class="bg-green-200 text-green-600 dark:bg-green-700 dark:text-green-100 rounded-full w-full p-2 text-xs text-center">
                                        Đang
                                        hoạt động</div>
                                @else
                                    <div
                                        class="bg-red-200 text-red-600 dark:bg-red-700 dark:text-red-100 rounded-full w-full p-2 text-xs text-center">
                                        Đã
                                        khóa</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->note }}
                            </td>

                            <td class="px-6 py-4 ">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
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
                    @endforeach
                @endif


            </tbody>
        </table>
    </div>
@endsection
