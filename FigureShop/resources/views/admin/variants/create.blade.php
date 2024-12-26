@extends('layouts.admin')

@section('title', 'Tạo biến thể | FigureShop')

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Tạo biến thể</h2>
        </div>
    </div>
    <div class="mt-3">
        <form action="{{ route('admin.variants.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="name" class="block">Tên biến thể</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                </div>


                <div x-data="{ values: [''] }">
                    <template x-for="(value, index) in values" :key="index">
                        <div class="mt-2">
                            <label class="block">Giá trị <span x-text="index + 1"></span></label>
                            <div class="flex items-center mt-2 pl-2">
                                <input type="text" :name="'values[' + index + ']'" x-model="values[index]"
                                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                                <button type="button" @click="values.splice(index, 1)"
                                    class="ml-2 text-red-500">Xóa</button>
                            </div>
                        </div>
                    </template>
                    <button type="button" @click="values.push('')"
                        class="mt-2 bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Thêm giá trị</button>
                </div>

            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Tạo biến
                    thể</button>
            </div>
        </form>
    </div>
@endsection
