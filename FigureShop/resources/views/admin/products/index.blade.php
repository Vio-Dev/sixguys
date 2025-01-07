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
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Danh sách sản phẩm</h2>
        </div>
        <div class="py-4">
            <a href="{{ route('admin.products.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tạo mới sản phẩm</a>
        </div>
        <div class="py-4">
            <form action="{{ route('admin.products.search') }}" method="POST">
                @csrf
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm"
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
                        <th class="px-6 py-3">Biến thể</th>
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
                                    {{ $product->inStock }} {{ $product->unit }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->hasSold }} {{ $product->unit }}
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
                                <td class="px-6 py-4">
                                    @if ($product->variants->count())
                                        <ul>
                                            @foreach ($product->variants as $variant)
                                                <li>
                                                    {{ $variant->variantValue->variant->name }}:
                                                    {{ $variant->variantValue->value }} -
                                                    {{ number_format($variant->price, 0, ',', '.') }} VND
                                                    -{{ $variant->inStock }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Không có biến thể</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 ">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
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
            <div class="p-5">
                {{ $products->links() }}
            </div>
        </div>


    </div>
@endsection
