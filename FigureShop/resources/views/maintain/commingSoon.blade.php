@extends('layouts.app')

@section('title', 'Coming Soon')

@section('content')

    <div class="container flex flex-col justify-between items-center mx-auto h-[400px]:">
        <img src="{{ asset('status/comingsoon.gif') }}" alt="" class="h-[300px]">
        <h2>
            Tính năng đang phát triển
        </h2>
    </div>
@endsection
