@extends('layouts.admin')

@section('title', 'Danh sách biến thể | FigureShop')

@section('content')
    <div class="py-4">
        <h2 class="text-[24px] font-bold">Quản lý biến thể</h2>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mt-3">
        <div class="py-2 flex gap-2 items-center">
            <h2 class="text-[24px] font-bold">Danh sách biến thể</h2>
            <a href="{{ route('admin.variants.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded mt-2">Tạo biến thể</a>
        </div>
        <table class="text-sm text-left text-gray-500 dark:text-gray-400 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Tên biến thể</th>
                    <th class="px-6 py-3">Giá trị</th>
                    <th class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adminVariants as $variant)
                    <tr x-data="{ expanded: false }" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <!-- Tên biến thể -->
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <div class="flex items-center justify-between">
                                <span>{{ $variant->name }}</span>
                            </div>
                        </td>
                        <!-- Giá trị -->

                        <td class=" flex gap-2 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div x-show="!expanded">
                                @if ($variant->deletedValues->count())
                                    {{ $variant->deletedValues->pluck('value')->implode(', ') }}
                                @else
                                    <p>Không có giá trị nào</p>
                                @endif
                            </div>
                            <div><button type="button" @click="expanded = !expanded"
                                    data-target="details-{{ $variant->id }}"
                                    class="toggle-details text-blue-500 hover:underline">Xem
                                </button></div>
                        </td>

                        <!-- Hành động -->
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.bin.variants.update', $variant->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="confirmUpdateVariant(this)"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.bin.variants.destroy', $variant->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDeleteVariant(this)"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Hàng mở rộng -->
                    <tr id="details-{{ $variant->id }}" class="hidden bg-gray-50 dark:bg-gray-700">
                        <td colspan="2" class="px-6 py-4">
                            @if ($variant->deletedValues->count())
                                <ul class="list-disc pl-4">
                                    @foreach ($variant->deletedValues as $value)
                                        <li class="flex justify-between items-center">
                                            <span>{{ $value->value }}</span>
                                            <form action="{{ route('admin.bin.variants.updateValue', $value->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmUpdateVariantValue(this)"
                                                    class="text-blue-500 hover:underline">Khôi phục</button>
                                            </form>
                                            <form action="{{ route('admin.bin.variants.destroyValue', $value->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDeleteVariantValue(this)"
                                                    class="text-red-500 hover:underline">Xóa</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-400">Không có giá trị nào</p>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">Không có biến thể nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButtons = document.querySelectorAll(".toggle-details");

            toggleButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const targetId = this.getAttribute("data-target");
                    const targetRow = document.getElementById(targetId);

                    if (targetRow.classList.contains("hidden")) {
                        targetRow.classList.remove("hidden");
                        targetRow.classList.add("visible");
                        this.textContent = "Thu gọn";
                    } else {
                        targetRow.classList.remove("visible");
                        targetRow.classList.add("hidden");
                        this.textContent = "Xem";
                    }
                });
            });
        });
    </script>
    <script>
        function confirmDeleteVariant(button) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa biến thể?',
                text: "Tất cả các giá trị liên quan cũng sẽ bị xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }

        function confirmDeleteVariantValue(button) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa biến thể?',
                text: "Tất cả các giá trị liên quan cũng sẽ bị xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }

        function confirmUpdateVariant(button) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn khôi phục biến thể?',
                text: "Tất cả các giá trị liên quan cũng sẽ bị khôi phục!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }

        function confirmUpdateVariantValue(button) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn khôi phục biến thể?',
                text: "Tất cả các giá trị liên quan cũng sẽ bị khôi phục!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection
