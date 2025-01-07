@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[400px] space-y-4">
        <div>
            <img src="{{ asset('status/success.gif') }}" alt="">
        </div>
        <div class="text-2xl font-bold text-green-500">
            @if (isset($message))
                {{ $message }}
            @else
                Đặt hàng thành công
            @endif
        </div>

        <div>Cảm ơn bạn đã đặt hàng tại {{ config('app.name') }}</div>
        <div>Tiếp tục <a href="{{ route('products') }}" class="text-violet-900 font-bold underline">Mua sắm</a></div>
    </div>
@endsection
