@extends('layout.main')

@section('header_Page', 'Home')

@section('content')

<div class="container">
    <div class="shadow-lg p-4 rounded bg-white">
        <div class="topic mb-5">
            <h1 class="text-center fw-bold ">{{ $news->title }}</h1>
        </div>
        <div class="m-auto" style="max-width: 550px;">
            <img class="text-center w-100" src="/uploads/img/{{$news->image}}" alt="">
        </div>
        <hr>
        <div>
            <p> {{$news->description}} </p>
        </div>

    </div>
</div>

@endsection