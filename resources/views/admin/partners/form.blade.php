    <div class="form-row">
        <div class="col-md-6 mb-4">
            <label for="validationCustom01">{{trans('messages.Name in Arabic')}}</label>
            {!! Form::text('name_ar', null, ['class' => 'form-control' , 'id'=> 'name_ar', 'placeholder' => trans('messages.Name in Arabic')]) !!}
            @if ($errors->has('name_ar'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('name_ar') }}</strong>  </span>
            @endif
        </div>

								<div class="col-md-6 mb-4">
												<label for="validationCustom01">{{trans('messages.Name in English')}}</label>
												{!! Form::text('name_en', null, ['class' => 'form-control' , 'id'=> 'name_en', 'placeholder' => trans('messages.Name in English')]) !!}
												@if ($errors->has('name_en'))
																<span class="help-block">  <strong style="color: red;">{{ $errors->first('name_en') }}</strong>  </span>
												@endif
								</div>
    </div>
        <div class="form-row ">
            <div class="col-md-12 mb-4">
																<div class="custom-file-container" data-upload-id="myFirstImage">
																	<label>{{ trans('messages.select_photo') }}
																		@if(isset($partner) && !empty($partner))
																			<a href="{{$partner->image_url}}" target='_blank'>(@lang('site.preview'))</a>
																		@endif
																		</label>
																	<label class="custom-file-container__custom-file" >
																		<input type="file" name="image" accept="image/*"/>
																	</label>
																	@if ($errors->has('image'))
																		<span class="help-block">  <strong style="color: red;">{{ $errors->first('image') }}</strong>  </span>
																	@endif
																</div>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
        </div>
