@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm | FigureShop')

@php
    $status = [
        'public' => ['label' => 'Đã đăng', 'class' => 'bg-green-200 text-gray-600'],
        'outOfStock' => ['label' => 'Hết Hàng', 'class' => 'bg-red-200 text-gray-600'],
        'draft' => ['label' => 'Nháp', 'class' => 'bg-gray-200 text-gray-600'],
    ];
@endphp

@section('content')

    <div>

        <div class="py-4">
            <form action="">
                @csrf
                <input type="text" placeholder="Tìm kiếm sản phẩm"
                    class="p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Tìm kiếm</button>
            </form>

        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">

                            Tên sản phẩm
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Giá
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Số lượng
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Đã bán
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Trạng thái
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Danh mục
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hành động

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->isEmpty())
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="7" class="px-6 py-4 text-center">Không có sản phẩm nào</td>
                        </tr>
                    @else
                        @foreach ($products as $product)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span>
                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}"
                                            class="h-20 w-20 object-cover">
                                    </span>
                                    <span>
                                        {{ $product->name }}
                                    </span>
                                </th>
                                <td class="px-6 py-4">
                                    {{ format_currency($product->price) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->inStock }} - {{ $product->unit }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->hasSold }} - {{ $product->unit }}
                                </td>
                                <td class="">
                                    @foreach ($status as $key => $value)
                                        @if ($product->status == $key)
                                            <div
                                                class="{{ $value['class'] }} p-2 w-full font-semibold text-center leading-tight rounded-lg">
                                                {{ $value['label'] }}</div>
                                        @endif
                                    @endforeach

                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->category->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    <form action="{{ route('admin.bin.products.update', $product->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmUpdate(this)"
                                            class="font-medium text-blue-600 dark:text-red-500 hover:underline">Khôi
                                            phục</button>
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
                                    <form action="{{ route('admin.bin.products.destroy', $product->id) }}" method="POST"
                                        class="inline">
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


    </div>
@endsection
