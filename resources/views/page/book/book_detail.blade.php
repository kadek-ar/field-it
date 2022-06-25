@extends('layout.main')

@section('header_Page', 'Book Detail')

@section('content')



<style>
    .table-col-hover td:hover {
        background: #4B8673 !important;
    }
    .hide-hour tr td{
        color: transparent !important;
    }
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
    .border-yellow{
        border: 3px solid yellow !important;
    }
</style>

<script>

    var time = [];

    function getChange(){
        window.location='/fieldsTo/' + <?php echo $field->id; ?> + '?date='+event.target.value;
    }

    function openFunction(field_type_id, open_time, field_type_name, price, schedule_id='', status = 0) {
        // console.log("field_type_id ", field_type_id);
        // console.log("open_time ", open_time);
        // console.log("field_type_name ", field_type_name);
        // console.log("price ", price);
        // console.log("schedule_id ", schedule_id);
        // console.log("status ", status);

        // document.getElementById(field_type_id + open_time).classList.remove("bg-success");

        let obj = {
            "field_type_id" : field_type_id,
            "open_time": open_time,
            "field_type_name": field_type_name,
            "price": price,
            "schedule_id": schedule_id,
            "status": status
        }
        let tmp = time.find(item => item.field_type_id == field_type_id && item.open_time == open_time);
        

        
        time.push(obj);

        var filterArr = time.filter(function (e) {
            return e.field_type_id != field_type_id || e.open_time != open_time
        })

        // console.log("filterArr ", filterArr);

        if(tmp == undefined){
            document.getElementById(field_type_id + open_time).classList.add("border-yellow");
        }else{
            // let tmp2 = time.findIndex(item => item.field_type_id == field_type_id && item.open_time == open_time);
            // time.splice(tmp2, 1);

            time = time.filter(function (e) {
                return e.field_type_id != field_type_id || e.open_time != open_time
            })

            document.getElementById(field_type_id + open_time).classList.remove("border-yellow");
        }

        rent(field_type_id, open_time);

        if(time.length > 0){
            document.getElementById("book").classList.remove("d-none");
            document.getElementById("book").classList.add("d-block");
        }else{
            document.getElementById("book").classList.add("d-none");
            document.getElementById("book").classList.remove("d-block");
        }
    }

    function rent(field_type_id, open_time){

        // var list = document.getElementById("list");
        let text = ""
        let tmpPrice = 0;
        for (var i = 0; i < time.length; i++){
            text += "<li class='list-group-item ps-0 border-0' >" + time[i].open_time +" - " + addHours(time[i].open_time,1) + " " + time[i].field_type_name + "</li>"
            tmpPrice = tmpPrice + time[i].price
        }

        document.getElementById("totalHours").innerHTML = time.length + " Hours";
        document.getElementById("list").innerHTML = text;
        document.getElementById("priceTotal").innerHTML = "Total Price = " + tmpPrice;
    }

    
    function addHours(timeRent,numOfHours, date = new Date()) {
        var date = new Date('2022-03-14T'+ timeRent);
        date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);

        return date.getHours() + ":" + "00" + ":" + "00";
    }

    function bookNow(field_id, dateParm){
        console.log("dateParm ", dateParm);
        console.log("field_id ", field_id);
        window.location = '/fieldsTo/book/order?field_id=' + field_id  + '&date=' + dateParm + '&arr_order=' + JSON.stringify(time)
        
    }

    var lat = <?php echo $field->lat; ?>;
    var lng = <?php echo $field->lng; ?>;
    function initMap() {
        // The location of Uluru
        const uluru = { lat: lat, lng: lng };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: uluru,
            gestureHandling: "cooperative",
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon: '/img/field_marker.png'
        });
    }

    window.initMap = initMap;

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div style="margin-top: -17px;">
        <div class="bg-img-home mb-4" style="height: 360px;">
            <div style="padding-top: 70px;">
                <div class="mb-5 search-card">
                    <h1 class="text-center mb-3 fw-bold text-white fst-italic text-decoration-underline">
                        {{ $field->name }}
                    </h1>
                    <p style="max-width: 620px;" class="text-center fw-semibold m-auto text-center text-white fs-4 mb-3"> {{ $field->address }} </p>
                    <p style="max-width: 620px;" class="text-center fw-semibold m-auto text-center text-white fs-4"> OPEN HOUR </p>
                    <p style="max-width: 620px;" class="text-center fw-semibold m-auto text-center text-white fs-4 "> 
                        {{\Carbon\Carbon::parse($field->open_time)->format('H:m')}}
                        <span> - </span>
                        {{\Carbon\Carbon::parse($field->close_time)->format('H:m')}}
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white container p-4">
        <div class="mt-3 mb-3" id="map"></div>

        <h2 class="fw-bold fst-italic text-decoration-underline mb-4">BOOK DETAIL</h2>

        <div class="mb-3align-item-center mb-4">
            <label for="" class="fs-4 mb-2 fw-bold me-3">CHOOSE DATE</label>
            <input type="date" value="{{$date}}" onchange="getChange()" id="date" name="date" class="form-control" style="max-width: 250px;">
        </div>
        {{-- @php
            $item_schedule = $schedule->where('date','like', $date)->where('time','like','10:00:00')->first();
        @endphp
        {{dd($item_schedule)}} --}}
        <div>
            <table class="table table-striped table-bordered table-col-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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
                        <tr>
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
                                @if(\Carbon\Carbon::parse($field->open_time)->format('H:00:00') <= $time->open_time && \Carbon\Carbon::parse($field->close_time)->format('H:00:00') >= $time->open_time)
                                    <td scope="col" 
                                        id= "{{$item->id}}{{$time->open_time}}"
                                        @isset($schedule)
                                            @if($item_schedule != null && $item_schedule->status == 2)
                                                style="background-color: gray !important"
                                                {{-- onclick="openFunction({{$item->id}}, '{{$time->open_time}}', '{{$item->name}}', {{$item->price}}, {{$item_schedule->id}}, {{$item_schedule->status}})" --}}
                                            @elseif($item_schedule != null && $item_schedule->status == 3)
                                                style="background-color: red !important"
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
                                        class=" 
                                                    bg-success 
                                                "
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
                                @else
                                    <td>Empty</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <div class="d-flex mb-2">
                <div class="rounded me-3" style="background: red; width: 25px; height: 25px"></div>
                <div class="fw-bold">Booked</div>
            </div>
            <div class="d-flex mb-2">
                <div class="rounded me-3" style="background: rgba(25,135,84); width: 25px; height: 25px"></div>
                <div class="fw-bold">Avaiable</div>
            </div>
            <div class="d-flex mb-2">
                <div class="rounded me-3" style="background: grey; width: 25px; height: 25px"></div>
                <div class="fw-bold">Close</div>
            </div>
        </div>

        <hr>

        <div id="book" class="d-none">
            <div class="w-50">
                <h3 class="fw-bold mb-3">TOTAL DURATION CHOOSED</h3>
                <div id="totalHours" class="fw-bold"></div>
                <ul id="list" class="list-group list-group-flush"></ul>
                <hr>
                <div class="fw-bold" id="priceTotal"></div>
            </div>
            <div class="text-center">
                {{-- <form action="/fieldsTo/book/order?field_id={{$field->id}}&date={{$date}}" method="post">
                    @csrf
                     <textarea class="d-none" name="order_list" id="order_list" cols="99" rows="99"></textarea>
                    <button type="submit" onsubmit="bookNow({{$field->id}}, {{$date}})" class="btn btn-outline-success">Continue</button>
                </form> --}}
                <button type="submit" onclick="bookNow({{$field->id}}, '{{$date}}')" class="btn btn-success fw-bold fs-5 ps-4 pe-4">CONTINUE</button>
            </div>
        </div>

    </div>

@endsection