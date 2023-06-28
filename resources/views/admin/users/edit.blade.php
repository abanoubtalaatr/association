@extends('admin.layouts.master')
@extends('admin.admins.style')

@section('navTitle')
   {{trans('messages.admins')}} / {{trans('messages.edit_admin')}}
@endsection

@section('content')
<br/>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.edit_admin')}}</h5>
    </div>
    <div class="card-body">
     <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
    </div>
      {!! Form::model($admin,['route' => ['admin.update',$admin->id] , 'method' => 'PUT' , 'files' => true ]) !!}
        @include('admin.admins.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.admins.script')
