@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
    <div class=" my-10 flex flex-col lg:flex-row gap-10 px-4">
        <!-- Desktop cart table -->
        <section class="w-full lg:w-3/4">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-neutral-100 text-left">
                    <tr class="text-sm text-gray-600">
                        <th class="py-4 px-4">MỤC</th>
                        <th class="py-4 px-4">GIÁ</th>
                        <th class="py-4 px-4">SỐ LƯỢNG</th>
                        <th class="py-4 px-4">TỘNG CỘNG</th>
                        <th class="py-4 px-4"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Repeat for each product -->
                    <tr class="border-b">
                        <td class="py-4 px-4 flex items-center gap-4">
                            <img src="./assets/images/bedroom.png" alt="Product Image"
                                class="w-20 h-20 object-cover rounded">
                            <div>
                                <p class="font-bold text-lg">ITALIAN BED</p>
                                <p class="text-sm text-gray-500">Size: XL</p>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-gray-700">$320</td>
                        <td class="py-4 px-4">
                            <div class="flex items-center ">
                                <button class="px-3 py-2 hover:bg-gray-200">−</button>
                                <input class="px-4 py-2  w-20" value="1" min="1"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                <button class="px-3 py-2 hover:bg-gray-200">+</button>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-gray-700">$320</td>
                        <td class="py-4 px-4 text-gray-500">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <!-- Repeat ends -->
                </tbody>
            </table>
        </section>
        <!-- Order Summary -->
        <section class="w-full lg:w-1/4">
            <div class="border bg-white shadow-md p-6">
                <h2 class="text-lg font-bold mb-4">TÓM TẮT ĐƠN HÀNG</h2>
                <div class="flex justify-between mb-4">
                    <p>TỘNG PHỤ</p>
                    <p>$1280</p>
                </div>
                <div class="flex justify-between mb-4">
                    <p>VẬN CHUYỂN</p>
                    <p>Free</p>
                </div>
                <div class="flex justify-between font-bold text-lg mb-4">
                    <p>TỘNG CỘNG</p>
                    <p>$1280</p>
                </div>
                <a href="{{ route('checkout') }}" class="block">
                    <button class="w-full bg-purple-900 text-white py-3 text-center">
                        Tiến hành thanh toán
                    </button>
                </a>
            </div>
        </section>
    </div>
@endsection
