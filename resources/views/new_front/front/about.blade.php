@extends('layouts.front')
@section('content')


    <section class="privacy pt-lg-5">
        <div class="container">
            <div class="row mt-lg-5">

                <div class="col-12">
                <div class="section-head  head-shape mt-5 mb-0">
                    <h2>{{$page->{"title_".app()->getLocale()} }}</h2>
                </div>
                </div>
                <div class="col-lg-6 mt-lg-5">
                <div class="term">
                    <p>{!! $page->{"content_".app()->getLocale()} !!}</p>
                </div>
                </div>

                <div class="col-lg-5 offset-lg-1">
                    <div class="term-box">
                    <img src="{{$page->picture_url}}" alt="">
                    </div>
                </div>
            </div>



            <div class="row mt-lg-5 mt-3">
                <div class="col-md-6">
                    <div class="ab-box border rounded text-center p-lg-5 p-2 mb-3">
                    <img src="{{asset('assets_ar/images/V1.png')}}" alt="">

                    <div class="">
                        <h3 class="ab-red">@lang('site.vision')</h3>
                        <p>{{$vision}}</p>
                    </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="ab-box border rounded text-center p-lg-5 p-2 mb-3">
                        <img src="{{asset('assets_ar/images/V2.png')}}" alt="">

                        <div class="">
                            <h3 class="ab-black">@lang('site.mission')</h3>
                            <p>{{$mission}}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- End container-->
    </section>

    <x-front.clients/>

@endsection
