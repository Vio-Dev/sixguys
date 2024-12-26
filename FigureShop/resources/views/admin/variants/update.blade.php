@extends('layouts.admin')

@section('title', 'Cập nhật biến thể | FigureShop')

@section('content')
    <div>
        <div class="py-2 ">
            <h2 class="text-[24px] font-bold">Tạo biến thể</h2>
        </div>
    </div>
    <div class="mt-3">
        <form action="{{ route('admin.variants.update', ['id' => $variant->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="name" class="block">Tên biến thể</label>
                    <input type="text" name="name" id="name" value="{{ $variant->name }}"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Cập nhật biến
                        thể</button>
                    <a href="{{ route('admin.variants.list') }}"
                        class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Hủy</a>
                </div>
        </form>
    </div>
@endsection
