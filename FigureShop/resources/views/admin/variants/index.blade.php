@extends('layouts.admin')

@section('title', 'Danh sách biến thể | FigureShop')

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Quản lý biến thể</h2>
        </div>
        <div class="py-4">
            <form action="{{ route('admin.variants.search') }}" method="POST">
                @csrf
                <input type="text" name="search" placeholder="Tìm kiếm biến thể"
                    class="p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mt-3">
        <div class="py-2 flex gap-2 items-center">
            <h2 class="text-[24px] font-bold">Danh sách biến thể</h2>
            <a href="{{ route('admin.variants.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded mt-2">Tạo biến thể</a>
        </div>
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Tên biến thể</th>
                    <th scope="col" class="px-6 py-3">Giá trị</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminVariants as $variant)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $variant->name }}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($variant->values->count())
                                {{ $variant->values->pluck('value')->implode(', ') }}
                            @else
                                <p>Không có giá trị nào</p>
                            @endif
                        </td>
                        {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $variant->variant_values->pluck('value')->join(', ') }}
                        </th> --}}
                        <td class="flex items-center gap-2 px-6 py-4">
                            <a href="{{ route('admin.variants.edit', $variant->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa biến thể</a>
                            <a href="{{ route('admin.variants.edit', $variant->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa giá trị</a>
                            <form action="{{ route('admin.variants.destroy', $variant->id) }}" method="POST"
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
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td colspan="2" class="px-6 py-4 text-center">Không có biến thể nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
