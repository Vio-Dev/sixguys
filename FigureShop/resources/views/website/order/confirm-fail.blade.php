@extends('layouts.app')

@section('title', 'Đặt hàng thất bại')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[400px] space-y-4">
        <div>
            <img src="{{ asset('status/cancel.gif') }}" alt="">
        </div>
        <div class="text-2xl font-bold text-red-500">
            Đặt hàng thất bại
        </div>

        <div>Liên hệ admin để được hỗ trợ</div>
    </div>
@endsection
