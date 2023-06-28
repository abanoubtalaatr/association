@extends('admin.layouts.master')

@section('navTitle')
   {{trans('messages.edit_profile')}}
@endsection

@section('content')
<br/>
<!--flash message-->
<div id = "alertMessage">
    @include('flash::message')
</div> 
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('messages.edit_profile')}}        </h5>
    </div>
    <div class="card-body">
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
        </div>
      {!! Form::model(auth('admin')->user(),['route' => ['profile.update',auth('admin')->user()->id] , 'method' => 'POST' , 'files' => true ]) !!}
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
                </div>
                <div>
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
                    </div>     
                </div>
                <div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">  <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>  </span>
                    @endif
                </div>
            </div>
        </div>
            <div class="text-right">
                <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
            </div>
      {!! Form::close() !!}
    </div>

</div>

@endsection
@section('scripts')
 <!----------- Begin show password------------>
 <script>
    $('#show1').on('click', function(){
       var passInput=$("#password");
       if(passInput.attr('type')==='password')
         {
           passInput.attr('type','text');
       }else{
          passInput.attr('type','password');
       }
   });
   $('#show2').on('click', function(){
       var passInput=$("#password_confirmation");
       if(passInput.attr('type')==='password')
         {
           passInput.attr('type','text');
       }else{
          passInput.attr('type','password');
       }
   });
</script>
<!----------- End show password------------>
@endsection
   