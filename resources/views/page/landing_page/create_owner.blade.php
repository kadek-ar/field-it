@extends('layout.main')

@section('header_Page', 'Owner')

@section('content')

    <div class="container" style="margin-top: 58px">
        <div class="shadow-lg p-4 rounded bg-white">
            <h1 class="text-center pb-5">Create Your Own Field to Become an Owner Field Account</h1>
        
            <form action="/owner/create" method="post">
                @csrf
                <div class="mb-3">
                    <input type="text" name="company_name" class="form-control" id="exampleFormControlInput1" placeholder="Type Your Company Name">
                </div>
        
                <div class="d-grid gap-2 col-6 mx-auto mt-5">
                    <button class="btn btn-success" type="submit">Create Owner Account</button>
                </div>
    
            </form>

        </div>

    </div>

@endsection
