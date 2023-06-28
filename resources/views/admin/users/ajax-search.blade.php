@extends('admin.layouts.master')
@include('admin.users.style')

@section('navTitle')
   {{trans('messages.users')}}
@endsection

@php
    $local = LaravelLocalization::getCurrentLocale();
    $city = $local == 'en' ? 'city' : 'مدينة' ;
    $area = $local == 'en' ? 'area' : 'منطقة' ;
    $number_of_loan = $local == 'en' ? 'number of loan' : 'عدد طلبات القروض' ;
    $number_of_invitation = $local == 'en' ? 'number of invitation' : 'عدد الدعوات' ;
    $blacklist = $local == 'en' ? 'black list users' : 'المستخدمين غير المفعلين' ;
    $salary = $local == 'en' ? 'salary' : 'الراتب' ;
    $obligation = $local == 'en' ? 'obligation' : 'الملتزمات' ;
@endphp

@section('content')

<div id = "alertMessage">
    @include('flash::message')
</div>

   <!--  BEGIN CONTENT AREA  -->
    <div >        
        <div class="col-xl-4 col-lg-4 col-sm-4">
            <label for="exampleFormControlInput2"> {{trans('messages.type')}}</label>
            {!! Form::select('filter',[
                'city' => "$city",  'area' => "$area" , 'number_of_loan' => "$number_of_loan", 'number_of_invitation' => "$number_of_invitation" , 'blacklist' => "$blacklist" ,'salary'=> "$salary", 'obligation' => "$obligation"
            ] , null,
            ['class'=>'form-control type',]) !!}
        </div>
        <br>
        <div class="col-xl-4 col-lg-4 col-sm-4  ">
            <input type="text" class="w-100 form-control product-search " id="input-search" placeholder="Search..." >
        </div>
        <br>
        <div class="col-xl-4 col-lg-4 col-sm-4  ">
                <button class="btn btn-primary"  id = "searchButton" >{{ trans('messages.search') }}</button>
        </div>
    </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4" style="overflow-x: auto">
                        <table id="default-ordering" class="table table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{trans('messages.name')}} </th>
                                    <th> {{trans('messages.phone_number')}} </th>
                                    <th> {{trans('messages.city')}} </th>
                                    <th> {{trans('messages.area')}} </th>
                                    <th> {{trans('messages.salary')}} </th>
                                    <th> {{trans('messages.obligation')}} </th>
                                    <th> {{trans('messages.number_of_invitations')}} </th>
                                    <th> {{trans('messages.activation')}} </th>
                                    <th> {{trans('messages.no_of_requests')}} </th>
                                    <th> {{trans('messages.last_request_date')}} </th>
                                    <th> {{trans('messages.create_date')}} </th>
                                    <th> {{trans('messages.operations')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>                    
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="no_dec">{{ $user->arabic_name }}</td>
                                        <td><a href="tel:{{ $user->mobile_number }}"> {{ $user->mobile_number }} </a></td>
                                        <td class="no_dec">{{ $user->city }}</td>
                                        <td class="no_dec">{{ $user->city }}</td>
                                        <td class="no_dec">0</td>
                                        <td class="no_dec">0</td>
                                        <td class="no_dec">0</td>
                                        <td class="no_dec">{{ $user->arabic_name }}</td>
                                        <td class="no_dec">0</td>
                                        <td class="no_dec">23-11-2021</td>
                                        <td class="no_dec">{{ $user->created_at->format('Y-m-d')}}</td>
                                        <td class="text-center">
                                                <button data="{{$user->id}}" data_name="{{$user->name}}" class="btn btn-danger mb-2 warning confirm" >
                                                    {{trans('messages.delete')}}
                                                </button>
                                                <a href="{{route('users.show',$user->id)}}" class="btn btn-primary mb-2">
                                                    {!! trans('messages.show') !!}
                                                </a>
                                                <a href="{{route('users.activate',$user->id)}}" class="btn btn-warning mb-2">
                                                    {!! trans('messages.activation') !!}
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="d-flex justify-content-center">
                            {!! $admins->links() !!}
                        </div> --}}
                    </div>
                </div>
                
            </div>

        </div>

<!--  END CONTENT AREA  -->
@endsection
@include('admin.users.script')

 