@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('components.website.banner')
    <section class="container mx-auto my-8 flex flex-col justify-center gap-3 lg:flex-row">
        <!-- 1 -->

        <div class="mx-5 flex flex-row items-center justify-center border-2 border-yellow-400 py-4 px-5">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-violet-900 lg:mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>

            <div class="ml-6 flex flex-col justify-center">
                <h3 class="text-left text-xs font-bold lg:text-sm">Giao hàng miễn phí</h3>
                <p class="text-light text-center text-xs lg:text-left lg:text-sm">
                    Đơn hàng từ $200
                </p>
            </div>
        </div>

        <!-- 2 -->

        <div class="mx-5 flex flex-row items-center justify-center border-2 border-yellow-400 py-4 px-5">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-violet-900 lg:mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>
            </div>

            <div class="ml-6 flex flex-col justify-center">
                <h3 class="text-left text-xs font-bold lg:text-sm">Trả lại tiền</h3>
                <p class="text-light text-left text-xs lg:text-sm">
                    Bảo hành 30 ngày
                </p>
            </div>
        </div>

        <!-- 3 -->

        <div class="mx-5 flex flex-row items-center justify-center border-2 border-yellow-400 py-4 px-5">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 text-violet-900 lg:mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
            </div>

            <div class="ml-6 flex flex-col justify-center">
                <h3 class="text-left text-xs font-bold lg:text-sm">Hỗ trợ 24/7</h3>
                <p class="text-light text-left text-xs lg:text-sm">
                    Hỗ trợ người tiêu dùng
                </p>
            </div>
        </div>
    </section>

    <!-- /Cons bages  -->

    <!-- /Cathegories  -->

    <!-- /Slider  -->

    <p class="mx-auto mt-10  max-w-[1200px] font-bold text-[24px] px-5">Sản phẩm bán chạy</p>

    <!-- Slider  -->

    <div class="mx-auto max-w-[1200px] px-5">
        <section class="my-5">
            <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" slides-per-view="5"
                space-between="30" free-mode="true">
                @forelse ($products->where('hasSold', '>=', 1) as $product)
<swiper-slide>
                        <div class="flex flex-col">
                            <div class="relative flex">
                                <img class="" src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" />
                                <div
                                    class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100">
                                    <a href={{ route('productDetail', $product->id) }}
                                        class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                        <span
                                            class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span
                                        class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-4 w-4">
                                            <path
                                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                        </svg>
                                    </span>
                                </div>

                                @if ($product->discount > 0)
<div class="absolute right-1 mt-3 flex items-center justify-center bg-amber-400">
                                        <p class="px-2 py-2 text-sm">&minus; {{ $product->discount }}&percnt; OFF</p>
                                    </div>
@endif
                            </div>

                            <div>
                                <p class="mt-2">{{ Str::limit($product->name, 10) }}</p>
                                <p class="font-medium text-violet-900">
                                    {{ format_currency($product->price * (1 - $product->discount / 100)) }}
                                    <span class="text-sm text-gray-500 line-through">
                                        {{ format_currency($product->price) }}</span>
                                </p>

                                {{-- <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-4 w-4 text-yellow-400">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-4 w-4 text-yellow-400">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-4 w-4 text-yellow-400">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-4 w-4 text-yellow-400">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-4 w-4 text-gray-200">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm text-gray-400">(38)</p>
                                </div> --}}

                                <div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
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
                        </div>

                    </swiper-slide>
                @empty
                    <p>Không có sản phẩm nào</p>
@endforelse
            </swiper-container>
        </section>

        <!-- /Special offer card -->

        <!-- bàn phím -->
        <p class="mx-auto mt-10 mb-5 max-w-[1200px] px-5">Bàn phím</p>
        <section class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-4">
            <!-- 1 -->
            @forelse ($products->whereIn('category_id', [1, 2])->take(8) as $product)
                    <div class="flex flex-col">
                        <div class="relative flex">
                            <img class="" src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" />
                            <div
                                class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100">
                                <a href={{ route('productDetail', $product->id) }}
                                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                    <span
                                        class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </span>
                                </a>
                                <span
                                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="h-4 w-4">
                                        <path
                                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                    </svg>
                                </span>
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

                            {{-- <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-gray-200">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-gray-400">(38)</p>
                        </div> --}}

                            <div>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
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
                    </div>
                @empty
                    <p>Không có sản phẩm nào</p>
                @endforelse
        </section>
        <!-- /chuột-->
        <p class="mx-auto mt-10 mb-5 max-w-[1200px] px-5">Chuột</p>
        <section class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-4">
            <!-- 1 -->
            @forelse ($products->whereIn('category_id', [5, 6])->take(8) as $product)
                <div class="flex flex-col">
                    <div class="relative flex">
                        <img class="" src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" />
                        <div
                            class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100">
                            <a href={{ route('productDetail', $product->id) }}
                                class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                <span
                                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </span>
                            </a>
                            <span
                                class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-4 w-4">
                                    <path
                                        d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </span>
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

                        {{-- <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-gray-200">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-gray-400">(38)</p>
                        </div> --}}

                        <div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
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
                </div>
            @empty
                <p>Không có sản phẩm nào</p>
            @endforelse
        </section>
        <!-- /phụ kiện-->
        <p class="mx-auto mt-10 mb-5 max-w-[1200px] px-5">Phụ kiện</p>
        <section class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-4">
            <!-- 1 -->
            @forelse ($products->whereIn('category_id', [7,8,9,10,11,12,13,14])->take(8) as $product)
                <div class="flex flex-col">
                    <div class="relative flex">
                        <img class="" src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" />
                        <div
                            class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100">
                            <a href={{ route('productDetail', $product->id) }}
                                class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                <span
                                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </span>
                            </a>
                            <span
                                class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-4 w-4">
                                    <path
                                        d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </span>
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

                        {{-- <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-yellow-400">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-4 w-4 text-gray-200">
                                <path fill-rule="evenodd"
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-gray-400">(38)</p>
                        </div> --}}

                        <div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
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
                </div>
            @empty
                <p>Không có sản phẩm nào</p>
            @endforelse
        </section>
        <!-- /bài đăng -->
        <section class="my-5">
            <h2 class="text-2xl font-semibold">Bài đăng mới nhất </h2>
            <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" slides-per-view="3"
                space-between="30" free-mode="true">
                @forelse ($renderPosts as $item)
                    <swiper-slide class="p-5 rounded-lg shadow-lg   border-0 border-solid border-indigo-600 bg-slate-50">
                        <div class="flex flex-col ">
                            <a href="{{ route('postDetail', ['id' => $item->id]) }}" class="cursor-pointer">
                                <div class="relative flex">
                                    <img class="w-full" src="{{ asset($item->thumbnail) }}" />
                                    <div class="absolute right-1 mt-3 flex items-center justify-center bg-amber-400">
                                        <p class="px-2 py-2 text-sm">{{ format_posts_status($item->status) }}</p>
                                    </div>
                                </div>

                                <div class="mt-2 text-left">

                                    <p class="mt-2 hover:text-violet-900"> {{ $item->name }}</p>
                                    <p class="font-medium text-violet-900">
                                        Tác giả: {{ $item->user->name }}

                                    </p>
                                    <p class="mt-2 hover:text-violet-900">Ngày đăng:
                                        {{ $item->created_at->format('d/m/Y') }}</p>

                                </div>
                            </a>
                        </div>

                    </swiper-slide>
                @empty
                    <p>Không có bài viết nào</p>
                @endforelse
            </swiper-container>
        </section>
        <!-- /Recommendations -->

        <!-- Desktop Footer  -->

    @endsection
