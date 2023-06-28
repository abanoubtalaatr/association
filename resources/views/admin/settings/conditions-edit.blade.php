@extends('admin.layouts.master')

@section('navTitle')
   {{trans('messages.settings')}} / @lang('site.acceptance_settings')
@endsection

@section('content')
<br/>
<!--flash message-->
<div id = "alertMessage">
    @include('flash::message')
</div>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('messages.edit')}}  {{trans('site.acceptance_settings')}}        </h5>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
         </div>
      {!! Form::model($setting,['route' => ['settings.eligibility-conditions.update',$setting->id] , 'method' => 'POST' , 'files' => true ,'class' => 'needs-validation']) !!}
         <div class="row">
            <div class="form-group col">
                <label for="validationCustom01">{{trans('messages.min_age')}} </label>
                <input
                    oninvalid="this.setCustomValidity('@lang('site.must_be_positive_integer')')"
                    oninput="this.setCustomValidity('')"
                    step='1'
                    min='0'
                    type="number"
                    name='min_age'
                    placeholder="@lang('messages.min_age')"
                    class='form-control' value='{{$setting->min_age}}'/>
                @if ($errors->has('min_age'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('min_age') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                <label for="validationCustom01">{{trans('messages.max_age')}} </label>

                <input
                    oninvalid="this.setCustomValidity('@lang('site.must_be_positive_integer')')"
                    oninput="this.setCustomValidity('')"
                    step='1'
                    min='0'
                    type="number"
                    name='max_age'
                    placeholder="@lang('messages.max_age')"
                    class='form-control' value='{{$setting->max_age}}'/>

                @if ($errors->has('max_age'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('max_age') }}</strong>  </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="validationCustom01">@lang('messages.min_monthly_salary') ( {{ trans('messages.SR') }} )</label>
                <input
                    oninvalid="this.setCustomValidity('@lang('site.must_be_positive_integer')')"
                    oninput="this.setCustomValidity('')"
                    step='1'
                    min='0'
                    max='100000'
                    type="number"
                    name='min_monthly_salary'
                    placeholder="@lang('messages.min_monthly_salary')"
                    class='form-control' value='{{$setting->min_monthly_salary}}'/>
                @if ($errors->has('min_monthly_salary'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('min_monthly_salary') }}</strong>  </span>
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
