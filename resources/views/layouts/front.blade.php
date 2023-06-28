<!DOCTYPE html>
<html lang="en">
<!-- Start head -->
<head>
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
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <title>@lang('site.site_title') @isset($page_title) {{$page_title}} @endisset</title>
    <!-- bootstrap included -->
    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/bootstrap.min.css"/>
    <!-- font Awesome  library-->
    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/all.min.css"/>
    <!-- slick slider -->
    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/slick-theme.css"/>
    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/slick.css"/>

    <!-- start css file -->
    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/style.css"/>
    <!-- start responsive -->
    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/responsive.css"/>
    @livewireStyles()


    <script type='text/javascript'>
        window.smartlook || (function (d) {
            var o = smartlook = function () {
                o.api.push(arguments)
            }, h = d.getElementsByTagName('head')[0];
            var c = d.createElement('script');
            o.api = new Array();
            c.async = true;
            c.type = 'text/javascript';
            c.charset = 'utf-8';
            c.src = 'https://web-sdk.smartlook.com/recorder.js';
            h.appendChild(c);
        })(document);
        smartlook('init', '6233cb0feca1156d82e8449c6a48a537eb7bbef2', {region: 'eu'});
    </script>
</head>
<!-- start body -->
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WNH38W9"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- start navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('homepage')}}">
            <img src="{{asset('assets_'.app()->getLocale())}}/images/logo.png" alt="">
        </a>

        <ul class="navbar-nav d-flex d-lg-none flex-dir">

            <li class="nav-item">
                <a class="nav-link btn login-btn" href="{{route('user.login_form')}}">@lang('general.login') <i
                        class="fa-solid fa-user"></i></a>
            </li>
            <li class="nav-item dropdown lang">
                <a class="nav-link dropdown-toggle"
                   href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale()) }}" id="navbarDropdown"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{app()->getLocale() == 'en'? 'English' : 'العربية'}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item"
                           href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale()=='ar'? 'en' : 'ar') }}">
                            {{app()->getLocale() == 'ar'? 'English' : 'العربية'}}
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <x-front.navbar-items/>
            <ul class="navbar-nav d-none d-lg-flex">

                <li class="nav-item">
                    <a class="nav-link btn login-btn" href="{{route('user.login_form')}}">@lang('general.login') <i
                            class="fa-solid fa-user"></i></a>
                </li>
                <li class="nav-item dropdown lang">
                    <a class="nav-link dropdown-toggle"
                       href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale()) }}" id="navbarDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{app()->getLocale() == 'en'? 'English' : 'العربية'}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item"
                               href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale()=='ar'? 'en' : 'ar') }}">
                                {{app()->getLocale() == 'ar'? 'English' : 'العربية'}}
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- side menu -->
<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasExample"
     aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <a href="{{route('homepage')}}" class="offcanvas-title" id="offcanvasExampleLabel"><img
                src="{{asset('assets_'.app()->getLocale())}}/images/logo.png" alt=""></a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body navbar-expand-lg navbar-dark">
        <x-front.navbar-items/>
    </div>
</div>

@yield('content')

<!-- start footer -->
<x-front.footer/>
<div class="copyright">
    <div class="container">
        <div class="col-lg-9">
            <div class="d-flex justify-content-between">
                <ul class="d-flex">
                    {{-- <li><a href="{{route('privacy_policy')}}" class="indicator">@lang('site.privacy_policy')</a></li>
                    <li><a href="{{route('terms_of_service')}}">@lang('site.terms_of_service')</a></li> --}}
                </ul>
                <p>@lang('site.copyright') © @lang('site.adsoldiers') {{date('Y')}}
                    . @lang('site.all_rights_reserved')</p>
            </div>
        </div>
    </div>
</div>

<!-- start scripts included -->
<!-- bootstrap included -->
<script src="{{asset('assets_'.app()->getLocale())}}/js/bootstrap.bundle.js"></script>
<!-- jquery included -->
<script src="{{asset('assets_'.app()->getLocale())}}/js/jquery.js"></script>
<!-- slick slider -->
<script src="{{asset('assets_'.app()->getLocale())}}/js/slick.min.js"></script>
<!-- font awsome included -->
<script src="{{asset('assets_'.app()->getLocale())}}/js/all.min.js"></script>
<!-- MY code included -->
<script src="{{asset('assets_'.app()->getLocale())}}/js/code.js"></script>
<script>
    $('.responsive').slick({
        dots: true,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 5,
        rtl: true,
        slidesToScroll: 5,
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
@livewireScripts()
</body>

<!-- end of body -->
</html>
<!-- end of code -->
