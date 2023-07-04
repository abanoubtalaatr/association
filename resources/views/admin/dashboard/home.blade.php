@extends('layouts.admin')
@section('content')
<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--wallet-->
    <div class="border-div">
        <h2>@lang('site.dashboard')</h2>
        <div class="row">
            <div class="col-4 text-center">
                <div class="dash box-shad" onclick='window.location.href="{{route('admin.courses.index')}}"'>
                    <h4>{{$coursesNumber}}</h4>
                    <p class="grey">@lang('site.courses')</p>
                </div>
            </div>

            <div class="col-4 text-center">
                <div class="dash box-shad pe-auto " onclick='window.location.href="{{route('admin.ads')}}?status=active"'>
                    <h4>{{$active_count}}</h4>
                    <p class="grey">@lang('site.active_ads')</p>
                </div>
            </div>

            <div class="col-4 text-center">
                <div class="dash box-shad" onclick='window.location.href="{{route('admin.ads')}}?status=unpaid"'>
                    <h4>{{$unpaid_count}}</h4>
                    <p class="grey">@lang('site.unpaid_ads')</p>
                </div>
            </div>


        </div>


    </div>
</main>
@endsection
