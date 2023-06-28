<div id="basic" class="row layout-spacing  layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> {{trans('messages.ar_content')}} </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                {!! Form::textarea('ar_content',null, ['class' => 'form-control ' ,'id'=>"editor7", 'placeholder' => trans('messages.ar_content')]) !!}
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('ar_content') }}</strong>  </span>
            </div>
        </div>
    </div>
</div>
    <div id="basic" class="row layout-spacing  layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> {{trans('messages.en_content')}} </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    {!! Form::textarea('en_content',null, ['class' => 'form-control ' ,'id'=>"editor8", 'placeholder' => trans('messages.en_content')]) !!}
                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('en_content') }}</strong>  </span>
                </div>
            </div>
        </div>
    </div>


    <div id="basic" class="row layout-spacing  layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> @lang('messages.image') </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
																	<div class="input-group mb-3">
																			<input type="file" name='image' class="form-control"/>
																			@isset($record->image)
																				<div class="input-group-append">
																					<a href="{{$record->image_url}}"  class="btn btn-default" target='_blank'>(@lang('site.preview'))</a>
																				</div>
																			@endisset

																	</div>

                    <span class="help-block">  <strong style="color: red;">{{ $errors->first('image') }}</strong>  </span>
                </div>
            </div>
        </div>
    </div>



    <div id="basic" class="row layout-spacing  layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> @lang('site.display_order') </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <select name="display_order" class="form-control">
                        @for ($i=1;$i<=10;$i++)
                            <option {{($i==optional($record)->display_order)? "selected" : ""}} value='{{$i}}'>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>


        <div class="text-right">
            <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
        </div>
