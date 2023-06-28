@extends('admin.layouts.master')
@extends('admin.product-features.style')

@section('navTitle')
    @lang('site.product_features') / {{trans('messages.add')}} @lang('site.product_features')
@endsection

@section('content')
<br/>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.add')}} @lang('site.product_features')</h5>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
     </div>
      {!! Form::open(['route' => 'product-features.store' , 'method' => 'POST' , 'files' => true ]) !!}
         @include('admin.product-features.form')
      {!! Form::close() !!}
    </div>

</div>
@endsection
@extends('admin.product-features.script')
