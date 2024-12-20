<<<<<<< Updated upstream
=======
@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm | FigureShop')

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
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">
                            50000000
                        </td>
                        <td class="px-6 py-4">
                            100 Cái
                        </td>
                        <td class="px-6 py-4">
                            100 Cái
                        </td>
                        <td class="">
                            <div
                                class="px-2 py-1 w-full font-semibold text-center leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Active
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4 ">
                            <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline p-2">Sửa</button>
                            <button class="font-medium text-red-600 dark:text-blue-500 hover:underline p-2">Xóa</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>
@endsection
>>>>>>> Stashed changes
