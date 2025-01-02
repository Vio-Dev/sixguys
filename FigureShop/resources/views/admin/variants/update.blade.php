@extends('layouts.admin')

@section('title', 'Cập nhật biến thể | FigureShop')

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Cập nhật biến thể</h2>
        </div>
    </div>
    <div class="mt-3">
        <form action="{{ route('admin.variants.update', $variant->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Phương thức PUT cho cập nhật -->

            <div class="grid grid-cols-1 gap-4">
                <!-- Tên biến thể -->
                <div>
                    <label for="name" class="block">Tên biến thể</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md @error('name') @enderror"
                        value="{{ old('name', $variant->name) }}">
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Giá trị biến thể -->
                <div x-data="{ values: {{ json_encode($variant->values->pluck('value')->toArray() ?: ['']) }} }">
                    <template x-for="(value, index) in values" :key="index">
                        <div class="mt-2">
                            <label class="block">Giá trị <span x-text="index + 1"></span></label>
                            <div class="flex items-center mt-2 pl-2">
                                <input type="text" :name="'values[' + index + ']'" x-model="values[index]"
                                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                                <button type="button" @click="values.splice(index, 1)"
                                    class="ml-2 text-red-500 hover:underline">Xóa</button>
                            </div>
                        </div>
                    </template>
                    <button type="button" @click="values.push('')"
                        class="mt-2 bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Thêm giá trị</button>
                </div>
            </div>

            <!-- Nút Submit -->
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Cập nhật biến thể
                </button>
            </div>
        </form>
    </div>
@endsection
