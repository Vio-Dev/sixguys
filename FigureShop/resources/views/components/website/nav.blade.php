<nav class="relative bg-violet-900">
    <div class="mx-auto hidden h-12 w-full max-w-[1200px] items-center md:flex">
        <button @click="desktopMenuOpen = ! desktopMenuOpen"
            class="ml-5 flex h-full w-40 cursor-pointer items-center justify-center bg-amber-400">
            <div class="flex justify-around" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="mx-1 h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                Danh mục
            </div>
        </button>

        <div class="mx-7 flex gap-8">
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href={{ route('home') }}>Trang chủ</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href={{ route('products') }}>Sản phẩm</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href={{ route('blogs') }}>Bài đăng</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="#">Về
                chúng tôi</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="#">Liên hệ</a>
            @if (Auth::check() && Auth::user()->role == 'admin')
                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                    href={{ route('admin.dashboard') }}>Admin</a>
            @endif
        </div>

        @if (Auth::check())
            <div class="ml-auto flex gap-4 px-5">
                <div x-data="{ open: false }" class="relative">
                    <!-- Button để mở/đóng dropdown -->
                    <button class="text-white font-bold focus:outline-none" @click="open = !open">
                        Xin chào, {{ Auth()->user()->name }}
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-40 bg-gray-800 text-white rounded shadow-lg z-10">
                        <a href="{{ route('ho-so.ho-so') }}"
                            class="block px-4 py-2 text-sm duration-100 hover:bg-gray-700 hover:text-yellow-400">
                            Hồ sơ
                        </a>
                        <a class="block px-4 py-2 text-sm duration-100 hover:bg-gray-700 hover:text-yellow-400">
                            <form action="{{ route('ho-so.dang-xuat') }}" method="POST">
                                @csrf
                                <button class="flex items-center gap-2 font-medium active:text-violet-900">

                                    Đăng xuất
                                </button>

                            </form>
                        </a>

                    </div>
                </div>
            </div>
        @else
            <div class="ml-auto flex gap-4 px-5">
                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                    href={{ route('login') }}>Đăng nhập</a>

                <span class="text-white">&#124;</span>

                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                    href={{ route('register') }}>Đăng ký</a>
            </div>
        @endif

    </div>
</nav>
<!-- /Nav bar -->

<!-- Menu  -->
<section x-show="desktopMenuOpen" @click.outside="desktopMenuOpen = false"
    class="absolute left-0 right-0 z-10 w-full border-b border-r border-l bg-white" style="display: none">
    <div class="mx-auto flex max-w-[1200px] py-10">
        {{-- <div class="w-[300px] border-r">
            <ul class="px-5">
                @foreach ($renderCategories as $category)
                    <li class="active:blue-900 flex items-center gap-2 py-2 px-3 hover:bg-amber-400 hover:text-white">
                        {{ $category->name }}
                        <span class="ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div> --}}

        <div class=" flex max-w-[1200px] py-10">


            <div class="flex w-full justify-between">
                <div class="flex gap-6">
                    @foreach ($renderCategories as $category)
    <div class="mx-5">
        <a href="{{ route('products', ['category' => $category->name]) }}"
            class="font-medium text-gray-500">{{ $category->name }}</a>
        <ul class="text-sm leading-8">
            @foreach ($renderSubCategories->where('parent_id', $category->id) as $subCategory)
                <li class="hover:text-amber-400">
                    <a href="{{ route('products', ['category' => $category->name, 'subcategorys' => $subCategory->name]) }}">
                        {{ $subCategory->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /Menu  -->

<!-- breadcrumbs  -->

{{-- <nav class="mx-auto w-full mt-4 max-w-[1200px] px-5">
     <ul class="flex items-center">
         <li class="cursor-pointer">
             <a href="index.html">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                     <path
                         d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                     <path
                         d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                 </svg>
             </a>
         </li>
         <li>
             <span class="mx-2 text-gray-500">&gt;</span>
         </li>

         <li class="text-gray-500">Catalog</li>
     </ul>
 </nav> --}}
