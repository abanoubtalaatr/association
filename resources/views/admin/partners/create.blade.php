@extends('admin.layouts.master')
@extends('admin.partners.style')


@section('navTitle')
{{trans('messages.partners')}} / {{trans('messages.add_new')}}
@endsection

@section('content')
<br/>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.add_new')}}</h5>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
     </div>

      {!! Form::open(['route' => 'partners.store' , 'method' => 'POST' , 'files' => true ]) !!}
         @include('admin.partners.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.partners.script')
