@extends('admin.auth.layout')
@section('auth')
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <!--flash message-->
                        <div id = "alertMessage">
                            @include('flash::message')
                        </div> 
                        <p class="">{{trans('messages.reset_your_password')}}</p>

                        <form action="{!! route('admin.password.email') !!}" method="post" class="text-left">
                            {!! csrf_field() !!}
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">{{trans('messages.email')}}</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="email" type="text" class="form-control" placeholder="{{trans('messages.email')}}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">  <strong style="color: red;">{{ $errors->first('email') }}</strong>  </span>
                                    @endif
                                </div>

                               
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">{{ trans('messages.Send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection

    
    