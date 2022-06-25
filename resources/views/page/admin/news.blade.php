@extends('layout.admin')

@section('header_Page', 'News')

@section('content')

    <div class="container">
        <h1 class="mb-3">News Page</h1>
            <form action="/admin/news/upload" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">News Title</label>
                        <input class="form-control" type="text" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">News Thumbnail</label>
                        <input class="form-control" type="file" name="image" id="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">News Content</label>
                        <textarea class="form-control" name="description" id="description" rows="8" required></textarea>
                    </div>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" type="submit">Upload News</button>
                </div>
            </form>
    </div>

@endsection