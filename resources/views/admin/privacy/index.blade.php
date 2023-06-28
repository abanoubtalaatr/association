@extends('admin.layouts.master')
@extends('admin.privacy.style')

@section('navTitle')
   {{trans('messages.privacy_policies')}} / {{trans('messages.edit')}} {{trans('messages.privacy_policies')}}
@endsection

@section('content')
<br/>

<div id = "alertMessage">
  @include('flash::message')
</div>

<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.edit')}} {{trans('messages.privacy_policies')}}</h5>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
     </div>
      {!! Form::model($privacy,['route' => ['privacy.update',$privacy->id] , 'method' => 'PUT' , 'files' => true ]) !!}
        @include('admin.privacy.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.privacy.script')
