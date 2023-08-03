<!DOCTYPE html>
<html class="no-js">

<head>
    <title>@lang('site.site_title') @isset($page_title) {{ ' - '.$page_title}}  @endisset</title>
    <!-- Google Tag Manager -->

    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="description">
    <meta name="Sard" content="sard">
    <meta name="robots" content="index">
    <link rel="icon" href="{{asset('favicon.ico')}}">    <!--in case of ar only-->
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"--}}
    {{--          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/css/style.css">
    <link rel="stylesheet"
          href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/css/{{app()->getLocale()}}Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
          integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles()
    @stack('styles')
</head>

<body class="home-page" x-data x-on:saved="toastr.success($event.detail.message);">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WNH38W9"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<div id="wrapper">
    <!--Sidebar-->
    <div id="sidebar-wrapper">
        <div class="sidebar-nav">
            <div class="logo-wrap"><img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/logo.jpg"
                                        alt=""></div>

            <li>
                <a href="{{route('admin.dashboard')}}">
                    <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"
                         alt="">
                    @lang('site.dashboard')
                </a>
            </li>


            @can('Manage admins')
                <li>
                    <a href="{{route('admin.admins.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.admins')
                    </a>
                </li>
            @endcan
            @can('Manage roles')
                <li>
                    <a href="{{route('admin.role')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.roles')
                    </a>
                </li>
            @endcan
            @can('Manage users')
                <li>
                    <a href="{{route('admin.users.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.students')
                    </a>
                </li>
            @endcan
            @can('Manage users')
                <li>
                    <a href="{{route('admin.courses.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.courses')
                    </a>
                </li>
            @endcan
            @can('Manage certifications')
                <li>
                    <a href="{{route('admin.certifications.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.certifications')
                    </a>
                </li>
            @endcan

            {{--            @can('Manage settings')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.settings')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">--}}
            {{--                        @lang('messages.settings')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}
            <li><a href="{{route('admin.logout')}}"><img
                        src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/logout.svg"
                        alt="">@lang('messages.logout')</a></li>
        </div>
    </div>
    <div id="page-content-wrapper">
        <!-- Main Content-->
    {{ isset($slot)? $slot : ''}}
    @yield('content')
    <!-- End Main Content-->
        <!-- Main footer-->
        <footer class="main-footer">
            <p> الجمعية الليبية لطب الطوارئ</p>
        </footer>
        <!-- End Main footer-->
    </div>
</div>
<!-- End Main Content-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initMap"></script>
<script src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/js/functions.js"></script>
<script src="{{asset('frontAssets/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .slick-list {
        height: 100% !important;
    }

    .slick-slide img {
        position: absolute;
        top: -20%;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        max-height: 80%;
        max-width: 100%;
        object-fit: contain;
    }

    .slick-slide {
        height: 230px;
        position: relative;
        text-align: center;
    }

    .select2-container--default {
        width: 100% !important;
    }
</style>
@if(session('success_message'))
    <script>
        toastr.success('{{session('success_message')}}');


    </script>
@endif

@livewireScripts()
@stack('scripts')
</body>

</html>
