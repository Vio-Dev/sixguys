@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('content')
    <section class="container mx-auto flex-grow max-w-[1200px] border-b py-5 lg:flex lg:flex-row lg:py-10">
        <!-- sidebar  -->
        <section class="hidden w-[300px] flex-shrink-0 px-4 lg:block">
            <form action="{{ route('products') }}" method="GET">
                @csrf
                <!-- Lọc theo danh mục -->
                <div class="flex border-b pb-5">
                    <div class="w-full">
                        <p class="mb-3 font-medium">Danh mục</p>
                        @foreach ($renderCategories as $category)
                            <div class="flex w-full justify-between">
                                <div class="flex justify-center items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }} />
                                    <p class="ml-4">{{ $category->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Lọc theo nhu cầu -->
                <div class="flex border-b py-5">
                    <div class="w-full">
                        <p class="mb-3 font-medium">Lọc theo loại sản phẩm</p>
                        @foreach ($renderSubCategories as $subCategory)
                            <div class="flex w-full justify-between">
                                <div class="flex justify-center items-center">
                                    <input type="checkbox" name="subCategories[]" value="{{ $subCategory->id }}"
                                        {{ in_array($subCategory->id, request('subCategories', [])) ? 'checked' : '' }} />
                                    <p class="ml-4">{{ $subCategory->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Lọc theo giá -->
                <div class="flex border-b py-5">
                    <div class="w-full">
                        <div class="flex">
                            <input type="checkbox" class="mr-3" id="price-filter-checkbox" onclick="togglePriceFilter()">
                            <p class="mb-3 font-medium">Lọc theo giá</p>
                        </div>
                        <div class="flex w-full" id="price-filter-fields" style="display: none;">
                            <div class="flex justify-between">
                                <input type="number" name="minPrice" class="h-8 w-[90px] border pl-2" placeholder="50" />
                                <span class="px-3">-</span>
                                <input type="number" name="maxPrice" class="h-8 w-[120px] border pl-2"
                                    placeholder="1200000" />
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function togglePriceFilter() {
                        var checkbox = document.getElementById('price-filter-checkbox');
                        var fields = document.getElementById('price-filter-fields');
                        if (checkbox.checked) {
                            fields.style.display = 'flex';
                        } else {
                            fields.style.display = 'none';
                        }
                    }
                </script>
                {{-- <div class="flex border-b py-5">
                    <div class="w-full">
                        <p class="mb-3 font-medium">SIZE</p>

                        <div class="flex gap-2">
                            <div
                                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                                XS
                            </div>
                            <div
                                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                                S
                            </div>
                            <div
                                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                                M
                            </div>

                            <div
                                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                                L
                            </div>

                            <div
                                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                                XL
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex py-5">
                    <div class="w-full">
                        <p class="mb-3 font-medium">COLOR</p>

                        <div class="flex gap-2">
                            <div
                                class="h-8 w-8 cursor-pointer border border-white bg-gray-600 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                            </div>
                            <div
                                class="h-8 w-8 cursor-pointer border border-white bg-violet-900 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                            </div>
                            <div
                                class="h-8 w-8 cursor-pointer border border-white bg-red-900 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Các phần khác như SIZE, COLOR giữ nguyên -->
                <button type="submit" class="my-5 h-10 w-full bg-violet-900 text-white">
                    Lọc
                </button>
            </form>
        </section>

        <!-- /sidebar  -->

        <div>
            <section class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-3 mt-4">
                @forelse ($products as $product)
                    <div class="flex flex-col">
                        <div class="relative flex">
                            <img class="w-[300px] h-[300px]" src="{{ asset($product->thumbnail) }}" alt="sofa image" />
                            <div
                                class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100">
                                <a href={{ route('productDetail', $product->id) }}
                                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </a>
                                <form action="{{ route('wishlists.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                        class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-4 w-4">
                                            <path
                                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            @if ($product->discount > 0)
                                <div class="absolute right-1 mt-3 flex items-center justify-center bg-amber-400">
                                    <p class="px-2 py-2 text-sm">&minus; {{ $product->discount }}&percnt; OFF</p>
                                </div>
                            @endif
                        </div>

                        <div>
                            <p class="mt-2">{{ Str::limit($product->name, 20) }}</p>
                            <p class="font-medium text-violet-900">
                                {{ format_currency($product->price * (1 - $product->discount / 100)) }}
                                <span class="text-sm text-gray-500 line-through">
                                    {{ format_currency($product->price) }}</span>
                            </p>
                            <form action="{{ route('cart.add') }}" method="POST" onsubmit="addToCart(event, this)">

                                @csrf
                                @method('POST')
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="price"
                                    value="{{ $product->price * (1 - $product->discount / 100) }}">
                                <button type="submit" class="my-5 h-10 w-full bg-violet-900 text-white">
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Không có sản phẩm nào</p>
                @endforelse

                <!-- 2 -->


            </section>
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
