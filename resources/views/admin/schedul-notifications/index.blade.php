@extends('admin.layouts.master')
@include('admin.schedul-notifications.style')

@section('navTitle')
   {{trans('messages.schedul-notifications')}}
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
                                    <th> {{trans('messages.title')}} </th>
                                    <th> {{trans('messages.content')}} </th>
                                    <th> {{trans('messages.send_date')}} </th>
                                    <th> {{trans('messages.send_time')}} </th>
                                    <th> {{trans('messages.activation')}} </th>
                                    <th> {{trans('messages.operations')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedulNotifications as $schedul_notification)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="no_dec">{{ $local == "en" ? $schedul_notification->en_title : $schedul_notification->ar_title }}</td>
                                        <td class="no_dec">{{ $local == "en" ? $schedul_notification->en_content : $schedul_notification->ar_content }}</td>
                                        <td class="no_dec">{{$schedul_notification->send_date }}</td>
                                        <td class="no_dec">{{$schedul_notification->send_time }}</td>

                                        <td>
                                            <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                <input type="checkbox" onchange="Active({{$schedul_notification->send}},{{$schedul_notification->id}})" {{$schedul_notification->send == 1 ? 'checked' : ''}} >
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                                <button
																																																	data="{{$schedul_notification->id}}"
																																																	data_name="{{$schedul_notification->{app()->getLocale()."_title"} }}" class="btn btn-danger mb-2 warning confirm" >
                                                    {{trans('messages.delete')}}
                                                </button>
                                                {{-- <a href="{{route('schedul-notifications.edit',$schedul_notification->id)}}" class="btn btn-primary mb-2">
                                                    {!! trans('messages.edit') !!}
                                                </a>                                             --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $schedulNotifications->links() !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>

<!--  END CONTENT AREA  -->
@endsection
@include('admin.schedul-notifications.script')

