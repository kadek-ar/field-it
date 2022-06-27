@extends('layout.main')

@section('header_Page', 'Maps')

@section('content')

<style>
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>

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
            console.log({latitude, longitude})
            initMap()
        })

    }

    var loc = <?php echo $field; ?>;

    function initMap() {
        // The location of Uluru
        const uluru = { lat: latitude, lng: longitude };
        // The map, centered at Uluru
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: uluru,
            gestureHandling: "cooperative",
        });

        console.log("loc ", loc);

        var marker, i, latLng;

        for( i = 0; i < loc.length; i++){
            // latLng = { lat: loc.lat, lng: loc.lng };
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(loc[i].lat, loc[i].lng),
                map: map,
                icon: '/img/field_marker.png'
            });
        }
    }

    window.initMap = initMap;

</script>




    <div class="container mt-1">
        <div class="shadow-lg p-4 rounded bg-white">
            <h1 class="mb-3 text-center fw-bold">MAPS</h1>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" placeholder="Search Location" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-success fw-bold fs-5 ps-4 pe-4" onclick="searchLocation()" type="button" id="button-addon2">Search</button>
            </div>
        
            <div id="map"></div>
        </div>

    </div>


@endsection