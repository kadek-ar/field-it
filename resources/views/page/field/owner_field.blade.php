@extends('layout.owner')

@section('header_Page', 'View')

@section('content')

<style>
    .hide-hour tr td{
        color: transparent !important;
    }
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>

    <div>
        @if(isset($field))
        @if($field->status == 1)
        <h1 class="text-center">Your Field is on progress to be approved, Please Wait or contact admin</h1>
        @else
        <div class="shadow-lg p-3">
            <div>
                <h1 class="ms-2 text-center fw-bold ">{{$field->name}}</h1>
                <hr>
                <div class="d-flex mb-4">
                    <div class="w-50">
                        {{-- <img class="w-100 ms-2" src=" {{ asset('storage/img/'.$field->image) }} " alt=""> --}}
                        {{-- <img class="w-100 ms-2" src="/uploads/img/{{$field->image}}" alt=""> --}}
                        <img class="w-100 ms-2" src="{{Storage::disk('s3')->temporaryUrl($field->image, now()->addMinutes(60))}}" alt="">
                    </div>
                    <div class="w-50 ps-4">
                        <div class="m-2">
                            {{-- <h2 class="mb-3 fw-bold">{{$field->name}}</h2>
                            <hr> --}}
                            <span class="fw-bold fs-5">Open Time</span>
                            <div class="d-flex mt-2">
                                <div>{{ \Carbon\Carbon::parse($field->open_time)->format('H:00') }}</div> 
                                <div class="ms-2 me-2">-</div> 
                                <div>{{ \Carbon\Carbon::parse($field->close_time)->format('H:00') }}</div>
                            </div>
                        </div>
        
                        <div class="ms-2">
                            <span class="fw-bold fs-5">Address</span>
                            <p class="mt-2">{{ $field->address}}</p>
                        </div>

                        <div class="ms-2">
                            <span class="fw-bold fs-5">Description</span>
                            <p class="mt-2">{{ $field->description}}</p>
                        </div>
                        
                    </div>
                </div>

{{-- 
                <div class="d-flex">
                    <div class="m-2">
                        <span class="fw-bold">Jam Buka</span>
                        <div>{{ \Carbon\Carbon::parse($field->open_time)->format('H:00') }}</div>
                    </div>
                    <div class="m-2">
                        <span class="fw-bold">Jam Tutup</span>
                        <div>{{ \Carbon\Carbon::parse($field->close_time)->format('H:00')}}</div>
                    </div>
                </div> --}}

                

            </div>

            <div class="ms-2">
                <span class="fw-bold fs-5">Location on Map</span>
                <div id="map" class="mt-3"></div>
            </div>

            

            @isset($schedule)
            <div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            @foreach ($schedule as $item)
                                <th scope="col @if($item->open_time == '07:00:00') bg-success @endif" >{{ $item->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="hide-hour">
                        <tr>
                            <th scope="row">07:00 - 08:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '07:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">08:00 - 09:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '08:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">09:00 - 10:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '09:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">10:00 - 11:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '10:00:00') bg-success @endif">{{ $item->open_time }}</td>
                                
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">11:00 - 12:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '11:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">12:00 - 13:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '12:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">13:00 - 14:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '13:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">14:00 - 15:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '14:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">15:00 - 16:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '15:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">16:00 - 17:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '16:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">17:00 - 18:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '17:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">18:00 - 19:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '18:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">20:00 - 21:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '20:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">21:00 - 22:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '21:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row">22:00 - 23:00</th>
                            @foreach ($schedule as $item)
                                <td scope="col" class="@if($item->open_time == '22:00:00') bg-success @endif">{{ $item->open_time }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            @endisset

        </div>
        
        @endif

        <script>
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


        @else

            <h1>You Dont Have Any Field</h1>

        @endif
    </div>

@endsection