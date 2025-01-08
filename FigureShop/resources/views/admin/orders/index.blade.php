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
        $methodPayment = [
            'cod' => 'Thanh toán khi nhận hàng',
            'vnpay' => 'VNPAY',
        ];
    @endphp
    <div>
        <h2>Danh sách đơn hàng</h2>
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Mã đơn hàng</th>
                    <th scope="col" class="px-6 py-3">Tên khách hàng</th>
                    <th scope="col" class="px-6 py-3">Tổng tiền</th>
                    <th scope="col" class="px-6 py-3">Ngày đặt</th>
                    <th scope="col" class="px-6 py-3">Trạng thái</th>
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
                            {{ $order->order_date }}
                        </th>
                        <th class="">
                            <span class="border-2  py-1 px-3 {{ $classOrder[$order->status] }}">
                                {{ $vietSubStatusOrder[$order->status] }}
                            </span>
                        </th>
                        <th>
                            {{ $order->note }}
                        </th>
                        <th>
                            {{ $methodPayment[$order->payment_method] }}
                        </th>
                        <td class="flex items-center px-6 py-4">
                            <a href="{{ route('admin.categories.edit', $order->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $order->id) }}" method="POST"
                                class="ms-3">
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
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">Không có đơn hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
