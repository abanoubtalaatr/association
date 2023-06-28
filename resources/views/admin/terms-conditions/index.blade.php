@extends('admin.layouts.master')
@extends('admin.terms-conditions.style')

@section('navTitle')
   {{trans('messages.terms_condition')}} / {{trans('messages.edit')}} {{trans('messages.terms_condition')}}
@endsection

@section('content')
<br/>

<div id = "alertMessage">
  @include('flash::message')
</div>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.edit')}} {{trans('messages.terms_condition')}}</h5>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
     </div>
      {!! Form::model($terms_conditions,['route' => ['terms-conditions.update',$terms_conditions->id] , 'method' => 'PUT' , 'files' => true ]) !!}
        @include('admin.terms-conditions.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.terms-conditions.script')
