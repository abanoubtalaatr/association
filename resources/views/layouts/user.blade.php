<!DOCTYPE html>
<html class="no-js">

<head>
    <title>@lang('site.site_title') @isset($page_title) {{$page_title}} @endisset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="description">
    <meta name="Sard" content="sard">
    <meta name="robots" content="index">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <!--in case of ar only-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/css/style.css">
    <link rel="stylesheet"
          href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/css/{{app()->getLocale()}}Style.css">
    <link rel="stylesheet" href="{{asset('frontAssets/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
          integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script
        src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-clipboard@0.1.x/dist/alpine-clipboard.umd.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">




    @livewireStyles()
    @stack('styles')
</head>

<body class="home-page" x-data x-on:saved="toastr.success($event.detail.message);">
<div id="wrapper">
    <!--Sidebar-->
    <div id="sidebar-wrapper">
        <div class="sidebar-nav">
            <div class="logo-wrap">
                <img
                                        alt="">
            </div>
            <li><a href="{{route('user.dashboard')}}"><img
                        src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"
                        alt="">@lang('site.dashboard') </a></li>
{{--            @if(auth()->user()->user_type=='advertiser')--}}
{{--                <li><a href="{{route('user.ads')}}"><img--}}
{{--                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"--}}
{{--                            alt="">@lang('site.ads') </a></li>--}}
{{--                <li><a href="{{route('user.camps')}}"><img--}}
{{--                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"--}}
{{--                            alt="">@lang('site.camps')</a></li>--}}
{{--                <li><a href="{{route('user.billing')}}"><img--}}
{{--                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"--}}
{{--                            alt="">@lang('site.billing')</a></li>--}}
{{--            @endif--}}



{{--            @if(auth()->user()->user_type=='soldier')--}}
{{--                <li><a href="{{route('user.ads')}}"><img--}}
{{--                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"--}}
{{--                            alt="">@lang('site.ads') </a></li>--}}
{{--                <li><a href="{{route('user.tasks')}}"><img--}}
{{--                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg"--}}
{{--                            alt="">@lang('site.tasks') </a></li>--}}
{{--                <li><a href="{{route('user.category')}}"><img--}}
{{--                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/library.svg"--}}
{{--                            alt="">@lang('site.library')</a></li>--}}

                <li><a href="{{route('user.courses')}}"><img
                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg"
                            alt="">@lang('site.courses')</a></li>
{{--            @endif--}}

            <li><a href="{{route('user.edit_profile')}}"><img
                        src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/profile.svg"
                        alt="">@lang('site.profile') </a></li>
            <li><a href="{{route('user.logout')}}"><img
                        src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/logout.svg"
                        alt="">@lang('messages.logout') </a></li>
        </div>
    </div>
    <div id="page-content-wrapper">
        <!-- Main Content-->
    @yield('content')
    @isset($slot) {{$slot}} @endisset
    <!-- End Main Content-->
        <!-- Main footer-->
        <footer class="main-footer">
            <p>@lang('site.site_title')</p>
        </footer>
        <!-- End Main footer-->
    </div>
</div>
<!-- End Main Content-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initMap"></script>
<script src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/js/functions.js"></script>
<script src="{{asset('frontAssets/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(session('success_message'))
    <script>
        toastr.success('{{session('success_message')}}');
    </script>
@endif
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
        height: 260px;
        position: relative;
        text-align: center;
    }

    .select2-container--default {
        width: 100% !important;
    }

</style>
@stack('scripts')
@livewireScripts()


</body>

</html>
