@extends('layout.owner')

@section('header_Page', 'View')

@section('content')


<div class="container">
    {{-- <h1 class="mb-3">Order List</h1> --}}
    <div class="d-flex justify-content-center mt-3">
        <h1 class="text-center fw-bold">Order List</h1>
    </div>
    <hr>
    @if(!isset($order) || count($order) == 0)
        <h3 class="text-center"> You Don't have any order</h3>
    @else
        <div class="mb-3 fw-bold mt-4">
            Revenue From this month : Rp.{{$total_price}}
        </div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
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
                        @php
                            if($item->json_result != null){
                                $json_pay = json_decode($item->json_result, true);
                            }
                            // dd($json_pay["transaction_status"]);
                        @endphp
                        @if ($item->json_result != null && $json_pay["transaction_status"] == "settlement")
                            <td> <span class="badge text-bg-success">Payment Success</span> </td>
                        @else
                            <td> <span class="badge text-bg-primary">Pending payment</span> </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>


@endsection