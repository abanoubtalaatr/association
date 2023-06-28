<html>
<head>
    <title>{{$ad->title}}</title>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WNH38W9');</script>
    <!-- End Google Tag Manager -->
    <script src="https://onelinksmartscript.appsflyer.com/onelink-smart-script-latest.js"></script>
<script>
    var result_url = AF_SMART_SCRIPT_RESULT.clickURL;
    console.log(result_url);
    if (result_url) {
        document.getElementById('andrd_link').setAttribute('href', result_url);
        document.getElementById('ios_link').setAttribute('href', result_url);
        // Optionally - Create QR code from the generated OneLink URL
        window.AF_SMART_SCRIPT.displayQrCode("my_qr_code_div_id");
        //The size of the QR code is defined in the CSS file under #my_qr_code_div_id
        // #my_qr_code_div_id canvas {
        //  height: 200px;
        //  width: 200px;
        //}
        // Optionally - fire an impression.
        // The impression will fire to https://impressions.onelink.me//....
        window.AF_SMART_SCRIPT.fireImpressionsLink();
    }
</script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186147787-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag("js", new Date());

        gtag("config", "UA-186147787-1");
    </script>

    <meta property="og:title" content="{{$ad->title}}"/>
    <meta property="og:url" content="{{URL::current()}}"/>
    <meta property="og:description" content="{{$ad->short_description}}">
    <meta property="og:image" content="{{$ad->whatsapp_thumbnail_url}}">
    <meta property="og:type" content="article"/>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

</head>
<body style='background-color:black'>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WNH38W9"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<style>
    .big-slider * {
        height: 100vh;
    }

    .big-slider .carousel-item {
        height: 100vh;
    }

    .big-slider .carousel-item img {
        object-fit: contain;
        height: 100%;
    }

    .btn-big {
        position: absolute;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        text-align: center;
        width: 150px;
        height: 75px;
        font-size: 25px;
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
        bottom: 50px;

    }
</style>
<!-- start slider -->
<section class="big-slider" style='height:100vh'>
    @if($ad->media_type!='video')
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for ($i=0;$i<count($ad->media);$i++)
                    <button
                        type="button"
                        data-bs-target="#carouselExampleIndicators"
                        data-bs-slide-to="{{$i}}"
                        class="@if($i==0) active @endif"
                        aria-current="true"
                        aria-label="Slide 1">
                    </button>
                @endfor


                <button onClick="increaseClicks('{{ $ad->link }}', '{{ $ad->id }}')"
                        class="btn btn-big">{{$ad->button_text}}</button>
            </div>
            <div class="carousel-inner">

                @foreach ($ad->media as $single_media)
                    <div class="carousel-item  @if($loop->first) active @endif">
                        <img src="{{url('uploads/pics/'.$single_media)}}" class="d-block w-100 " alt="...">
                    </div>
                @endforeach

            </div>

            @if($ad->media_type=='slider')
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    @else
        <iframe src="{{url('uploads/pics/'.$ad->media[0])}}" type="video/mp4" allow="autoplay" id="video"
                style="display:none"></iframe>


        <video autoplay controls loop class="d-block w-100 ">
            <source src="{{url('uploads/pics/'.$ad->media[0])}}" type="video/mp4"/>
        </video>
        <button onClick="increaseClicks('{{ $ad->link }}', '{{ $ad->id }}')"
                class="btn btn-big increaseClicks">{{$ad->button_text}}</button>
    @endif

</section>


<script>

    // this function increase by one and redirect to another
    function increaseClicks(link, id) {
        console.log(link)
        $.ajax({
            type: "POST",
            url: `/ad/${id}/increase-clicks`,
            data: {_token: '{{csrf_token()}}'},
            success: function (data) {
                window.location.assign(link)
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
    }
</script>
<!-- start scripts included -->
<!-- bootstrap included -->
<script src={{asset('js/bootstrap.bundle.js')}}></script>
<!-- jquery included -->
<script src="{{asset('js/jquery.js')}}"></script>
</body>
</html>





