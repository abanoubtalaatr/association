@extends('admin.layouts.master')
@include('admin.partners.style')

@section('navTitle')
   {{trans('messages.partners')}}
@endsection

@section('content')

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
                                    <th> {{trans('messages.Name in Arabic')}} </th>
                                    <th> {{trans('messages.Name in English')}} </th>
                                    <th> {{trans('messages.Image')}} </th>
                                    <th class="text-center"> {{trans('messages.operations')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="no_dec">{{ $partner->name_ar }}</td>
                                        <td class="no_dec">{{ $partner->name_en }}</td>
                                        <td><img style="width: 80px;" src="{{ $partner->image_url }}" alt="{{ $partner->name }}"></td>
                                        <td class="text-center">
																																												<button data="{{$partner->id}}" data_name="{{$partner->name}}" class="btn btn-danger mb-2 warning confirm" >
																																																{{trans('messages.delete')}}
																																												</button>
																																												<a href="{{route('partners.edit',$partner->id)}}" class="btn btn-primary mb-2">
																																																{!! trans('messages.edit') !!}
																																												</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $partners->links() !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>

<!--  END CONTENT AREA  -->
@endsection
@include('admin.partners.script')

