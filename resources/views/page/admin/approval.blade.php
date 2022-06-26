@extends('layout.admin')

@section('header_Page', 'Approval')

@section('content')

    <div class="container">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Company Name</th>
                    <th>Field Name</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($field as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->company_name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if($item->status == 2)
                                <span class="text-center text-success fw-bold">Approved</span>
                            @else
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$key}}">
                                    Approve Field
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$key}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{$key}}">Approval For "{{ $item->name }}"</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <img style="max-width: 250px;" src="{{ asset('storage/img/'.$item->image) }}" alt=""> --}}
                                                <img style="max-width: 250px;" src="{{Storage::disk('s3')->temporaryUrl($item->image, now()->addMinutes(60))}}" alt="">
                                                <div class="d-flex">
                                                    <div class="m-2">
                                                        <span class="fw-bold">Jam Buka</span>
                                                        <div>{{ $item->open_time}}</div>
                                                    </div>
                                                    <div class="m-2">
                                                        <span class="fw-bold">Jam Tutup</span>
                                                        <div>{{ $item->close_time}}</div>
                                                    </div>
                                                </div>
                                
                                                <div class="ms-2">
                                                    <span class="fw-bold">Alamat</span>
                                                    <p>{{ $item->address}}</p>
                                                </div>
                                
                                                <div class="ms-2">
                                                    <span class="fw-bold">Deskripsi</span>
                                                    <p>{{ $item->description}}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/admin/reject/{{$item->id}}" method="post">
                                                    @csrf
                                                    {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reject</button> --}}
                                                    <button type="submit" class="btn btn-danger">Reject</button>

                                                </form>
                                                <form action="/admin/approve/{{$item->id}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

@endsection