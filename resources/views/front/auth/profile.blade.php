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
                    <label for="avatar-upload">
                        <img src="{{auth('users')->user()->avatar_url}}" />
                    </label>
                    <input name='avatar' id='avatar-upload' type="file" style='display:none'/>

                    <h5>{{auth('users')->user()->name}}</h5>
                    <p>{{auth('users')->user()->email}}</p>
                </div>
                <div class="profile-det">
                    @if (session('success_message'))
                        <div class="alert alert-success">
                            {{session('success_message')}}
                        </div>
                    @endif

                        <div class="row">
                            <div class="col-md-6">
                                <input value='{{auth('users')->user()->username}}'  name='username' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.username')">
                                @error('username') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <input value='{{auth('users')->user()->address}}' name='address' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.address')"/>
                                @error('address') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <input value='{{auth('users')->user()->email}}' name='email' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.email')">
                                @error('email') <p class="text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="col-md-6">
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
