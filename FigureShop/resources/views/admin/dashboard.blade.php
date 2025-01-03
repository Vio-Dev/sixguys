@extends('layouts.admin')

@section('title', 'Trang quản lý bán hàng')

@section('content')
    <div class="w-full">
        <h1 class="text-2xl font-semibold">Trang quản lý bán hàng</h1>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6 ">
            <!-- Card 1 -->
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10l4.553-4.553a3 3 0 00-4.243-4.243L10.757 5.757M5 19h4a2 2 0 002-2v-5H5v7z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold mt-4">$3.456K</h2>
                <p class="text-gray-500">Tổng bài đăng</p>

            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3zm6 6h6M9 9v6M15 9v6" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold mt-4">$45.2K</h2>
                <p class="text-gray-500">Tổng lợi nhuận</p>

            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12M6 12h12M6 16h12" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold mt-4">2,450</h2>
                <p class="text-gray-500">Tổng sản phẩm</p>

            </div>

            <!-- Card 4 -->
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5a2 2 0 002-2v-2a2 2 0 00-2-2h-5v6zm-6 0h-5a2 2 0 01-2-2v-2a2 2 0 012-2h5v6zM4 8a2 2 0 002-2V6a2 2 0 00-2-2 2 2 0 00-2 2v2a2 2 0 002 2zm10 0a2 2 0 002-2V6a2 2 0 00-2-2 2 2 0 00-2 2v2a2 2 0 002 2zM12 16v2a2 2 0 11-2 2h4a2 2 0 11-2-2z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold mt-4">3,456</h2>
                <p class="text-gray-500">Tổng số người dùng</p>

            </div>
        </div>

    </div>
@endsection
