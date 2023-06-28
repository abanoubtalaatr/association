@extends('admin.layouts.master')
@extends('admin.about-us.style')

@section('navTitle')
   {{trans('messages.about')}} / {{trans('messages.edit')}} {{trans('messages.about')}}
@endsection

@section('content')
<br/>

<div id = "alertMessage">
  @include('flash::message')
</div>

<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.edit')}} {{trans('messages.about')}}</h5>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
     </div>
      {!! Form::model($about_us,['route' => ['about-us.update',$about_us->id] , 'method' => 'PUT' , 'files' => true ]) !!}
      @include('admin.about-us.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.about-us.script')
