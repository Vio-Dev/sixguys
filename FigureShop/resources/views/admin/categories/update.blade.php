@extends('layouts.admin')
@section('title', 'Cập nhật danh mục | FigureShop')

@section('content')
    <div>
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Sửa danh mục</h2>
            <div class="flex gap-2">
                <a href="{{ Route('admin.categories.list') }}" class="flex items-center gap-2 p-2 ">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                        </svg>

                    </div>

                    <div>
                        Danh sách danh mục
                    </div>
                </a>
            </div>
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

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Sửa danh mục
            </button>
            <a href={{ route('admin.categories.list') }}
                class="text-white bg-red-600  h focus:ring-4focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Hủy</a>
        </form>
    </div>
@endsection
