@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')


    <form action="" method="POST">
        @csrf
        <div class="my-10 flex flex-col lg:flex-row gap-10 px-4">
            <div class="w-full lg:w-3/4">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">Thông tin giao hàng</h2>

                    <a class="flex items-center gap-2" href="{{ route('cart') }}" class="text-primary-600 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m6.921 12.5l5.439 5.439q.146.146.153.344q.006.198-.16.363q-.164.16-.353.163q-.188.002-.354-.163l-6.08-6.08q-.131-.132-.184-.268T5.329 12t.053-.298t.184-.267l6.08-6.081q.14-.14.341-.15q.202-.01.367.15q.165.165.165.356q0 .192-.165.357L6.92 11.5H18.5q.214 0 .357.143T19 12t-.143.357t-.357.143z">
                            </path>
                        </svg>
                        Quay lại giỏ hàng
                    </a>

                </div>
                <div class="bg-white shadow-md p-6 mt-4">
                    <form action="#" method="POST">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                                <input type="text" name="name" id="name" autocomplete="name"
                                    value="{{ $user->name }}"
                                    class="mt-1 focus
                            focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full
                            shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" autocomplete="email"
                                    value="{{ $user->email }}"
                                    class="mt-1 focus
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full
                                    shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                                <input type="text" name="address" id="address" autocomplete="address"
                                    class="mt-1 focus
                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full
                        shadow-sm sm:text-sm border-gray-300 rounded-md">

                            </div>
                            <!-- đặt hàng khi thanh toán-->
                            <div>
                                <label for="payment" class="block text-sm font-medium text-gray-700">Phương thức thanh
                                    toán</label>
                                <select id="payment" name="payment"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="cod">Thanh toán khi nhận hàng</option>
                                    <option value="vnpay">Thanh toán qua VnPay</option>
                                </select>
                            </div>
                        </div>




                        <div class="mt-6">
                            <label for="note" class="block text-sm font-medium text-gray-700">Ghi chú</label>
                            <textarea id="note" name="note" rows="3"
                                class="mt-1 focus focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full py-3 bg-primary-500 text-white font-semibold rounded-md bg-custom-purple hover:bg-custom-purple-light">
                                Đặt hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <section class="w-full lg:w-1/4 my-12">
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

                </div>
            </section>

        </div>
    </form>

@endsection
