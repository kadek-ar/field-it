@extends('layout.main')

@section('header_Page', 'Book Detail')

@section('content')

        <div class="container">
            <h1 class="mb-5">Booking List</h1>

            @if(count($order) == 0)
                <h3 class="text-center"> You Don't have any order</h3>
            @endif

            @foreach ($order as $item)
                <div class="card shadow-lg p-3 mb-3">
                    <div class="ps-3">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bolder fs-3">FT-{{ $item->id }}</span>
                            <div>
                                @if ($item->payment_status == 2)
                                    <span class="badge text-bg-success">Payment Success</span>
                                @else
                                    <span class="badge text-bg-primary">Pending Payment</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex mt-1 mb-1">
                            <div class="fw-bold">Booking Date    </div>
                            <div style="margin-left: 15px; margin-right: 17px;">:</div>
                            <div>{{ $item->book_date }}</div>
                        </div>

                        <div class="d-flex">
                            <div class="fw-bold">Price </div>
                            <div style="margin-left: 77px; margin-right: 17px;">:</div>
                            <div>Rp.{{ $item->total_price }}</div>
                        </div>

                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="/fieldsTo/book/pay?order_id={{$item->id}}&date={{$item->book_date}}" type="button" class="btn btn-outline-success float-end">View Detail</a>
                    </div>
                    
                </div>
            @endforeach

        </div>

@endsection