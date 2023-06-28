    <div class="form-row">
        <div class="col-md-4 mb-4">
            <label for="validationCustom01">{{trans('messages.name')}}</label>
            {!! Form::text('name', null, ['class' => 'form-control' , 'id'=> 'name', 'placeholder' => trans('messages.name')]) !!}
            @if ($errors->has('name'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('name') }}</strong>  </span>
            @endif
        </div>
    
        <div class="col-md-4 mb-4">
            <label for="validationCustom02">{{trans('messages.email')}}</label>
            {!! Form::text('email', null, ['class' => 'form-control' , 'id'=> 'email', 'placeholder' => trans('messages.email')]) !!}
            @if ($errors->has('email'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('email') }}</strong>  </span>
            @endif
        </div>
    </div>
        <div class="form-row ">
            <div class="col-md-4 mb-4">
                <label for="validationCustom02">{{ trans('messages.password') }} </label>
                <div class="input-group">
                    {!! Form::password('password', ['class' => 'form-control' , 'id' => 'password','placeholder' => trans('messages.password')]) !!}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <svg id="show1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>           
                        </span>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">  <strong style="color: red;">{{ $errors->first('password') }}</strong>  </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <label for="validationCustom02">{{ trans('messages.password_confirmation') }}</label>
                <div class=" input-group">
                    {!! Form::password('password_confirmation', ['class' => 'form-control' ,  'id' => 'password_confirmation','placeholder' => trans('messages.password_confirmation')]) !!}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <svg id="show2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>           
                        </span>
                    </div>                @if ($errors->has('password_confirmation'))
                        <span class="help-block">  <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>  </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
        </div>
