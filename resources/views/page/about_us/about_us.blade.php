@extends('layout.main')

@section('header_Page', 'About Us')

@section('content')

<div class="container shadow-lg p-4 rounded bg-white">
    <div class="pb-5">
        <div class="topic">
            <h1 class="text-center fw-bold pb-1">ABOUT US</h1>
        </div>
        <hr>
        <div class="container mt-5">
            <div class="mb-5 text-center">
                <img class="w-25" src="/img/logops.png" alt="">
            </div>
            <p class="text-center ps-4 pe-4 pb-4 fs-5 m-auto max-w-799">
                Field-It adalah media online yang menyediakan jasa peminjaman lapangan futsal yang menampilkan jadwal secara real-time
                , menyediakan banyak pilihan lapangan, dan fleksibilitas dalam pengaturan jadwal.
            </p>
        </div>
    </div>


    <br>
    <b class="container sub_topic1">For more information and reservations</b>
    <br>
    <p class="container text-justify sub_topic2">
            www.field-it.com
            <br>
            E-mail: field-it@binus.ac.id
            <br>
    </p>
</div>

@endsection