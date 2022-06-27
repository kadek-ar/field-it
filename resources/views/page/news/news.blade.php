@extends('layout.main')

@section('header_Page', 'About Us')

@section('content')

<hr class="line-black">
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
                    <div class="swiper-slide" onclick="gotoNews('{{$item->id}}')">
                        {{-- <img class="img-fluid w-100" src="{{ asset('storage/img/'.$item->image) }}" alt=""> --}}
                        {{-- <img class="img-fluid w-100" src="/uploads/img/{{$item->image}}" alt=""> --}}
                        <img class="img-fluid w-100" src="{{Storage::disk('s3')->temporaryUrl($item->image, now()->addMinutes(60))}}" alt="">
                        <div class="text-center mt-2">{{ $item->title }}</div>
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

<script>

    function gotoNews(id){
        window.location = '/news?id='+id
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