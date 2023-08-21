@extends('layouts.user')
@section('content')
<main class="main-content">
    <!--head-->
    <x-user.head/>
    <!--profile-->
    <div class="border-div">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{route('user.save_profile')}}" method='POST' enctype="multipart/form-data">
                @csrf
                <div class="profile-head">
{{--                    <label for="avatar-upload">--}}
{{--                        <img src="{{auth('users')->user()->avatar_url}}" />--}}
{{--                    </label>--}}
                    <input name='avatar' id='avatar-upload' type="file" style='display:none'/>

{{--                    <h5>{{auth('users')->user()->name}}</h5>--}}
{{--                    <p>{{auth('users')->user()->email}}</p>--}}
                </div>
                <div class="profile-det">
{{--                    @if (session('success_message'))--}}
{{--                        <div class="alert alert-success">--}}
{{--                            {{session('success_message')}}--}}
{{--                        </div>--}}
{{--                    @endif--}}

                        <div class="row">
                            <div class="col-md-6">
                                <lable>@lang('site.first_name')</lable>
                                <input readonly value='{{auth('users')->user()->first_name}}'  name='first_name' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.first_name')">
                                @error('first_name') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <lable>@lang('site.last_name')</lable>
                                <input readonly value='{{auth('users')->user()->last_name}}' name='last_name' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.last_name')"/>
                                @error('last_name') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <lable>@lang('site.fourth_name_in_arabic')</lable>
                                <input readonly value='{{auth('users')->user()->fourth_name_in_arabic}}' name='fourth_name_in_arabic' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.fourth_name_in_arabic')"/>
                                @error('fourth_name_in_arabic') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <lable>@lang('site.title_job')</lable>
                                <input readonly value='{{auth('users')->user()->title}}' name='title' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.title')"/>
                                @error('title') <p class="text-danger">{{$message}}</p>@enderror
                            </div>

                            <div class="col-md-6">
                                <lable>@lang('site.passport')</lable>

                                <input readonly value='{{auth('users')->user()->passport}}' name='passport' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.passport')"/>
                                @error('passport') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <lable>@lang('site.hospital')</lable>

                                <input readonly value='{{auth('users')->user()->hospital}}' name='hospital' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.hospital')"/>
                                @error('hospital') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <lable>@lang('site.speciality')</lable>

                                <input readonly value='{{auth('users')->user()->specialty}}' name='specialty' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.specialty')"/>
                                @error('specialty') <p class="text-danger">{{$message}}</p>@enderror
                            </div>

                            <div class="col-md-6">
                                <lable>@lang('site.email')</lable>
                                <input value='{{auth('users')->user()->email}}' name='email' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.title')">
                                @error('email') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <lable>@lang('site.mobile')</lable>

                                <input value='{{auth('users')->user()->mobile}}' name='mobile' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.mobile')">
                                @error('mobile') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type='submit' class="button btn-red big">@lang('site.edit_profile')</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</main>


@endsection
