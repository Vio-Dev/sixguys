@extends('layouts.admin')
@section('title', 'Thêm mới người dùng | FigureShop')

@section('content')
    <div class="py-2 ">
        <h2 class="text-[24px] font-bold">Thêm mới người dùng</h2>
    </div>
    <form action={{ route('admin.users.store') }} method="POST" enctype="multipart/form-data" class="flex flex-col gap-4"
        type="submit">
        @csrf
        @method('POST')
        <div class="p-2 shadow-md sm:rounded-lg">
            <h3 class="text-[18px] font-medium">Thông tin người dùng</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="w-full">
                    <label for="name" class="block font-medium">Tên người dùng
                    </label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block font-medium">Email</label>
                    <input type="text" name="email" id="email"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="block font-medium">Số điện thoại</label>
                    <input type="text" name="phone" id="phone"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="block font-medium">Vai trò</label>
                    <select name="role" id="role"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        <option value="0">Admin</option>
                        <option value="1">User</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block font-medium">Mật khẩu</label>
                    <input type="text" name="password" id="password"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="block font-medium">Nhập lại mật khẩu</label>
                    <input type="text" name="password_confirmation" id="passwordConfirm"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                    </select>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>


        <div class="">
            <button type="submit" class="bg-blue-500 p-2 rounded-md text-white">Tạo</button>
            <a href={{ route('admin.users.list') }} class="bg-blue-500 p-2 rounded-md text-white">Hủy</a>
        </div>
    </form>
@endsection
