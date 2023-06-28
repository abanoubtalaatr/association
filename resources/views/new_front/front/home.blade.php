@extends('layouts.front')
@section('content')


        <!-- strat hero section -->
        <section class="hero">
            <div class="container">
                <x-front.slider/>

            </div>
        </section>
        <!-- start about section -->
        <section class="about">
            <div class="container">
                <div class="row flex-sm-row-reverse-x">
                    <div class="col-lg-6 mt-lg-5 mb-3">
                        <div class="section-head   head-shape-x mt-5 mb-0">
                            <h2>@lang('site.about_us')</h2>
                        </div>
                        <ul class="about-box">{!! \App\Models\Page::find(3)->{"content_".app()->getLocale()} !!}</ul>
                        <a href="{{route('show_page',3)}}" class="btn btn-1 px-lg-5">@lang('site.more')</a>

                      </div>
                      <div class="col-lg-6 mt-lg-5">
                        <div class="term-box term-box-3 mt-lg-5">
                          <img src="{{asset('assets_'.app()->getLocale())}}/images/about.png" alt="">

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-front.how-does-it-work :pages="$how_does_it_work"/>

        <x-front.benefits :pages="$benefits"/>

       <x-front.join/>

       <x-front.services :pages="$services"/>

        <x-front.download/>

        <x-front.clients/>
@endsection
