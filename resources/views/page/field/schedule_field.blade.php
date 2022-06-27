@extends('layout.owner')

@section('header_Page', 'View')

@section('content')

<style>
    .table-col-hover td:hover {
        background: #4B8673 !important;
    }
    .hide-hour tr td{
        color: transparent !important;
    }
</style>

<script>

    var id, hour, field_type, price

    function openFunction(id, hour, field_type, price, schedule_id='', status = 0) {
        this.id = id;
        this.hour = hour;
        this.field_type = field_type;
        this.price = price;
        document.getElementById('modalTitle').innerHTML = "Manage for " + field_type
        if(price != 0 && price != ''){
            document.getElementById('price').setAttribute('value',price)
        }
        document.getElementById('typeFieldId').setAttribute('value',id)
        document.getElementById('time').setAttribute('value',hour)
        document.getElementById('schedule_id').setAttribute('value',schedule_id)

        var btnText = document.getElementById("btnText");
        var btnPrice = document.getElementById('btnPrice');
        if(status == 2){
            btnPrice.classList.add('d-none');
            if(btnText.innerHTML === "Close For This Column"){
                btnText.innerHTML = "Open For This Column"
            }else{
                btnText.innerHTML = "Close For This Column"
            }
        }else{
            btnPrice.classList.remove('d-none');
        }

        document.getElementById('typeFieldId2').setAttribute('value',id)
        document.getElementById('time2').setAttribute('value',hour)
        document.getElementById('schedule_id2').setAttribute('value',schedule_id)

    }

    // function openCol(id, hour, field_type, price, schedule_id='', close = 0){

    //     var btnText = document.getElementById("btnText");
    //     if(btnText.innerHTML === "Close For This Column"){
    //         btnText.innerHTML = "Open For This Column"
    //     }else{
    //         btnText.innerHTML = "Close For This Column"
    //     }

    //     document.getElementById('typeFieldId2').setAttribute('value',id)
    //     document.getElementById('time2').setAttribute('value',hour)
    //     document.getElementById('schedule_id2').setAttribute('value',schedule_id)
        
    // }

    function getChange(){
        window.location='/field/schedule?date='+event.target.value;
    }
</script>


<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <button id="btnPrice" class="btn btn-success mb-3" data-bs-target="#modalEdit2" data-bs-toggle="modal">Change Price</button>
                <form action="/schedule/update/{{ 2 }}?date={{$date}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger" id="btnText">Close Schedule</button>
                    <input id="typeFieldId2" name="id" type="text" class="d-none">
                    <input id="time2" name="time" type="text" class="d-none">
                    <input id="schedule_id2" name="schedule_id" type="text" class="d-none">
                    {{-- <input type="text" name="schedule_id" id="close_id" class="d-none"> --}}
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit2" tabindex="-1" aria-labelledby="modalEdit2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/schedule/update/{{ 1 }}?date={{$date}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="number" id="price" name="price" class="form-control" placeholder="price" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>
                        <input id="typeFieldId" name="id" type="text" class="d-none">
                        <input id="time" name="time" type="text" class="d-none">
                        <input id="schedule_id" name="schedule_id" type="text" class="d-none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    {{-- <h1 class="mb-5">Manage Your Schedule</h1> --}}
    <div class="d-flex justify-content-center mt-3">
        <h1 class="text-center fw-bold">Manage Schedule</h1>
    </div>
    <hr>
    <div class="mb-3 d-flex align-item-center">
        <label for="" class="fs-3 fw-bold me-3">Date : </label>
        <input type="date" value="{{$date}}" onchange="getChange()" id="date" name="date" class="form-control" style="max-width: 250px;" id="date">
    </div>
    {{-- @php
        $item_schedule = $schedule->where('date','like', $date)->where('time','like','10:00:00')->first();
    @endphp
    {{dd($item_schedule)}} --}}
    <div>
        <table class="table table-striped table-bordered table-col-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">Time</th>
                    @foreach ($field_type as $item)
                        <th scope="col" >
                            <div>{{ $item->name }}</div>
                            <div>Rp.{{ $item->price }}</div>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="hide-hour">
                @foreach ($schedule_time as $time)
                    <tr class="text-center">
                        <th scope="row">{{\Carbon\Carbon::parse($time->open_time)->format('H:00')}} - {{\Carbon\Carbon::parse($time->close_time)->format('H:00')}}</th>
                        @foreach ($field_type as $key => $item)
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like',$time->open_time)
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                {{-- @if ($item_schedule != null)
                                    @if($item_schedule->status == 2)
                                        <td scope="col" style="background-color: gray !important">
                                            {{ $item->price }}
                                        </td>
                                    @endif
                                @endif --}}
                            @endisset
                            <td scope="col" 
                                @isset($schedule)
                                    @if($item_schedule != null && $item_schedule->status == 2)
                                        style="background-color: gray !important"
                                        onclick="openFunction({{$item->id}}, '{{$time->open_time}}', '{{$item->name}}', {{$item->price}}, {{$item_schedule->id}}, {{$item_schedule->status}})"
                                    @else
                                        @if($item_schedule != null)
                                            onclick="openFunction({{$item->id}}, '{{$time->open_time}}', '{{$item->name}}', {{$item_schedule->price == null ? $item->price : $item_schedule->price}}, {{$item_schedule->id}})"
                                        @else
                                            onclick="openFunction({{$item->id}}, '{{$time->open_time}}', '{{$item->name}}', {{$item->price}})"
                                        @endif
                                    @endif
                                @else
                                    onclick="openFunction({{$item->id}}, '{{$time->open_time}}', '{{$item->name}}', {{$item->price}})" 
                                @endisset
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit" 
                                class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= $time->open_time && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= $time->open_time) 
                                            bg-success 
                                        @endif"
                            >
                                @isset($schedule)
                                    @if($item_schedule != null && $item_schedule->status != 2 && $item_schedule->price != null)
                                        <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                    @else
                                        {{ $item->price }}
                                    @endif
                                @else
                                    {{ $item->price }}
                                @endisset
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            {{-- <tbody class="hide-hour">
                <tr>
                    <th scope="row">07:00 - 08:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col" onclick="openFunction({{$item->id}}, '07:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" 
                            class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '07:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '07:00:00') 
                                        bg-success 
                                    @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','07:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">08:00 - 09:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '08:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '08:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '08:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','08:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">09:00 - 10:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '09:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '09:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '09:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','09:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">10:00 - 11:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '10:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '10:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '10:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','10:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">11:00 - 12:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '11:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '11:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '11:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','11:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">12:00 - 13:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '12:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '12:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '12:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','12:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">13:00 - 14:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '13:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '13:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '13:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','13:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">14:00 - 15:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '14:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '14:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '14:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','14:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">15:00 - 16:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '15:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '15:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '15:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','15:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">16:00 - 17:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '16:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '16:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '16:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','16:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">17:00 - 18:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '17:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '17:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '17:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','17:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">18:00 - 19:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '18:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '18:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '18:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','18:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">19:00 - 20:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '19:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '19:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '19:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','19:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">20:00 - 21:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '20:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '20:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '20:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','20:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">21:00 - 22:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col"  onclick="openFunction({{$item->id}}, '21:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '21:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '20:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','21:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">22:00 - 23:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col" onclick="openFunction({{$item->id}}, '22:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '22:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '22:00:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','22:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th scope="row">23:00 - 24:00</th>
                    @foreach ($field_type as $key => $item)
                        <td scope="col" onclick="openFunction({{$item->id}}, '23:00:00', '{{$item->name}}', {{$item->price}})" data-bs-toggle="modal" data-bs-target="#modalEdit" class="@if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= '23:00:00' && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= '22:03:00') bg-success @endif">
                            @isset($schedule)
                                @php
                                    $item_schedule = $schedule->where('date','like', $date)
                                    ->where('time','like','23:00:00')
                                    ->where('field_types_id','like',$item->id)
                                    ->first();
                                @endphp
                                @if($item_schedule != null)
                                    <span style="color:#ffff !important">Price Change To <b>Rp.{{$item_schedule->price}}</b></span>
                                @else
                                    {{ $item->price }}
                                @endif
                            @else
                                {{ $item->price }}
                            @endisset
                        </td>
                    @endforeach
                </tr>
            </tbody> --}}
        </table>
    </div>
</div>



@endsection