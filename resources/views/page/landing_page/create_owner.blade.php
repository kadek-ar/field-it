@extends('layout.main')

@section('header_Page', 'Owner')

@section('content')

    <div class="container" style="margin-top: 104px">
        <h1 class="text-center">Become An Owner Field, To Create Your Own Field</h1>
    
        <form action="/owner/create" method="post">
            @csrf
            <div class="mb-3">
                <input type="text" name="company_name" class="form-control" id="exampleFormControlInput1" placeholder="Type Your Company Name">
            </div>
    
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-outline-primary" type="submit">Create Owner Account</button>
            </div>

        </form>

    </div>

@endsection
