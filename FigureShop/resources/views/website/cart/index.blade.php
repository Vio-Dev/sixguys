@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')

    <div class=" my-10 flex flex-col lg:flex-row gap-10 px-4">
        <!-- Desktop cart table -->
        <section class="w-full lg:w-3/4">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-neutral-100 text-left">
                    <tr class="text-sm text-gray-600 w-full">
                        <th class="min-w-[120px]">TÊN SẢN PHẨM</th>
                        <th class="min-w-[120px]">GIÁ</th>
                        <th class="min-w-[120px]">GIÁ GIẢM</th>
                        <th class="min-w-[120px]">SỐ LƯỢNG</th>
                        <th class="min-w-[120px]">TỘNG CỘNG</th>
                        <th class="min-w-[120px]">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart && $cart->items->isEmpty())
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center">
                                <p class="text-lg text-gray-500">Không có sản phẩm nào trong giỏ hàng</p>
                                <a href="{{ route('products') }}">Mua hàng ngay</a>
                            </td>
                        </tr>
                    @elseif ($cart)
                        @foreach ($cart->items as $index => $item)
                            <tr class="border-b">
                                <td class="py-2 px-2 flex items-center gap-4">
                                    <img src="{{ asset($item->product->thumbnail) }}" alt="{{ $item->product->name }}"
                                        class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <p class="font-bold text-lg">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $item->productVariant ? $item->productVariant->variantValue->value : '' }}
                                        </p>
                                    </div>
                                </td>

                                <td class="py-2 px-2 text-gray-700">
                                    {{ format_currency($item->product->price) }}
                                </td>
                                <td class="py-2 px-2 text-gray-700">
                                    {{ $item->product->discount }} %
                                </td>
                                <td class="py-2 px-2">
                                    <div x-data="{ quantity: {{ $item->quantity }}, total: {{ $item->quantity * $item->product->price * (1 - $item->product->discount / 100) }} }" class="flex items-center">
                                        <button
                                            @click="quantity = Math.max(1, quantity - 1); total = quantity * {{ $item->product->price * (1 - $item->product->discount / 100) }}; updateTotal(quantity, {{ $item->product->price }}, {{ $item->product->discount }}, {{ $index }})"
                                            class="px-3 py-2 hover:bg-gray-200">−</button>
                                        <input type="text" x-model="quantity" class="px-4 py-2 w-20" min="1"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); total = quantity * {{ $item->product->price * (1 - $item->product->discount / 100) }}; updateTotal(quantity, {{ $item->product->price }}, {{ $item->product->discount }}, {{ $index }})" />
                                        <button
                                            @click="quantity++; total = quantity * {{ $item->product->price * (1 - $item->product->discount / 100) }}; updateTotal(quantity, {{ $item->product->price }}, {{ $item->product->discount }}, {{ $index }})"
                                            class="px-3 py-2 hover:bg-gray-200">+</button>
                                    </div>
                                </td>
                                <td class="py-2 px-2 text-gray-700" x-data="{ total: {{ $item->quantity * $item->product->price * (1 - $item->product->discount / 100) }} }">
                                    <span x-text="formatCurrency(total)" id="total-{{ $index }}"></span>
                                </td>
                                <td class="py-2 px-2 text-gray-500">
                                    <form action="" method="post"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="hover:text-red-500" type="button" onclick="confirmUpdate(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="h-5 w-5">
                                                <path fill-rule="evenodd"
                                                    d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <script>
                                            function confirmUpdate(button) {
                                                Swal.fire({
                                                    title: 'Bạn có chắc chắn muốn Xóa?',
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

                                            function updateTotal(quantity, price, discount, index) {
                                                const totalElement = document.getElementById('total-' + index);
                                                const total = quantity * price * (1 - discount / 100);
                                                totalElement.innerText = formatCurrency(total);
                                            }

                                            function formatCurrency(amount) {
                                                return new Intl.NumberFormat('vi-VN', {
                                                    style: 'currency',
                                                    currency: 'VND'
                                                }).format(amount);
                                            }
                                        </script>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
                    <button class="w-full bg-purple-900 text-white py-3 text-center hover:bg-purple-800">
                        Tiến hành thanh toán
                    </button>
                </a>
            </div>
        </section>
    </div>
@endsection
