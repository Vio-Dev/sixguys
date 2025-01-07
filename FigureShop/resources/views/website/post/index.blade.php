@extends('layouts.app')

@section('title', 'bài viết')

@section('content')
    <div>
        @forelse ($renderPosts as $item)
            <div class="p-5 rounded-lg shadow-lg   border-0 border-solid border-indigo-600 bg-slate-50">
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

            </div>
        @empty
            <p>Không có bài viết nào</p>
        @endforelse
    </div>
@endsection
