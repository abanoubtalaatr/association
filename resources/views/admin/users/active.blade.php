@extends('admin.layouts.master')
@include('admin.users.style')

@section('navTitle')
{{trans('messages.users')}} / {{trans('messages.activation')}} {{trans('messages.user')}}
@endsection


@section('content')
<br/>
<!--flash message-->
<div id = "alertMessage">
    @include('flash::message')
</div>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('messages.activation')}}  {{trans('messages.user')}}        </h5>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
        </div>
      {!! Form::model($user,['route' => ['users.activate',$user->id] , 'method' => 'POST' , 'files' => true ,'class' => 'needs-validation']) !!}
												@if(request('redirect_to_loans'))
														<input type="hidden" name="not_paid" value="1">
												@endif
            <div class="n-chk">
                <label class="new-control new-radio new-radio-text radio-primary">
                    {!! Form::radio('is_active', '1',[ 'class'=>"new-control-input", 'name'=>"custom-radio-4"]) !!}
                  <span class="new-control-indicator"></span><span class="new-radio-content">{{ trans('messages.activation') }}</span>
                </label>
                <label class="new-control new-radio new-radio-text radio-primary">
                    {!! Form::radio('is_active', '0',[ 'class'=>"new-control-input", 'name'=>"custom-radio-4"]) !!}
                    <span class="new-control-indicator"></span><span class="new-radio-content">{{ trans('messages.unactivation') }}</span>
                </label>
            </div>



            <div class="form-group mb-4">
                <label for="exampleFormControlTextarea1">{{trans('messages.active_reason')}} </label>
                <textarea name="active_reason" class='form-control' placeholder="@lang('messages.active_reason')"></textarea>
                @if ($errors->has('active_reason'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('active_reason') }}</strong>  </span>
                @endif
            </div>

            <div class="text-right">
                <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
            </div>
        {!! Form::close() !!}
    </div>

</div>
@endsection
@include('admin.users.script')
