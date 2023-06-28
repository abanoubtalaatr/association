
@extends('admin.layouts.master')

@extends('admin.schedul-notifications.style')
@section('navTitle')
   {{trans('messages.schedul-notifications')}} / {{trans('messages.add')}} {{trans('messages.schedul-notifications')}}
@endsection

@section('content')
<br/>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.add')}} {{trans('messages.schedul-notifications')}}</h5>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
     </div>
      {!! Form::open(['route' => 'schedul-notifications.store' , 'method' => 'POST' , 'files' => true ]) !!}
         @include('admin.schedul-notifications.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.schedul-notifications.script')
