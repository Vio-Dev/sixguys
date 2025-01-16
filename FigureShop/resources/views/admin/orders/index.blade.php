@extends('layouts.admin')
@section('title', 'Danh sách đơn hàng | FigureShop')

@section('content')
    @php
        $classOrder = [
            'pending' => 'border-blue-800 text-blue-800',
            'processing' => 'border-orange-800 text-orange-800',
            'confirmed' => 'border-green-800 text-green-800',
            'shipping' => 'border-purple-800 text-purple-800',
            'completed' => 'border-green-800 text-green-800',
            // 'paid' => 'border-green-800 text-green-800',
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
            // 'paid' => 'Đã thanh toán',
            'cancelled' => 'Đã hủy đơn',
            'refunded' => 'Hoàn tiền',
            'failed' => 'Thất bại',
        ];
        $methodPayment = [
            'cod' => 'Thanh toán khi nhận hàng',
            'vnpay' => 'VNPAY',
        ];
        $isPaidStatus = [
            '0' => 'Chưa thanh toán',
            '1' => 'Đã thanh toán',
        ];
    @endphp

    @php
        $vietSubStatusOrders = [
            'pending' => 'Đợi xác thực',
            'processing' => 'Đang xử lý',
            'confirmed' => 'Đã xác thực',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy đơn',
            'refunded' => 'Hoàn tiền',
            'failed' => 'Thất bại',
        ];
        $vietSubMethodPayment = [
            'paid' => 'Đã thanh toán',
            'unpaid' => 'Chưa thanh toán',
        ];
    @endphp
    <div>
        <h2 class="text-[24px] font-bold">Danh sách đơn hàng</h2>
        {{-- thêm lọc theo trang thái, ngày đặt --}}


        <div class="flex gap-3">
            <div class="flex gap-3">
                <form method="GET">
                    <label for="status">Trạng thái:</label>
                    <select name="status" id="status" onchange="this.form.submit()">
                        <option value="">Tất cả</option>
                        @foreach ($vietSubStatusOrders as $status => $label)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="flex gap-3">
                <form method="GET">
                    <label for="methodPayment">Thanh toán:</label>
                    <select name="methodPayment" id="methodPayment" onchange="this.form.submit()">
                        <option value="">Tất cả</option>
                        @foreach ($vietSubMethodPayment as $status => $label)
                            <option value="{{ $status }}" {{ request('methodPayment') == $status ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Mã đơn hàng</th>
                    <th scope="col" class="px-6 py-3">Tên khách hàng</th>
                    <th scope="col" class="px-6 py-3">Tổng tiền</th>
                    <th scope="col" class="px-6 py-3">Ngày đặt</th>
                    <th scope="col" class="px-6 py-3">Cập nhật lúc</th>
                    <th scope="col" class="px-6 py-3">Trạng thái</th>
                    <th scope="col" class="px-6 py-3">Thanh toán</th>
                    <th scope="col" class="px-6 py-3">Ghi chú</th>
                    <th scope="col" class="px-6 py-3">Phương thức thanh toán</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->id }}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->user->name }}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ format_currency($order->total) }}
                        </th>



                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ format_day($order->order_date) }}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ format_day($order->updated_at) }}
                        </th>

                        <th class="">
                            @if (in_array($order->status, ['completed', 'cancelled', 'refunded', 'failed']))
                                <span
                                    class="px-2 w-full inline-flex items-center justify-center font-bold leading-5 border {{ $classOrder[$order->status] }}">
                                    {{ $vietSubStatusOrder[$order->status] }}
                                </span>
                            @else
                                <form action="{{ route('admin.don-hang.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" id="status" value="{{ $order->status }}"
                                        onchange="updateStatus(this, {{ $order->id }}, '{{ $order->note }}')">
                                        @foreach ($vietSubStatusOrder as $status => $label)
                                            <option value="{{ $status }}"
                                                {{ $order->status == $status ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="note" id="note_{{ $order->id }}">
                                    <script>
                                        function updateStatus(select, orderId, note) {
                                            Swal.fire({
                                                title: 'Bạn có chắc chắn muốn thay đổi trạng thái?',
                                                text: "Bạn hãy thêm ghi chú!",
                                                icon: 'warning',
                                                input: "text",
                                                inputAttributes: {
                                                    autocapitalize: "off",
                                                    name: 'noteSelect',
                                                },
                                                inputValue: note,
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Thay đổi',
                                                cancelButtonText: 'Hủy'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Nếu người dùng xác nhận, submit form
                                                    var form = select.closest('form');
                                                    var rawNote = result.value;
                                                    var noteInput = document.getElementById(`note_${orderId}`);
                                                    noteInput.value = rawNote;
                                                    form.submit();
                                                } else {
                                                    // Nếu người dùng hủy, reset lại giá trị của select
                                                    select.value = select.getAttribute('value');
                                                }
                                            });
                                        }
                                    </script>
                                </form>
                            @endif
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($order->isPaid == 1)
                                <span
                                    class="px-2 inline-flex font-bold leading-5 rounded-full {{ $classOrder[$order->status] }}">
                                    {{ $isPaidStatus[$order->isPaid] }}
                                </span>
                            @else
                                <form action="{{ route('admin.don-hang.updatePayment', $order->id) }}" method="POST"
                                    onsubmit="updatePaymentStatus(this,event, {{ $order->id }})">
                                    @csrf
                                    @method('PATCH')
                                    <select name="isPaid" id="" value="{{ $isPaidStatus[$order->isPaid] }}"
                                        onchange="this.form.submit()">
                                        <option value="0" {{ $order->isPaid == 0 ? 'selected' : '' }}>Chưa thanh toán
                                        </option>
                                        <option value="1" {{ $order->isPaid == 1 ? 'selected' : '' }}>Đã thanh toán
                                        </option>
                                    </select>
                                </form>
                            @endif
                        <th>
                            {{ $order->note }}
                        </th>
                        <th>
                            {{ $methodPayment[$order->payment_method] }}
                        </th>
                        <td class="flex items-center px-6 py-4">
                            <form action="{{ route('admin.don-hang.show', $order->id) }}" method="GET"
                                onsubmit="viewDetailOrder(event, {{ $order->id }})">
                                @csrf
                                @method('GET')
                                <button type="submit" class="text-blue-800 hover:underline">Chi tiết</button>
                            </form>

                            <script>
                                function viewDetailOrder(e, orderId) {
                                    e.preventDefault();
                                    const modalDetailOrder = document.getElementById('modalDetailOrder');
                                    const listProductInOrder = document.getElementById('listProductInOrder');

                                    modalDetailOrder.classList.remove('hidden');

                                    const baseUrl = `{{ route('home') }}`;

                                    var url = `{{ route('admin.don-hang.show', '') }}` + `/` + orderId;
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
                            <form action="{{ route('admin.don-hang.destroy', $order->id) }}" method="POST" class="ms-3">
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
                    <tr>
                        <td colspan="10" class="px-6 py-4 text-center text-gray-500">Không có đơn hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-5">
            {{ $orders->links() }}
        </div>
        <div id="modalDetailOrder" tabindex="-1" aria-hidden="true"
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
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
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
    </div>
@endsection
