<div class=text-white ">
    <ul>
        <a href="" class="flex p-2 gap-1 hover:underline hover:bg-gray-700 ">
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
<a href="" class="flex p-2 gap-1 hover:underline hover:bg-gray-700">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor"
            d="M10 15.5H7a1.5 1.5 0 0 0 0 3h3a1.5 1.5 0 0 0 0-3M6.5 17a.5.5 0 0 1 .5-.5h3a.5.5 0 1 1 0 1H7a.5.5 0 0 1-.5-.5" />
        <path fill="currentColor"
            d="M8.531 3.5c-.52 0-.88 0-1.218.096a2.5 2.5 0 0 0-.824.412c-.28.213-.496.5-.808.917L4.213 6.883c-.212.282-.358.477-.464.695a2.5 2.5 0 0 0-.203.609c-.046.238-.046.482-.046.834v7.8c0 .542 0 .98.029 1.333c.03.365.093.685.244.98a2.5 2.5 0 0 0 1.092 1.093c.296.151.616.214.98.244c.355.029.792.029 1.334.029h9.642c.542 0 .98 0 1.333-.029c.365-.03.685-.093.981-.244a2.5 2.5 0 0 0 1.092-1.092c.151-.296.214-.616.244-.98c.029-.355.029-.792.029-1.334v-7.8c0-.352 0-.596-.046-.834a2.5 2.5 0 0 0-.203-.609c-.106-.218-.252-.413-.463-.695l-1.47-1.958c-.311-.416-.527-.704-.807-.917a2.5 2.5 0 0 0-.824-.412c-.338-.096-.698-.096-1.218-.096zm-.943 1.058c.186-.054.396-.058 1.012-.058h1.834l-.375 3H5l1.44-1.92c.37-.493.5-.658.653-.775a1.5 1.5 0 0 1 .495-.247M13.941 7.5l-.375-3H15.4c.616 0 .826.004 1.012.058c.179.05.347.135.495.247c.154.117.284.282.653.775L19 7.5zm-1.382-3l.375 3h-1.868l.375-3zm.441 4v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4zm-3 4a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5-1.5v-4h5.489c.01.113.011.27.011.567V16.8c0 .568 0 .964-.026 1.273c-.024.302-.07.476-.137.608a1.5 1.5 0 0 1-.656.656c-.132.067-.306.113-.608.137c-.308.026-.705.026-1.273.026H7.2c-.568 0-.964 0-1.273-.026c-.302-.024-.476-.07-.608-.137a1.5 1.5 0 0 1-.655-.656c-.068-.132-.114-.306-.138-.608c-.026-.309-.026-.705-.026-1.273V9.067c0-.297.001-.454.011-.567H10z" />
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
<a href={{ route('admin.categories.list') }} class="flex p-2 gap-1 hover:underline hover:bg-gray-700">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor"
            d="M7.885 10.23L12 3.463l4.116 6.769zm9.615 11q-1.567 0-2.649-1.081T13.769 17.5t1.082-2.649t2.649-1.082t2.649 1.082t1.082 2.649t-1.082 2.649t-2.649 1.082m-13.73-.5v-6.462h6.46v6.462zm13.73-.5q1.146 0 1.939-.792t.792-1.939t-.792-1.939t-1.939-.792t-1.939.792t-.792 1.939t.792 1.939t1.939.792m-12.73-.5h4.46v-4.462H4.77zm4.857-10.5h4.746L12 5.427zM17.5 17.5" />
    </svg>
    Danh mục
</a>

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
                <a href=""
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Sản
                    phẩm</a>
                <a href=""
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
                <a href=""
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Sản
                    phẩm</a>
                <a href=""
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">Bài
                    đăng</a>
                <a href=""
                    class="block pl-9 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-dark hover:underline">
                    Danh mục</a>


            </ul>
        </div>
    </ul>
</div>

</ul>
</div>
