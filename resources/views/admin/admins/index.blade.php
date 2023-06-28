@extends('admin.layouts.master')
@include('admin.admins.style')

@section('navTitle')
   {{trans('messages.admins')}}
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
                                    <th> {{trans('messages.name')}} </th>
                                    <th> {{trans('messages.email')}} </th>
                                    <th> {{trans('messages.activation')}} </th>
                                    <th> {{trans('messages.operations')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="no_dec">{{ $admin->name }}</td>
                                        <td><a href="mailto:{{ $admin->email }}"> {{ $admin->email }} </a></td>
                                        <td>
                                            @if($admin->id != 1)
                                               <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                   <input type="checkbox" onchange="Active({{$admin->is_active}},{{$admin->id}})" {{$admin->is_active == 1 ? 'checked' : ''}} >
                                                   <span class="slider round"></span>
                                               </label>
                                           @endif
                                       </td>
                                        <td class="text-center">
                                            @if($admin->id != 1)
                                                <button data="{{$admin->id}}" data_name="{{$admin->name}}" class="btn btn-danger mb-2 warning confirm" >
                                                    {{trans('messages.delete')}}
                                                </button>
                                                <a href="{{route('admin.edit',$admin->id)}}" class="btn btn-primary mb-2">
                                                    {!! trans('messages.edit') !!}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $admins->links() !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>

<!--  END CONTENT AREA  -->
@endsection
@include('admin.admins.script')

