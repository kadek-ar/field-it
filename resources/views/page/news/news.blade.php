@extends('layout.main')

@section('header_Page', 'About Us')

@section('content')

<div class="container mt-1">
    <div class="shadow-lg p-4 rounded bg-white">
        <div class="topic">
            <div class="text-center fs-1 fw-bold"> NEWS</div>
        </div>
        <hr>
        @isset($news)
            <!-- Slider main container -->
            <div class="swiper mySwiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($news as $item)
                        {{-- <div class="swiper-slide" onclick="gotoNews('{{$item->id}}')"> --}}
                        {{-- <div class="swiper-slide" onclick="openNews('{{$item->title}}', '{{Storage::disk('s3')->temporaryUrl($item->image, now()->addMinutes(60))}}', '{{$item->description}}' ) "> --}}
                        <div class="swiper-slide" onclick="openNews( '{{$item->id}}' ) ">
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
            <hr>
            @foreach ($news as $item)
                <div id="newsCard{{$item->id}}" class="shadow-lg p-4 rounded bg-white d-none">
                    {{-- <div class="topic mb-5">
                        
                    </div> --}}
                    <div class="m-auto" style="max-width: 550px;">
                        {{-- <img class="text-center w-100" src="/uploads/img/{{$news->image}}" alt=""> --}}
                        {{-- <img class="text-center w-100" src="{{Storage::disk('s3')->temporaryUrl($news->image, now()->addMinutes(60))}}" alt=""> --}}
                        <img class="text-center w-100" src="{{Storage::disk('s3')->temporaryUrl($item->image, now()->addMinutes(60))}}" id="img{{$item->id}}"  alt="">
                    </div>
                    <hr>
                    <div>
                        <h1 class="mb-3 fw-bold " id="title{{$item->id}}">{{$item->title}}</h1>
                        <p id="desc{{$item->id}}">{!! nl2br($item->description) !!}</p>
                    </div>
            
                </div>
            @endforeach
        @else
            <div class="text-center fs-2 ">
                News not Avaiable
            </div>
        @endisset
    </div>
</div>

<script>

    window.onload = function() {
        var url = new URL(window.location.href);
        var id = url.searchParams.get("id");
        if(id != null){
            openNews(id)
        }
    }

    function gotoNews(id){
        window.location = '/news?id='+id
    }

    var newsOpen = 0;
    var tempId = 0;
    function openNews(id){
    // function openNews(title, img, desc){
        // console.log("img ", img);
        // document.getElementById("title").innerHTML = title
        // document.getElementById("img").src = img
        // document.getElementById("desc").innerHTML = desc.split("\n").join("<br>")
        // console.log("desc ", desc);
        // if(tempId != id){
            // console.log("tempId ", tempId);
            // console.log("id ", id);
            document.getElementById("newsCard"+id).classList.remove("d-none");
            if(tempId != 0 && tempId != id){
                document.getElementById("newsCard"+tempId).classList.add("d-none");
            }
            tempId = id;
        // }else{
        //     document.getElementById("newsCard"+tempId).classList.add("d-none");
        // }
        
    }


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
</script>

@endsection