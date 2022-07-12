@extends('layout.admin')

@section('header_Page', 'News')

@section('content')

    <div class="container">
        <h1 class="mb-3">News Page</h1>
            @isset($news)
                <div class="mt-4">
                    
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created date</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        <svg onclick="deleteSessionBtn('{{$item->id}}')" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-danger bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        function deleteSessionBtn(id){
                            Swal.fire({
                                    title: `Delete News`,
                                    text: "Are you sure you want to delete this news?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No',
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location = '/admin/news/delete/' + id ;
                                }
                            });
                        
                        }
                    </script>
                </div>
                <hr class="mt-4 mb-4">
            @endisset
            <h3 class="mb-3">Create New News</h3>
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