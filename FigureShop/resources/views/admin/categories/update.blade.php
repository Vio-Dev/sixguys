@extends('layouts.admin')
@section('title', 'Cập nhật danh mục | FigureShop')

@section('content')
    <div>
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Sửa danh mục</h2>

        </div>
        <form class=" mx-auto" action="{{ route('admin.categories.update', ['id' => $category->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên danh
                    mục</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="Nhập tên danh mục" />
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="parent_id">Danh mục
                    cha</label>
                <select name="parent_id" id="parent_id"
                    class="w-1/2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <option value="">Chọn danh mục cha</option>
                    @foreach ($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}"
                            {{ $subCategory->id == $category->parent_id ? 'selected' : '' }}>
                            {{ $subCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Sửa danh mục
            </button>
            <a href={{ route('admin.categories.list') }}
                class="text-white bg-red-600  h focus:ring-4focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Hủy</a>
        </form>
    </div>
@endsection
