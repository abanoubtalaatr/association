@extends('admin.layouts.master')

@section('navTitle')
   {{trans('messages.settings')}} / {{trans('messages.contact_settings')}}
@endsection

@section('content')
<br/>
<!--flash message-->
<div id = "alertMessage">
    @include('flash::message')
</div>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('messages.edit')}}  {{trans('messages.contact_settings')}}         </h5>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
         </div>
      {!! Form::model($setting,['route' => ['settings.contact.update',$setting->id] , 'method' => 'POST' , 'files' => true ,'class' => 'needs-validation']) !!}
         <div class="row">
            <div class="form-group col">
                <label for="validationCustom02">@lang('messages.email')</label>

            <input
                oninvalid="this.setCustomValidity('@lang('site.must_be_a_valid_email_address')')"
                oninput="this.setCustomValidity('')"
                type="email"
                name='email'
                placeholder="@lang('messages.email')"
                class='form-control' value='{{$setting->email}}'/>

                @if ($errors->has('email'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('email') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                    <label for="validationCustom02">{{ trans('messages.phone_number') }} </label>
                {!! Form::number('mobile_number', null, ['class' => 'form-control' , 'placeholder' => trans('messages.phone_number')]) !!}
                @if ($errors->has('mobile_number'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('mobile_number') }}</strong>  </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.fax') }} </label>
                {!! Form::number('fax', null, ['class' => 'form-control' , 'placeholder' => trans('messages.fax')]) !!}
                @if ($errors->has('fax'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('fax') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.website') }} </label>
                {!! Form::text('website', null, ['class' => 'form-control' , 'placeholder' => trans('messages.website')]) !!}
                @if ($errors->has('website'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('website') }}</strong>  </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.facebook') }} </label>
                {!! Form::text('facebook', null, ['class' => 'form-control' , 'placeholder' => trans('messages.facebook')]) !!}
                @if ($errors->has('facebook'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('facebook') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.linkedin') }} </label>
                {!! Form::text('linkedin', null, ['class' => 'form-control' , 'placeholder' => trans('messages.linkedin')]) !!}
                @if ($errors->has('linkedin'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('linkedin') }}</strong>  </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.twitter') }} </label>
                {!! Form::text('twitter', null, ['class' => 'form-control' , 'placeholder' => trans('messages.twitter')]) !!}
                @if ($errors->has('twitter'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('twitter') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.instgram') }} </label>
                {!! Form::text('instgram', null, ['class' => 'form-control' , 'placeholder' => trans('messages.instgram')]) !!}
                @if ($errors->has('instgram'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('instgram') }}</strong>  </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="validationCustom02">@lang('site.whatsapp')</label>
                {!! Form::text('whatsapp', null, ['class' => 'form-control' , 'placeholder' => trans('site.whatsapp')]) !!}
                @if ($errors->has('whatsapp'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('whatsapp') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                <label for="validationCustom02">{{ trans('messages.youtube') }} </label>
                {!! Form::text('youtube', null, ['class' => 'form-control' , 'placeholder' => trans('messages.youtube')]) !!}
                @if ($errors->has('youtube'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('youtube') }}</strong>  </span>
                @endif
            </div>
        </div>
            <div class="text-right">
                <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
            </div>
      {!! Form::close() !!}
    </div>

</div>
@endsection
