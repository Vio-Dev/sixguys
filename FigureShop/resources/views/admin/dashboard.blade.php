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
                <h2 class="text-2xl font-semibold mt-4">{{ $countPost }}</h2>
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
                <h2 class="text-2xl font-semibold mt-4">{{ number_format($totalRevenue, 0, ',', '.') }}</h2>
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
                <h2 class="text-2xl font-semibold mt-4">{{ $countProduct }}</h2>
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
                <h2 class="text-2xl font-semibold mt-4">{{ $countUser }}</h2>
                <p class="text-gray-500">Tổng số người dùng</p>

            </div>
        </div>
        <div class=" mx-auto bg-white shadow-md rounded-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Biểu đồ Doanh thu</h1>

            <div class="flex justify-center space-x-4 mb-6">
                <button onclick="updateChart('weekly')"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Theo Tuần</button>
                <button onclick="updateChart('monthly')"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Theo Tháng</button>
                <button onclick="updateChart('yearly')"
                    class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Theo Năm</button>
            </div>

            <!-- Canvas Biểu đồ -->
            <canvas id="mainChart" class="h-48"></canvas> <!-- This sets the height to 16rem (256px) -->
        </div>
        <div class=" mx-auto bg-white shadow-md rounded-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sản phẩm bán chạy</h1>

            <!-- Bảng hiển thị sản phẩm bán chạy -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Tên sản phẩm</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Số lượng bán</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bestSelling as $index => $product)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="px-6 py-4 border-b text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 border-b text-gray-700 flex gap-2 items-center">
                                    <img class="w-16" src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" />
                                    <div>
                                        {{ $product->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 border-b text-gray-700">{{ $product->hasSold }}</td>
                                <td class="px-6 py-4 border-b text-gray-700">{{ format_currency($product->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-5">
                    {{ $bestSelling->links() }}
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dữ liệu từ Laravel
        const weeklyData = @json($weekly);
        const monthlyData = @json($monthly);
        const yearlyData = @json($yearly);
        // Biểu đồ ban đầu với dữ liệu theo tuần
        const ctx = document.getElementById('mainChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar', // Loại biểu đồ
            data: {
                labels: Object.keys(weeklyData), // Nhãn ban đầu (Tuần)
                datasets: [{
                    label: 'Doanh thu theo tuần',
                    data: Object.values(weeklyData), // Dữ liệu ban đầu
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    height: 200,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        // Hàm cập nhật biểu đồ
        function updateChart(type) {
            let labels, data, label;

            // Thay đổi dữ liệu dựa vào loại
            if (type === 'weekly') {
                labels = Object.keys(weeklyData);
                data = Object.values(weeklyData);
                label = 'Doanh thu theo tuần';
            } else if (type === 'monthly') {
                labels = Object.keys(monthlyData);
                data = Object.values(monthlyData);
                label = 'Doanh thu theo tháng';
            } else if (type === 'yearly') {
                labels = Object.keys(yearlyData);
                data = Object.values(yearlyData);
                label = 'Doanh thu theo năm';
            }

            // Cập nhật dữ liệu biểu đồ
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.data.datasets[0].label = label;
            chart.update();
        }
    </script>
@endsection
