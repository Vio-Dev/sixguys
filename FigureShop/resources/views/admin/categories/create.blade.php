@extends('layouts.admin')

@section('title', 'Tạo danh mục | FigureShop')

@section('content')

    <div>
        <div class="flex justify-between items-center ">
            <div class="py-2 ">
                <h2 class="text-[24px] font-bold">Tạo danh mục</h2>
            </div>
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
        <form class="flex" action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="flex flex-col  gap-2 w-full ">
                <div class="w-1/2">
                    <input type="text" name="name" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Nhập tên danh mục" />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block" for="parent_id">Danh mục cha</label>
                    <select name="parent_id" id="parent_id">
                        <option value="">Chọn danh mục cha</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                    focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center p-2
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tạo danh mục</button>
                </div>
            </div>
        </form>
    </div>


@endsection
