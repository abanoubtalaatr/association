@extends('admin.layouts.master')

@section('navTitle')
   {{trans('messages.settings')}} / {{trans('messages.homepage_setting')}}
@endsection

@section('content')
<br/>
<!--flash message-->
<div id = "alertMessage">
    @include('flash::message')
</div>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('messages.edit')}}  {{trans('messages.homepage_setting')}}         </h5>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
         </div>
      {!! Form::model($setting,['route' => ['settings.homepage.update',$setting->id] , 'method' => 'POST' , 'files' => true ,'class' => 'needs-validation']) !!}
        <div class="row">
												<div class="form-group col">
													<label for="validationCustom02">{{ trans('messages.Page Top Title in Arabic') }} </label>
													{!! Form::text('hero_title_ar', null, ['class' => 'form-control' , 'placeholder' => trans('messages.Page Top Title in Arabic')]) !!}
													@if ($errors->has('hero_title_ar'))
														<span class="help-block">  <strong style="color: red;">{{ $errors->first('hero_title_ar') }}</strong>  </span>
													@endif
												</div>
												<div class="form-group col">
													<label for="validationCustom02">{{ trans('messages.Page Top Title in English') }} </label>
													{!! Form::text('hero_title_en', null, ['class' => 'form-control' , 'placeholder' => trans('messages.Page Top Title in English')]) !!}
													@if ($errors->has('hero_title_en'))
														<span class="help-block">  <strong style="color: red;">{{ $errors->first('hero_title_en') }}</strong>  </span>
													@endif
												</div>
        </div>
								<div class="row">
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Page Top Body in Arabic') }} </label>
										{!! Form::textarea('hero_body_ar', null, ['class' => 'form-control', 'rows' => 6 , 'placeholder' => trans('messages.Page Top Body in Arabic')]) !!}
										@if ($errors->has('hero_body_ar'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('hero_body_ar') }}</strong>  </span>
										@endif
									</div>
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Page Top Body in English') }} </label>
										{!! Form::textarea('hero_body_en', null, ['class' => 'form-control', 'rows' => 6 , 'placeholder' => trans('messages.Page Top Body in English')]) !!}
										@if ($errors->has('hero_body_en'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('hero_body_en') }}</strong>  </span>
										@endif
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Android App Url') }} </label>
										{!! Form::text('android_app_url', null, ['class' => 'form-control' , 'placeholder' => trans('messages.Android App Url')]) !!}
										@if ($errors->has('android_app_url'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('android_app_url') }}</strong>  </span>
										@endif
									</div>
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.IOS App Url') }} </label>
										{!! Form::text('ios_app_url', null, ['class' => 'form-control' , 'placeholder' => trans('messages.IOS App Url')]) !!}
										@if ($errors->has('ios_app_url'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('ios_app_url') }}</strong>  </span>
										@endif
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Apps Share Text in Arabic') }} </label>
										{!! Form::textarea('app_share_text_ar', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.Apps Share Text in Arabic')]) !!}
										@if ($errors->has('app_share_text_ar'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('app_share_text_ar') }}</strong>  </span>
										@endif
									</div>
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Apps Share Text in English') }} </label>
										{!! Form::textarea('app_share_text_en', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.Apps Share Text in English')]) !!}
										@if ($errors->has('app_share_text_en'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('app_share_text_en') }}</strong>  </span>
										@endif
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.First Feature in Arabic') }} </label>
										{!! Form::textarea('first_feature_ar', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.First Feature in Arabic')]) !!}
										@if ($errors->has('first_feature_ar'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('first_feature_ar') }}</strong>  </span>
										@endif
									</div>
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.First Feature in English') }} </label>
										{!! Form::textarea('first_feature_en', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.First Feature in English')]) !!}
										@if ($errors->has('first_feature_en'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('first_feature_en') }}</strong>  </span>
										@endif
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Second Feature in Arabic') }} </label>
										{!! Form::textarea('second_feature_ar', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.Second Feature in Arabic')]) !!}
										@if ($errors->has('second_feature_ar'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('second_feature_ar') }}</strong>  </span>
										@endif
									</div>
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Second Feature in English') }} </label>
										{!! Form::textarea('second_feature_en', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.Second Feature in English')]) !!}
										@if ($errors->has('second_feature_en'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('second_feature_en') }}</strong>  </span>
										@endif
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Third Feature in Arabic') }} </label>
										{!! Form::textarea('third_feature_ar', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.Third Feature in Arabic')]) !!}
										@if ($errors->has('third_feature_ar'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('third_feature_ar') }}</strong>  </span>
										@endif
									</div>
									<div class="form-group col">
										<label for="validationCustom02">{{ trans('messages.Third Feature in English') }} </label>
										{!! Form::textarea('third_feature_en', null, ['class' => 'form-control', 'rows' => 4 , 'placeholder' => trans('messages.Third Feature in English')]) !!}
										@if ($errors->has('third_feature_en'))
											<span class="help-block">  <strong style="color: red;">{{ $errors->first('third_feature_en') }}</strong>  </span>
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
