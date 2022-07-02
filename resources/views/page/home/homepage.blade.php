@extends('layout.main')

@section('header_Page', 'Home')

@section('content')

<style>
    #map {
        height: 600px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
    .book-now:hover{
        text-decoration: underline;
        color: #F1D00A !important;
        transition-duration: 0.3s;
        cursor: pointer;
    }
</style>

<div class=" text-center mContent" style="margin-top: -17px;">
    <div class="">
        <div class="book">
            <div class="bg-img-home" style="height: 400px;">
                <div style="padding-top: 70px;">
                    <div class="text-center fs-1 fw-bold fst-italic yellow-text mb-5 m-auto" style="max-width: 492px;">
                        EASIER WAY TO RESERVE A FOOTBALL VENUE
                    </div>
                    <div onclick="window.location='/field/list'" class="book-now text-center fs-1 fw-bold fst-italic text-white" style="background: rgba(0, 0, 0, 0.5);">
                        BOOK NOW
                    </div>
                </div>
            </div>  
        </div>
        <section class="">
            <div class=" shadow-lg rounded bg-main-grey">
                <div class="text-center">
    
    
                    <div class="mb-5">
                        <div class="topic bg-main-green text-white">
                            <div class="text-center fs-2 fw-bold fst-italic pb-1"> NEWS</div>
                        </div>
                        <hr class="ps-4 pe-4">
                        <div class="ps-4 pe-4 container">
                            @isset($news)
                                <!-- Slider main container -->
                                <div class="swiper mySwiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        @foreach ($news as $item)
                                            <div class="swiper-slide" onclick="gotoNews('{{$item->id}}')">
                                                {{-- <img class="img-fluid w-100" src="{{ asset('storage/img/'.$item->image) }}" alt=""> --}}
                                                {{-- <img class="img-fluid w-100" src="/uploads/img/{{$item->image}}" alt=""> --}}
                                                <img class="img-fluid w-100" src="{{Storage::disk('s3')->temporaryUrl($item->image, now()->addMinutes(60))}}" alt="">
                                                <div class="text-center mt-2 fw-bold" style="font-size: 16px">{{ $item->title }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                
                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                
                                    <!-- If we need scrollbar -->
                                    <div class="swiper-scrollbar"></div> --}}
                                </div>
                            @else
                                <div class="text-center fs-2 ">
                                    News not Avaiable
                                </div>
                            @endisset
                        </div>
                    </div>
                        
                    <div class="">
                        <div class="topic bg-main-green text-white">
                            <div class="text-center fs-2 fw-bold fst-italic pb-2">MAPS</div>
                        </div>
                        <div class="container" id="map"></div>
                    </div>

                    <div class="pb-5">
                        <div class="topic bg-main-green text-white">
                            <div class="text-center fs-2 fw-bold fst-italic pb-1">ABOUT US</div>
                        </div>
                        <div class="container mt-5">
                            <div class="mb-5">
                                <img class="w-25" src="/img/logops.webp" alt="">
                            </div>
                            <p class="text-center ps-4 pe-4 pb-4 fs-5 m-auto max-w-799">
                                Field-IT is a technology platform for online sports field rental services. Providing solutions to the problem of conventional field rental, Field-IT provides many field choices, flexibility in choosing a sports field rental schedule, and easy online payments.
                            </p>
                            <b>&copy; Field-IT</b>
                        </div>
                    </div>
                    
                    
                    <div class="topic bg-main-green text-white" style="height: 35px"></div>
            </div>


        </div>
        </section>
</div>

<script>

    function gotoNews(id){
        // window.location = '/news?id='+id
        window.location = '/newsHome?id='+id
    }

    function gotoField(loc){
        window.location = '/fieldsTo/' + loc.id;
    }

    var latitude = -6.200000;
    var longitude = 106.816666;

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

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
        var activeInfoWindow ;	

        // create an InfoWindow - for mouseover
        var infoWnd = new google.maps.InfoWindow();
    
        // create an InfoWindow -  for mouseclick
        var infoWnd2 = new google.maps.InfoWindow();

        for( i = 0; i < loc.length; i++){
            // latLng = { lat: loc.lat, lng: loc.lng };
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(loc[i].lat, loc[i].lng),
                map: map,
                icon: '/img/field_marker.png'
            });

            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                return function() {
                    infoWnd.setContent(loc[i].name);
                    infoWnd.open(map, marker);
                }
            })(marker, i));							
			
			// on mouseout (moved mouse off marker) make infoWindow disappear
			google.maps.event.addListener(marker, 'mouseout', function() {
				infoWnd.close();	
			});

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    // infoWnd.setContent(loc[i].name);
                    // infoWnd.open(map, marker);
                    gotoField(loc[i]);
                }
            })(marker, i));	
        }
    }

    window.initMap = initMap;

</script>
    

@endsection
