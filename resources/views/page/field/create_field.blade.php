@extends('layout.owner')

@section('header_Page', 'create')

@section('content')

<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 80%;
        /* The width is the width of the web page */
    }
</style>

    <div class="container">
        @if(!isset($field))
        <div>
            <h1>Register Field</h1>
            <form action="/field/store" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Field Name</label>
                    <input type="text" class="form-control" name="name" placeholder="name@example.com" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Detail Alamat</label>
                    <input type="text" class="form-control" name="address" placeholder="Masukkan Detail Alamat" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Pilih Lokasi Sesuai Peta</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="search" placeholder="Search Location" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" onclick="searchLocation()" type="button" id="button-addon2">Search</button>
                    </div>
                    <div id="map"></div>
                    <input type="text" id="mapValue" name="latlng" class="form-control-plaintext" id="staticEmail" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Open Time</label>
                    <input type="time" class="form-control" name="open_time" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Close Time</label>
                    <input type="time" class="form-control" name="close_time" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload File Image</label>
                    <input class="form-control" name="image" type="file" id="formFile" required>
                </div>
{{-- 
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Schedule and Price Detail (.xlsx)</label>
                    <input class="form-control" type="file" name="schedule" id="formFile">
                </div> --}}

                <button type="submit" class="btn btn-success fw-bold mb-5 ps-4 pe-4">Continue</button>

            </form>
        </div>

        @else
        <div class="d-flex justify-content-center mt-3">
            <h1 class="text-center fw-bold">Create Field Type</h1>
            {{-- <div>
                @isset($field_type)
                    <a href="/field/schedule" class="btn btn-outline-primary">Manage Your Schedule</a>
                @endisset
            </div> --}}
        </div>
        <hr>
        <form class="mb-4" action="/create/type" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Field Type</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Input Type Field Name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                    <input type="number" name="price" class="form-control" placeholder="price" aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-success fw-bold ps-4 pe-4" type="submit">Create Type</button>
            </div>
            {{-- <hr style="margin-top: 35px"> --}}

        </form>
        @isset($field_type)
            <table class="table table-striped mt-5">
                <thead class="table-success">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">FIeld Type Name</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($field_type as $key => $item)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>Rp.{{ $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
        

        {{-- <div class="">
            <h1>Create Schedule For {{ $field->name }}</h1>
            <form action="/schedule/create/{{$field->id}}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Date Time</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Sub Field Name</label>
                    <input type="text" name="name" id="name" placeholder="Input Sub Field Name" required>
                </div>

                <div class="mb-3">
                    <div>
                        <label class="form-label">Jam Penyewaan</label>
                        <select class="form-select" name="open_time" aria-label="Default select example" required>
                            <option selected>Open this select menu</option>
                            <option value="07:00:00">07:00 - 08:00</option>
                            <option value="08:00:00">08:00 - 09:00</option>
                            <option value="09:00:00">09:00 - 10:00</option>
                            <option value="10:00:00">10:00 - 11:00</option>
                            <option value="11:00:00">11:00 - 12:00</option>
                            <option value="12:00:00">12:00 - 13:00</option>
                            <option value="13:00:00">13:00 - 14:00</option>
                            <option value="14:00:00">14:00 - 15:00</option>
                            <option value="15:00:00">15:00 - 16:00</option>
                            <option value="16:00:00">16:00 - 17:00</option>
                            <option value="17:00:00">17:00 - 18:00</option>
                            <option value="18:00:00">18:00 - 19:00</option>
                            <option value="20:00:00">20:00 - 21:00</option>
                            <option value="21:00:00">21:00 - 22:00</option>
                            <option value="22:00:00">22:00 - 23:00</option>
                        </select>
                    </div>

                    
                </div>

                
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-primary" type="button">Buat Jadwal</button>
                </div>
                
            </form>
        </div> --}}

        @endif

        <script>

            var latitude = -6.200000;
            var longitude = 106.816666;

            function searchLocation (){
            let search = document.getElementById("search").value;
                fetch("https://maps.googleapis.com/maps/api/geocode/json?address="+ search +'&key=AIzaSyAjmq12Yg6RU5UhDvdeBPlXcE6WUulIT40')
                .then(response => response.json())
                .then(data => {
                    console.log("data ", data);
                    if(data.status == 'ZERO_RESULTS'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Location Not Found',
                        })
                    }
                    latitude = data.results[0].geometry.location.lat;
                    longitude = data.results[0].geometry.location.lng;
                   
                    initMap()
                })

            }

            var marker, map;
            var mapValue = document.getElementById("mapValue");
            function initMap() {
                const myLatlng = { lat: latitude, lng: longitude };

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    center: myLatlng,
                });

                // Create the initial InfoWindow.
                // var infoWindow = new google.maps.InfoWindow({
                //     content: "Click the map to get Lat/Lng!",
                //     position: myLatlng,
                // });

                // infoWindow.open(map);

                // Configure the click listener.
                map.addListener("click", (mapsMouseEvent) => {
                    // mapValue.setAttribute('value',JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2));
                    mapValue.value = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                    console.log("mapsMouseEvent.latLng ", mapsMouseEvent.latLng);
                    placeMarker(mapsMouseEvent.latLng);

                    // // Close the current InfoWindow.
                    // infoWindow.close();

                    // // Create a new InfoWindow.
                    // infoWindow = new google.maps.InfoWindow({
                    //     position: mapsMouseEvent.latLng,
                    // });
                    // infoWindow.setContent(
                    //     JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                    // );
                    // infoWindow.open(map);
                    
                    
                    // console.log(JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2));
                });

                function placeMarker(loc) {
                    console.log("loc.lat ", loc.lat()  );
                    console.log("loc.lng ", loc.lng()  );
                    console.log("marker ", marker);
                    // if (!marker || !marker.setPosition) {
                    if (!marker || !marker.setPosition) {
                            marker = new google.maps.Marker({
                            position: loc,
                            map: map,
                        });
                    } else {
                        marker.setPosition(loc);
                    }
                    infowindow = new google.maps.InfoWindow({
                        content: 'Latitude: ' + loc.lat() + '<br>Longitude: ' + loc.lng()
                    });
                    if (!!infowindow && !!infowindow.close) {
                        infowindow.close();
                    }
                    infowindow.open(map, marker);
                }
            }

            window.initMap = initMap;
            

        </script>

    </div>


@endsection