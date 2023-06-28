@extends('admin.layouts.master')

@section('navTitle')
   {{trans('messages.settings')}} / {{trans('messages.app_settings')}}
@endsection

@section('content')
<br/>
<!--flash message-->
<div id = "alertMessage">
    @include('flash::message')
</div>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('messages.edit')}}  {{trans('messages.app_settings')}}         </h5>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
         </div>
      {!! Form::model($setting,['route' => ['settings.app.update',$setting->id] , 'method' => 'POST' , 'files' => true ,'class' => 'needs-validation']) !!}

      <div class="row">
        <div class="form-group col">
            <label for="validationCustom01">@lang('messages.iban') </label>
            {!! Form::text('iban', null, ['class' => 'form-control' , 'id'=> 'iban', 'placeholder' => trans('site.iban')]) !!}
            @if ($errors->has('iban'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('iban') }}</strong>  </span>
            @endif
        </div>

        <div class="form-group col">
            <label for="validationCustom01">@lang('messages.bank') </label>
            {!! Form::select('bank_id', $banks, null, ['class' => 'form-control']) !!}
            @if ($errors->has('bank_id'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('bank_id') }}</strong>  </span>
            @endif
        </div>
    </div>

        <div class="row">
            <div class="form-group col">
                <label for="validationCustom01">@lang('site.tax_percent') %</label>
																<input
																	oninvalid="this.setCustomValidity('@lang('site.must_be_positive_integer')')"
																	oninput="this.setCustomValidity('')"
																	step="1"
																	min="0"
																	type="number"
																	name="tax_percent"
																	placeholder="@lang('site.tax_percent')"
																	class="form-control"
																	value="{{$setting->tax_percent}}"
																/>
                @if ($errors->has('tax_percent'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('tax_percent') }}</strong>  </span>
                @endif
            </div>

            <div class="form-group col">
                <label for="validationCustom01">{{trans('messages.service_fees')}} ( {{ trans('messages.SR') }} )</label>
																<input
																	oninvalid="this.setCustomValidity('@lang('site.must_be_positive_integer')')"
																	oninput="this.setCustomValidity('')"
																	step="1"
																	min="0"
																	type="number"
																	name="service_fees"
																	placeholder="@lang('messages.service_fees')"
																	class="form-control"
																	value="{{$setting->service_fees}}"
																/>
                @if ($errors->has('service_fees'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('service_fees') }}</strong>  </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="form-group col">
                <label for="validationCustom01">{{trans('messages.min_loan')}} ( {{ trans('messages.SR') }} )</label>
                {!! Form::number('min_loan', null, ['class' => 'form-control' , 'id'=> 'min_loan', 'placeholder' => trans('messages.min_loan')]) !!}
                @if ($errors->has('min_loan'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('min_loan') }}</strong>  </span>
                @endif
            </div>
            <div class="form-group col">
                <label for="validationCustom01">{{trans('messages.max_loan')}} ( {{ trans('messages.SR') }} )</label>
                {!! Form::number('max_loan', null, ['class' => 'form-control' , 'id'=> 'max_loan', 'placeholder' => trans('messages.max_loan')]) !!}
                @if ($errors->has('max_loan'))
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('max_loan') }}</strong>  </span>
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
