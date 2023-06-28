@extends('layouts.front')
@section('content')

   <section class="privacy">
        <div class="container">
            <div class="row">

                <div class="col-12 pt-lg-5">
                    <div class="section-head  head-shape my-5">
                        <h2>{{$page->{"title_".app()->getLocale()} }}</h2>
                    </div>
                    <div class="term">
                        <p>{{$page->{"content_".app()->getLocale()} }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-front.clients/>

@endsection
