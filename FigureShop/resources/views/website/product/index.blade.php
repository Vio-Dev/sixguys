@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('content')
    <section class="container mx-auto flex-grow max-w-[1200px] border-b py-5 lg:flex lg:flex-row lg:py-10">
        <!-- sidebar  -->
        <section class="hidden w-[300px] flex-shrink-0 px-4 lg:block">
            <div class="flex border-b pb-5">
                <div class="w-full">
                    <p class="mb-3 font-medium">Danh mục</p>
                    @foreach ($renderCategories as $category)
                        <div class="flex w-full justify-between">
                            <div class="flex justify-center items-center">
                                <input type="checkbox" />
                                <p class="ml-4">{{ $category->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex border-b py-5">
                <div class="w-full">
                    <p class="mb-3 font-medium">Lọc theo nhu cầu</p>

                    @foreach ($renderSubCategories as $subCategory)
                        <div class="flex w-full justify-between">
                            <div class="flex justify-center items-center">
                                <input type="checkbox" />
                                <p class="ml-4">{{ $subCategory->name }}</p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

            <div class="flex border-b py-5">
                <div class="w-full">
                    <p class="mb-3 font-medium">PRICE</p>

                    <div class="flex w-full">
                        <div class="flex justify-between">
                            <input x-mask="99999" min="50" type="number" class="h-8 w-[90px] border pl-2"
                                placeholder="50" />
                            <span class="px-3">-</span>
                            <input x-mask="999999" type="number" max="999999" class="h-8 w-[90px] border pl-2"
                                placeholder="99999" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex border-b py-5">
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
            </div>
        </section>
        <!-- /sidebar  -->

        <div>
            <div class="mb-5 flex items-center justify-between px-5">
                <div class="flex gap-3">
                    <button class="flex items-center justify-center border px-6 py-2">
                        Sort by
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mx-2 h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <button class="flex items-center justify-center border px-6 py-2 md:hidden">
                        Filters
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mx-2 h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>


            </div>

            <section class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="flex flex-col">
                        <div class="relative flex">
                            <img class="" src="{{ asset($product->thumbnail) }}" alt="sofa image" />
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
                            <p class="mt-2">{{ $product->name }}</p>
                            <p class="font-medium text-violet-900">
                                {{ format_currency($product->price * (1 - $product->discount / 100)) }}
                                <span class="text-sm text-gray-500 line-through">
                                    {{ format_currency($product->price) }}</span>
                            </p>

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
                                <p class="text-sm text-gray-400">(38)</p>
                            </div>
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
                @endforeach

                <!-- 2 -->


            </section>
        </div>
    </section>
@endsection
