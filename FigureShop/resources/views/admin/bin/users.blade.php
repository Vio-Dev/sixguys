@extends('layouts.admin')
@section('title', 'Danh sách người dùng | FigureShop')

@section('content')
    <div class="py-2 ">
        <h2 class="text-[24px] font-bold">Danh sách người dùng</h2>
    </div>


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


                            <td class="px-6 py-4 flex justify-center">
                                <span
                                    class="px-2 py-1 text-xs font-semibold leading-tight {{ $user->status == 0 ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }} rounded-full">
                                    {{ $user->status == 0 ? 'Hoạt động' : 'Khóa' }}
                                </span>

                            </td>
                            <td class="px-6 py-4">
                                {{ $user->note }}
                            </td>

                            <td class="px-6 py-4 ">
                                 <form action="{{ route('admin.bin.users.update', $user->id) }}" method="POST" class="inline">
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
                                <form action="{{ route('admin.bin.users.destroy', $user->id) }}" method="POST" class="inline">
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
