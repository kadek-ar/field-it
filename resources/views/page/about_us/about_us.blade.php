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
                <img class="w-25" src="/img/logops.webp" alt="">
            </div>
            <p class="text-center ps-4 pe-4 pb-4 fs-5 m-auto max-w-799">
                Field-IT is a technology platform for online sports field rental services. Providing solutions to the problem of conventional field rental, Field-IT provides many field choices, flexibility in choosing a sports field rental schedule, and easy online payments.
            </p>
        </div>
    </div>


    <br>
    <b class="container sub_topic1 mb-2">Contact Us</b>
    
    <div class="container text-justify sub_topic2 mt-1">
        <svg style="margin-bottom: 4px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2 bi bi-envelope" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
        </svg>
        <span>Fielditbusiness@gmail.com</span>
            
    </div>
</div>

@endsection