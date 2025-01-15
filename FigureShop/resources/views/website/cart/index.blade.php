@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')

    <div class=" my-10 flex flex-col lg:flex-row gap-10 px-4">
        <!-- Desktop cart table -->
        <section class="w-full lg:w-3/4">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-neutral-100 text-left">
                    <tr class="text-sm text-gray-600 w-full p-2">
                        <th class="min-w-[120px] p-2">TÊN SẢN PHẨM</th>
                        <th class="min-w-[120px] p-2">GIÁ</th>
                        <th class="min-w-[120px] p-2">GIÁ GIẢM</th>
                        <th class="min-w-[120px] p-2">SỐ LƯỢNG</th>
                        <th class="min-w-[120px] p-2">TỘNG CỘNG</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotal = 0;
                    @endphp
                    @if ($cart && $cart->items->isEmpty())
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center">
                                <p class="text-lg text-gray-500">Không có sản phẩm nào trong giỏ hàng</p>
                                <a href="{{ route('products') }}">Mua hàng ngay</a>
                            </td>
                        </tr>
                    @elseif ($cart)
                        @foreach ($cart->items as $index => $item)
                            @php
                                $itemTotal =
                                    $item->quantity * $item->product->price * (1 - $item->product->discount / 100);
                                $grandTotal += $itemTotal;
                            @endphp
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
                                    <div x-data="{ quantity: {{ $item->quantity }}, total: {{ $itemTotal }} }" class="flex items-center">
                                        <button
                                            @click="quantity = Math.max(1, quantity - 1); total = quantity * {{ $item->product->price * (1 - $item->product->discount / 100) }}; updateTotal(quantity, {{ $item->product->price }}, {{ $item->product->discount }}, {{ $index }})"
                                            class="px-3 py-2 hover:bg-gray-200">−</button>
                                        <input type="text" x-model="quantity" class="px-4 py-2 w-20" min="1"
                                            id="quantity-{{ $index }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); total = quantity * {{ $item->product->price * (1 - $item->product->discount / 100) }}; updateTotal(quantity, {{ $item->product->price }}, {{ $item->product->discount }}, {{ $index }})" />
                                        <button
                                            @click="quantity++; total = quantity * {{ $item->product->price * (1 - $item->product->discount / 100) }}; updateTotal(quantity, {{ $item->product->price }}, {{ $item->product->discount }}, {{ $index }})"
                                            class="px-3 py-2 hover:bg-gray-200">+</button>
                                    </div>
                                </td>
                                <td class="py-2 px-2 text-gray-700" x-data="{ total: {{ $itemTotal }} }">
                                    <span x-text="formatCurrency(total)" id="total-{{ $index }}"></span>
                                </td>

                                <td class="py-2 px-2 text-gray-500">
                                    <form action="{{ route('cart.remove', $item->product->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <button class="hover:text-red-500" type="button" onclick="confirmUpdate(this, )">
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
                                <td class="py-2 px-2 text-gray-500">
                                    <form action="{{ route('cart.update', $item->product->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <input type="hidden" name="quantity" id="quantitySending-{{ $index }}"
                                            class="w-16 text-center">
                                        <button class="hover:text-red-500" type="button"
                                            onClick = "getQuantity({{ $index }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 16 16">
                                                <path fill="currentColor"
                                                    d="M7.46 2a5.52 5.52 0 0 0-3.91 1.61a5.44 5.44 0 0 0-1.54 2.97a.503.503 0 0 1-.992-.166a6.514 6.514 0 0 1 6.44-5.41a6.55 6.55 0 0 1 4.65 1.93l1.89 2.21v-2.64a.502.502 0 0 1 1.006 0v4a.5.5 0 0 1-.503.5h-3.99a.5.5 0 0 1-.503-.5c0-.275.225-.5.503-.5h2.91l-2.06-2.4a5.53 5.53 0 0 0-3.9-1.6zm1.09 12a5.52 5.52 0 0 0 3.91-1.61A5.44 5.44 0 0 0 14 9.42a.504.504 0 0 1 .992.166a6.514 6.514 0 0 1-6.44 5.41a6.55 6.55 0 0 1-4.65-1.93l-1.89-2.21v2.64a.501.501 0 0 1-.858.353a.5.5 0 0 1-.148-.354v-4c0-.276.225-.5.503-.5H5.5c.278 0 .503.224.503.5s-.225.5-.503.5H2.59l2.06 2.4a5.53 5.53 0 0 0 3.9 1.6z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <script>
                                        function getQuantity(index) {
                                            const quantity = document.getElementById('quantity-' + index).value;
                                            var quantitySending = document.getElementById('quantitySending-' + index);

                                            quantitySending.value = quantity;
                                            quantitySending.closest('form').submit();
                                        }
                                    </script>
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
                    <p>{{ format_currency($grandTotal) }}</p>
                </div>
                <div class="flex justify-between mb-4">
                    <p>VẬN CHUYỂN</p>
                    <p>Free</p>
                </div>
                <div class="flex justify-between font-bold text-lg mb-4">
                    <p>TỘNG CỘNG</p>
                    <p>{{ format_currency($grandTotal) }}</p>
                </div>
                <a href="{{ route('checkout.index') }}" class="block">
                    <button class="w-full bg-purple-900 text-white py-3 text-center hover:bg-purple-800">
                        Tiến hành thanh toán
                    </button>
                </a>
            </div>
        </section>
    </div>
@endsection
