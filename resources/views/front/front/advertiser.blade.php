@extends('layouts.front')
@section('content')

    <section class="privacy">
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



            <x-front.clients/>

        </div><!-- End container-->
    </section>

@endsection
