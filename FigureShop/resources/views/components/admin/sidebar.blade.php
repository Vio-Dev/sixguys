<div class=text-white ">
    <ul>
        <a href="{{ route('home') }}" class="flex p-2 gap-1 hover:underline hover:bg-gray-700 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d=" M6 19h3.692v-5.077q0-.343.233-.575q.232-.233.575-.233h3q.343 0
    .576.233q.232.232.232.575V19H18v-8.692q0-.154-.067-.28t-.183-.22L12.366 5.75q-.154-.134-.366-.134t-.365.134L6.25
    9.808q-.115.096-.183.22t-.067.28zm-1
    0v-8.692q0-.384.172-.727t.474-.565l5.385-4.078q.423-.323.966-.323t.972.323l5.385
    4.077q.303.222.474.566q.172.343.172.727V19q0 .402-.299.701T18 20h-3.884q-.344
    0-.576-.232q-.232-.233-.232-.576v-5.076h-2.616v5.076q0 .344-.232.576T9.885 20H6q-.402 0-.701-.299T5 19m7-6.711" />
</svg>

Trang chủ
</a>
<a href={{ route('admin.dashboard') }} class="flex p-2 gap-1 hover:underline hover:bg-gray-700">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor" d="M3 4h1v14l5.58-9.67l6.01 3.47l3.62-6.26l.86.5l-4.11 7.13L9.95 9.7L4 20h16v1H3z" />
    </svg>

    Thống kê
</a>
<a href={{ route('admin.don-hang.list') }} class="flex p-2 gap-1 hover:underline hover:bg-gray-700">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path
                d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73zm1 .27V12" />
            <path d="m3.3 7l7.703 4.734a2 2 0 0 0 1.994 0L20.7 7M7.5 4.27l9 5.15" />
        </g>
    </svg>
    Đơn hàng
</a>
<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropProduct"
            class=" text-white font-medium text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048">
                <path fill="currentColor"
                    d="m1344 2l704 352v785l-128-64V497l-512 256v258l-128 64V753L768 497v227l-128-64V354zm0 640l177-89l-463-265l-211 106zm315-157l182-91l-497-249l-149 75zm-507 654l-128 64v-1l-384 192v455l384-193v144l-448 224L0 1735v-676l576-288l576 288zm-640 710v-455l-384-192v454zm64-566l369-184l-369-185l-369 185zm576-1l448-224l448 224v527l-448 224l-448-224zm384 576v-305l-256-128v305zm384-128v-305l-256 128v305zm-320-288l241-121l-241-120l-241 120z" />
            </svg>
            Sản phẩm
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700 ">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href={{ route('admin.products.list') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Danh
                    sách</a>
                <a href={{ route('admin.products.create') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Tạo
                    mới</a>
            </ul>
        </div>
    </ul>
</div>
<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropProduct"
            class=" text-white font-medium text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M10.73 14.97c.27.11.36.41.24.66s-.41.37-.66.24h-.01c-.46-.21-.89-.51-1.27-.9a4.49 4.49 0 0 1 0-6.36l3.53-3.53a4.49 4.49 0 0 1 6.36 0a4.49 4.49 0 0 1 0 6.36l-1.63 1.63l-.15-1.26l1.08-1.08a3.513 3.513 0 0 0 0-4.95a3.513 3.513 0 0 0-4.95 0L9.73 9.32a3.513 3.513 0 0 0 0 4.95c.3.3.64.53 1 .7m-6.65 4.95a4.49 4.49 0 0 1 0-6.36l1.63-1.63l.15 1.26l-1.08 1.08a3.513 3.513 0 0 0 0 4.95a3.513 3.513 0 0 0 4.95 0l3.54-3.54a3.513 3.513 0 0 0 0-4.95c-.3-.3-.64-.53-1-.7v.01a.49.49 0 0 1-.24-.67c.12-.25.41-.37.66-.24h.01c.46.21.89.51 1.27.9a4.49 4.49 0 0 1 0 6.36l-3.53 3.53a4.49 4.49 0 0 1-6.36 0" />
            </svg>
            Biến thể
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700 ">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href={{ route('admin.variants.list') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Danh
                    sách</a>
                <a href={{ route('admin.variants.create') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Tạo
                    mới</a>
            </ul>
        </div>
    </ul>
</div>
<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropProduct"
            class=" text-white font-medium text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="6" r="4" />
                    <path d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5Z" />
                </g>
            </svg>
            Người dùng
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700 ">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href={{ route('admin.users.list') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Danh
                    sách</a>
                <a href={{ route('admin.users.create') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Tạo
                    mới</a>
            </ul>
        </div>
    </ul>
</div>
<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropProduct"
            class=" text-white font-medium text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                <rect width="24.017" height="24.017" x="5.5" y="5.5" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" rx="4" ry="4" />
                <circle cx="29.517" cy="29.517" r="12.982" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Danh mục
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700 ">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href={{ route('admin.categories.list') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Danh
                    sách</a>
                <a href={{ route('admin.categories.create') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Tạo
                    mới</a>
            </ul>
        </div>
    </ul>
</div>

<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropCategory"
            class=" text-white font-medium  text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048">
                <path fill="currentColor"
                    d="M640 384h1408v1152H640zm1280 1024V512H768v896zM128 1024V896h384v128zM0 768V640h512v128zm256 512v-128h256v128zm1536-640v128H896V640zm-384 640V896h384v384zm128-256v128h128v-128zm-256 128v128H896v-128zm0-256v128H896V896z" />
            </svg>
            Bài đăng
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href={{ route('admin.blogs.list') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Danh
                    sách</a>
                <a href={{ route('admin.blogs.create') }}
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Tạo
                    mới</a>

            </ul>
        </div>
    </ul>
</div>

<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropCategory"
            class=" text-white font-medium  text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M6.5 13.5h7v-1h-7zm0-3h11v-1h-11zm0-3h11v-1h-11zM3 20.077V4.616q0-.691.463-1.153T4.615 3h14.77q.69 0 1.152.463T21 4.616v10.769q0 .69-.463 1.153T19.385 17H6.077zM5.65 16h13.735q.23 0 .423-.192t.192-.423V4.615q0-.23-.192-.423T19.385 4H4.615q-.23 0-.423.192T4 4.615v13.03zM4 16V4z" />
            </svg>
            Bình luận
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href="{{ route('admin.comments.product') }}"
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Sản
                    phẩm</a>
                <a href="{{ route('admin.comments.post') }}"
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Bài
                    đăng</a>

            </ul>
        </div>
    </ul>
</div>
<div x-data="{ open: false }" class="text-white">
    <ul>
        <!-- Dropdown button -->
        <button @click="open = !open" id="dropCategory"
            class=" text-white font-medium  text-sm text-center inline-flex gap-1 p-2 w-full items-center hover:underline hover:bg-gray-700"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path
                        d="m19.262 17.038l1.676-12.575a.6.6 0 0 0-.372-.636L16 2h-5.5l-.682 1.5L5 2L3.21 3.79a.6.6 0 0 0-.17.504l1.698 12.744a4 4 0 0 0 1.98 2.944l.32.183a10 10 0 0 0 9.923 0l.32-.183a4 4 0 0 0 1.98-2.944ZM16 2l-2 5m-5-.5l.818-3" />
                    <path d="M3 5c2.571 2.667 15.429 2.667 18 0" />
                </g>
            </svg>
            Thùng rác
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" id="dropdown"
            class=" divide-gray-100  shadow  dark:bg-gray-700">
            <ul class="py-2 text-sm text-white-700 dark:text-gray-200" aria-labelledby="dropProduct">
                <a href=""
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">
                    Đơn hàng</a>
                <a href="{{ route('admin.bin.products.list') }}"
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Sản
                    phẩm</a>
                <a href="{{ route('admin.bin.variants.list') }}"
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">
                    Biến thể</a>
                <a href="{{ route('admin.bin.blogs.list') }}"
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Bài
                    đăng</a>
                <a href="{{ route('admin.bin.category.list') }}"
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">
                    Danh mục</a>


            </ul>
        </div>
    </ul>
</div>

</ul>
</div>
