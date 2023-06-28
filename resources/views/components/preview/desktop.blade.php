<div>
    @if($record->media_type=='slider')
        {{-- <div id="carouselExampleIndicators" class="carousel ad slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($record->media as $single_media)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index==0? 'active' : ''}}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" style='height:100%'>
                @foreach($record->media as $single_media)
                    <div class="carousel-item {{$loop->index==0? 'active' : ''}}">
                        <img class="d-block w-100" src="{{url('uploads/pics/'.$single_media)}}">
                    </div>
                @endforeach
            </div>
        </div> --}}

        <div class="my-slider ad">
            @foreach($record->media as $single_media)
                <img class="" src="{{url('uploads/pics/'.$single_media)}}" style="height: 350px;object-fit:contain">
            @endforeach
        </div>
    @elseif ($record->media_type=='video')
        <video autoplay loop controls class="ad">
            <source src="{{url('uploads/pics/'.$record->media[0])}}" type="video/mp4" />
        </video>
    @else
        <img class="ad" src="{{$record->media_preview_url}}" alt="">
    @endif
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
        /* .slick-prev, .slick-next{
            top:35% !important;
        } */
        .slick-list{
            height:100% !important;
        }
    </style>
@endpush
@push('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.my-slider').slick({
            {{ app()->getLocale()=='ar'? 'rtl:true,' : '' }}
            dots: true,
            infinite: true,
            autoplay:true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            });
    </script>
@endpush
