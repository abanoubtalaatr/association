@extends('admin.layouts.master')
@include('admin.product-features.style')

@section('navTitle')
   @lang('site.product_features')
@endsection

@section('content')

@php
    $local = LaravelLocalization::getCurrentLocale();
@endphp

<div id = "alertMessage">
    @include('flash::message')
</div>
   <!--  BEGIN CONTENT AREA  -->


        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{trans('messages.content')}} </th>
                                    <th> {{trans('messages.activation')}} </th>
                                    <th> {{trans('messages.operations')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_features as $product_feature)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="no_dec">{{ $local == "en" ? $product_feature->en_content : $product_feature->ar_content }}</td>
                                        <td>
                                            <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                <input type="checkbox" onchange="Active({{$product_feature->is_active}},{{$product_feature->id}})" {{$product_feature->is_active == 1 ? 'checked' : ''}} >
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                                <button
																																																	data="{{$product_feature->id}}"
																																																	data_name="{{$product_feature->{app()->getLocale()."_content"} }}"
																																																	class="btn btn-danger mb-2 warning confirm" >
                                                    {{trans('messages.delete')}}
                                                </button>
                                                <a href="{{route('product-features.edit',$product_feature->id)}}" class="btn btn-primary mb-2">
                                                    {!! trans('messages.edit') !!}
                                                </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $product_features->links() !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>

<!--  END CONTENT AREA  -->
@endsection
@include('admin.product-features.script')

