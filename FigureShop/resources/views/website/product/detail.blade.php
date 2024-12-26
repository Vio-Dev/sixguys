@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <section class="container flex-grow mx-auto max-w-[1200px] border-b py-5 lg:grid lg:grid-cols-2 lg:py-10">
        <!-- image gallery -->

        <div class="container mx-auto px-4">
            <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="detailSwiper_1"
                thumbs-swiper=".detailSwiper_2" loop="true" space-between="10" navigation="true">
                @foreach ($product->images as $img)
                    <swiper-slide class="swiper__slide">
                        <img class="swiper__slide--img" src="{{ asset($img->url_img) }}" alt="{{ $img->alt_img }}" />
                    </swiper-slide>
                @endforeach

            </swiper-container>

            <swiper-container class="detailSwiper_2" loop="true" space-between="10" slides-per-view="4" free-mode="true"
                watch-slides-progress="true">
                @foreach ($product->images as $img)
                    <swiper-slide class="swiper__slide">
                        <img class="swiper__slide--img" src="{{ asset($img->url_img) }}" alt="{{ $img->alt_img }}" />
                    </swiper-slide>
                @endforeach
            </swiper-container>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
            <!-- /image gallery  -->
        </div>

        <!-- description  -->

        <div class="mx-auto px-5 lg:px-5">
            <h2 class="pt-3 text-2xl font-bold lg:pt-0">{{ $product->name }}</h2>
            {{-- start rating --}}
            <div class="mt-1">
                <div class="flex items-center">
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

                    <p class="ml-3 text-sm text-gray-400">(150 reviews)</p>
                </div>
            </div>
            {{-- end rating --}}


            <p class="font-bold">
                Danh mục: <span class="font-normal">{{ $product->category->name }}</span>
            </p>
            <p class="font-bold">
                SKU: <span class="font-normal">{{ $product->id }}</span>
            </p>

            <p class="mt-4 text-4xl font-bold text-violet-900">
                {{ format_currency($product->price * (1 - $product->discount / 100)) }} <span
                    class="text-xs text-gray-400 line-through"> {{ format_currency($product->price) }}</span></span>
            </p>

            <p class="pt-5 text-sm leading-5 text-gray-500">
                {!! $product->shortDescription !!}
            </p>

            {{-- variant start --}}
            {{-- <div class="mt-6">
                <p class="pb-2 text-xs text-gray-500">Kích cỡ</p>

                <div class="flex gap-1">
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
            </div> --}}

            {{-- <div class="mt-6">
                <p class="pb-2 text-xs text-gray-500">Màu sắc</p>

                <div class="flex gap-1">
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
            </div> --}}
            {{-- variant end --}}
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="price" value="{{ $product->price * (1 - $product->discount / 100) }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                {{-- <input type="hidden" name="variant_value_id" value=""> --}}
                <div class="mt-6" x-data="{ quantity: 1 }">
                    <p class="pb-2 text-xs text-gray-500">Số lượng</p>

                    <div class="flex">
                        <button type="button" @click="if(quantity > 1) quantity--"
                            class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                            &minus;
                        </button>
                        <div
                            class="flex h-8 w-8 cursor-text items-center justify-center border-t border-b active:ring-gray-500">
                            <span x-text="quantity"></span>
                            <input type="hidden" name="quantity" :value="quantity">
                        </div>
                        <button type="button" @click="quantity++"
                            class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
                            &#43;
                        </button>
                    </div>
                </div>

                <div class="mt-7 flex flex-row items-center gap-6">
                    <button
                        class="flex h-12 w-1/2 items-center justify-center bg-violet-900 text-white duration-100 hover:bg-blue-800"
                        type="submit" <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="mr-3 h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        Thêm vào giỏ hàng
                    </button>
                    <button
                        class="flex h-12 w-1/2 items-center justify-center bg-amber-400 duration-100 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mr-3 h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>

                        Thêm vào yêu thích
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- product details  -->

    <section class="container mx-auto max-w-[1200px] px-5 py-5 lg:py-10">
        <h2 class="text-xl">Chi tiết sản phẩm</h2>
        <p class="mt-4 lg:w-3/4">
            {!! $product->description !!}
        </p>


    </section>
    <!-- /product details  -->


    <p class="mx-auto mt-10 mb-5 max-w-[1200px] px-5">Sản phẩm liên quan</p>
    <p>here</p>

@endsection
