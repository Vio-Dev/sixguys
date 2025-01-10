@extends('layouts.profile')

@section('title', 'Order')

@section('content')
    <!-- Mobile order table  -->

    @php
        $classOrder = [
            'pending' => 'border-blue-800 text-blue-800',
            'processing' => 'border-orange-800 text-orange-800',
            'confirmed' => 'border-green-800 text-green-800',
            'shipping' => 'border-purple-800 text-purple-800',
            'completed' => 'border-green-800 text-green-800',
            'cancelled' => 'border-red-800 text-red-800',
            'refunded' => 'border-blue-800 text-blue-800',
            'failed' => 'border-red-800 text-red-800',
        ];
        $vietSubStatusOrder = [
            'pending' => 'Đợi xác thực',
            'processing' => 'Đang xử lý',
            'confirmed' => 'Đã xác thực',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy đơn',
            'refunded' => 'Hoàn tiền',
            'failed' => 'Thất bại',
        ];
        $isPaidStatus = [
            '0' => 'Chưa thanh toán',
            '1' => 'Đã thanh toán',
        ];
    @endphp

    <section class="container mx-auto my-3 flex w-full flex-col gap-3 px-4 md:hidden">
        <!-- 1 -->
        @foreach ($orders as $order)
            <div class="flex w-full border px-4 py-4">
                <div class="ml-3 flex w-full flex-col justify-center">
                    <div class="flex items-center justify-between">
                        <p class="text-xl font-bold">{{ $order->id }}</p>
                        <div class="border{{ $classOrder[$order->status] }} px-2 py-1 ">
                            {{ $vietSubStatusOrder[$order->status] }}
                        </div>
                    </div>
                    <p class="text-sm text-gray-400">{{ $order->order_date }}</p>
                    <p class="py-3 text-xl font-bold text-violet-900">{{ format_currency($order->total) }}</p>
                    <div class="mt-2 flex w-full items-center justify-between">
                        <div class="flex items-center justify-center">
                            <button href="#" title="Xem chi tiết"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                        <path
                                            d="M12 8.25a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5M9.75 12a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0" />
                                        <path
                                            d="M12 3.25c-4.514 0-7.555 2.704-9.32 4.997l-.031.041c-.4.519-.767.996-1.016 1.56c-.267.605-.383 1.264-.383 2.152s.116 1.547.383 2.152c.25.564.617 1.042 1.016 1.56l.032.041C4.445 18.046 7.486 20.75 12 20.75s7.555-2.704 9.32-4.997l.031-.041c.4-.518.767-.996 1.016-1.56c.267-.605.383-1.264.383-2.152s-.116-1.547-.383-2.152c-.25-.564-.617-1.041-1.016-1.56l-.032-.041C19.555 5.954 16.514 3.25 12 3.25M3.87 9.162C5.498 7.045 8.15 4.75 12 4.75s6.501 2.295 8.13 4.412c.44.57.696.91.865 1.292c.158.358.255.795.255 1.546s-.097 1.188-.255 1.546c-.169.382-.426.722-.864 1.292C18.5 16.955 15.85 19.25 12 19.25s-6.501-2.295-8.13-4.412c-.44-.57-.696-.91-.865-1.292c-.158-.358-.255-.795-.255-1.546s.097-1.188.255-1.546c.169-.382.426-.722.864-1.292" />
                                    </g>
                                </svg>
                            </button>

                            @if ($order->status != 'processing')
                                <a href="#" title="Hủy đơn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 48 48">
                                        <path fill="#d50000"
                                            d="M24 6C14.1 6 6 14.1 6 24s8.1 18 18 18s18-8.1 18-18S33.9 6 24 6m0 4c3.1 0 6 1.1 8.4 2.8L12.8 32.4C11.1 30 10 27.1 10 24c0-7.7 6.3-14 14-14m0 28c-3.1 0-6-1.1-8.4-2.8l19.6-19.6C36.9 18 38 20.9 38 24c0 7.7-6.3 14-14 14" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- 2 -->

    </section>
    <!-- /Mobile order table  -->

    <!-- Order table  -->
    <section class="hidden h-[600px] w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10 lg:grid">
        <table class="table-fixed">
            <thead class="h-16 bg-neutral-100">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng cộng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1 -->
                @foreach ($orders as $order)
                    <tr class="h-[100px] border-b">
                        <td class="text-center align-middle">{{ $order->id }}</td>
                        <td class="mx-auto text-center">{{ $order->order_date }}</td>
                        <td class="text-center align-middle">{{ format_currency($order->total) }}</td>

                        <td class="mx-auto text-center">
                            <span class="border-2  py-1 px-3 {{ $classOrder[$order->status] }}">
                                {{ $vietSubStatusOrder[$order->status] }}
                            </span>
                        </td>
                        <td class="text-center align-middle">
                            <div x-data="{ modalIsOpen: false }">
                                <div class="flex justify-center items-center">
                                    <form action="{{ route('orders.detailOrder', $order->id) }}" method="GET"
                                        onsubmit="viewDetailOrder(event, {{ $order->id }})">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class=""><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24">
                                                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                    <path
                                                        d="M12 8.25a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5M9.75 12a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0" />
                                                    <path
                                                        d="M12 3.25c-4.514 0-7.555 2.704-9.32 4.997l-.031.041c-.4.519-.767.996-1.016 1.56c-.267.605-.383 1.264-.383 2.152s.116 1.547.383 2.152c.25.564.617 1.042 1.016 1.56l.032.041C4.445 18.046 7.486 20.75 12 20.75s7.555-2.704 9.32-4.997l.031-.041c.4-.518.767-.996 1.016-1.56c.267-.605.383-1.264.383-2.152s-.116-1.547-.383-2.152c-.25-.564-.617-1.041-1.016-1.56l-.032-.041C19.555 5.954 16.514 3.25 12 3.25M3.87 9.162C5.498 7.045 8.15 4.75 12 4.75s6.501 2.295 8.13 4.412c.44.57.696.91.865 1.292c.158.358.255.795.255 1.546s-.097 1.188-.255 1.546c-.169.382-.426.722-.864 1.292C18.5 16.955 15.85 19.25 12 19.25s-6.501-2.295-8.13-4.412c-.44-.57-.696-.91-.865-1.292c-.158-.358-.255-.795-.255-1.546s.097-1.188.255-1.546c.169-.382.426-.722.864-1.292" />
                                                </g>
                                            </svg></button>
                                    </form>

                                    <script>
                                        function viewDetailOrder(e, orderId) {
                                            e.preventDefault();
                                            const modalDetailOrder = document.getElementById('modalDetailOrder');
                                            const listProductInOrder = document.getElementById('listProductInOrder');

                                            modalDetailOrder.classList.remove('hidden');

                                            const baseUrl = `{{ route('home') }}`;

                                            var url = `{{ route('orders.detailOrder', '') }}` + `/` + orderId;
                                            fetch(url)
                                                .then(response => response.text())
                                                .then(data => {
                                                    data = JSON.parse(data);
                                                    listProductInOrder.innerHTML = data.map(product => `
                                                    <tr>
                                                        <td class="px-6 py-4">${product.id}</td>
                                                        <td class="px-6 py-4 flex items-center gap-2"><img src="${baseUrl}/${product.thumbnail}" alt="${product.name}" width="80" height="80">${product.name}</td>
                                                        <td class="px-6 py-4">${(formatCurrency(product.price))}</td>
                                                        <td class="px-6 py-4">${(product.discount)}</td>
                                                        <td class="px-6 py-4">${product.quantity}</td>
                                                        <td class="px-6 py-4">${(formatCurrency(product.total))}</td>
                                                    </tr>
                                                `).join('') + `
                                                    <tr>
                                                        <td colspan="5" class="px-6 py-4 font-bold text-right">Tổng tiền thanh toán:</td>
                                                        <td class="px-6 py-4 font-bold">${formatCurrency(data.reduce((sum, product) => sum + product.total, 0))}</td>
                                                    </tr>
                                                `;
                                                });



                                        }

                                        function formatCurrency(value) {
                                            return new Intl.NumberFormat('vi-VN', {
                                                style: 'currency',
                                                currency: 'VND'
                                            }).format(value);
                                        }

                                        function closeModal() {
                                            const modalDetailOrder = document.getElementById('modalDetailOrder');
                                            modalDetailOrder.classList.add('hidden');
                                        }
                                    </script>
                                    @if ($order->status == 'pending' || $order->status == 'confirmed')
                                        <form action="{{ route('orders.cancel', ['orderId' => $order->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="button" title="Hủy đơn" onclick="cancelOrder(this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 48 48">
                                                    <path fill="#d50000"
                                                        d="M24 6C14.1 6 6 14.1 6 24s8.1 18 18 18s18-8.1 18-18S33.9 6 24 6m0 4c3.1 0 6 1.1 8.4 2.8L12.8 32.4C11.1 30 10 27.1 10 24c0-7.7 6.3-14 14-14m0 28c-3.1 0-6-1.1-8.4-2.8l19.6-19.6C36.9 18 38 20.9 38 24c0 7.7-6.3 14-14 14" />
                                                </svg>
                                            </button>
                                        </form>
                                        <script>
                                            function cancelOrder(button) {
                                                Swal.fire({
                                                    title: 'Bạn có chắc chắn muốn hủy đơn hàng không?',
                                                    text: "Bạn hãy cho chúng tôi biết lý do bạn muốn hủy đơn",
                                                    icon: 'warning',
                                                    input: "text",
                                                    inputAttributes: {
                                                        autocapitalize: "off",
                                                        name: 'noteSelect',
                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Xác nhận',
                                                    cancelButtonText: 'Hủy'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        if (!result.value) {
                                                            alert('Lý do hủy đơn không được để trống');
                                                            return false;
                                                        }
                                                        const form = button.closest('form');
                                                        const noteInput = document.createElement('input');
                                                        noteInput.type = 'hidden';
                                                        noteInput.name = 'note';
                                                        noteInput.value = result.value;
                                                        form.appendChild(noteInput);
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    @endif
                                    @if ($order->status == 'completed')
                                        <a href="#" title="Mua lại">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M3.25 4A.75.75 0 0 1 4 3.25h2a.75.75 0 0 1 .738.616L8.626 14.25h8.788l1.858-7.432a.75.75 0 0 1 1.455.364l-2 8a.75.75 0 0 1-.727.568H8a.75.75 0 0 1-.738-.616L5.374 4.75H4A.75.75 0 0 1 3.25 4m5 14.25c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5m6.5 0c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5M13.75 5a.75.75 0 0 0-1.5 0v3.19l-.72-.72a.75.75 0 1 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l2-2a.75.75 0 0 0-1.06-1.06l-.72.72z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="modalDetailOrder" tabindex="-1"
            class="hidden fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 z-50 " onclick="closeModal()">
            <div class="flex justify-center items-center md:inset-0 h-[calc(100%-1rem)] min-w-[800px]">
                <div class="relative w-fit p-4  max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Danh sách sản phẩm trong đơn hàng
                            </h3>
                            <button type="button" onclick="closeModal()"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <table>
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Mã sản phẩm</th>
                                    <th scope="col" class="px-6 py-3">Tên sản phẩm</th>
                                    <th scope="col" class="px-6 py-3">Giá</th>
                                    <th scope="col" class="px-6 py-3">Giá giảm</th>
                                    <th scope="col" class="px-6 py-3">Số lượng</th>
                                    <th scope="col" class="px-6 py-3">Thành tiền</th>

                                </tr>
                            </thead>
                            <tbody id="listProductInOrder">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
