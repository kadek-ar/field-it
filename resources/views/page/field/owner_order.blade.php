@extends('layout.owner')

@section('header_Page', 'View')

@section('content')


<div class="container">
    <h1 class="mb-3">Order List</h1>
    <div class="mb-3">
        Revenue From this month : Rp.{{$total_price}}
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Buyer Name</th>
                <th scope="col">Price</th>
                <th scope="col">Payment Type</th>
                <th scope="col">Booking date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $item)
                <tr>
                    <td>FT-{{ $item->id }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->total_price }}</td>
                    <td>{{ $item->payment_type }}</td>
                    <td>{{ $item->book_date }}</td>
                    @if ($item->payment_status == 2)
                        <td> <span class="badge text-bg-success">Payment Success</span> </td>
                    @else
                        <td> <span class="badge text-bg-primary">Pending payment</span> </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
      </table>
</div>


@endsection