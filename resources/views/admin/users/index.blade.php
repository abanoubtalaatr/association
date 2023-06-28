@extends('admin.layouts.master')
@include('admin.users.style')

@section('navTitle')
    {{trans('messages.users')}}
@endsection

@section('content')

    <div id="alertMessage">
        @include('flash::message')
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4" style="overflow-x: auto">

                    <form action="">
                        <div class="row">
                            <div class="col">
                                <label for="">@lang('site.order_by')</label>
                                <select name="order_by" class='form-control'>
                                    <option value>@lang('site.order_by')</option>
                                    <option
                                        value="created_at" {{request('order_by')=='created_at'? 'selected' : ''}}>@lang('site.join_date')</option>
                                    <option
                                        value="loans_count" {{request('order_by')=='loans_count'? 'selected' : ''}}>@lang('site.loans_count')</option>
                                    <option
                                        value="loans_date" {{request('order_by')=='loans_date'? 'selected' : ''}}>@lang('site.loans_date')</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="">@lang('site.order_direction')</label>
                                <select name="order_direction" class='form-control'>
                                    <option value>@lang('site.order_direction')</option>
                                    <option
                                        value="asc" {{request('order_direction')=='asc'? 'selected' : ''}}>@lang('site.order_asc')</option>
                                    <option
                                        value="desc" {{request('order_direction')=='desc'? 'selected' : ''}}>@lang('site.order_desc')</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">@lang('site.region')</label>
                                <select name="region_id" class='form-control'>
                                    @foreach ($regions as $region_id=>$region_title)
                                        <option
                                            value="{{$region_id}}" {{request('region_id')==$region_id? 'selected' : ''}}>
                                            {{$region_title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="">@lang('site.city')</label>
                                <select name="city_id" class='form-control'>
                                    @foreach ($cities as $city_id=>$city_title)
                                        <option value="{{$city_id}}" {{request('city_id')==$city_id? 'selected' : ''}}>
                                            {{$city_title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="">@lang('site.status')</label>
                                <select name="status" class='form-control'>
                                    <option value>@lang('site.status')</option>
                                    <option
                                        value="active" {{request('status')=='active' ? 'selected' : ''}}>@lang('site.active')</option>
                                    <option
                                        value="inactive" {{request('status')=='inactive' ? 'selected' : ''}}>@lang('site.inactive')</option>
                                    <option
                                        value="inactive_not_paid" {{request('status')=='inactive_not_paid' ? 'selected' : ''}}>@lang('site.inactive_not_paid')</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="">@lang('site.loan_requests_number_from')</label>
                                    <input type="number" class="form-control" name='loans_count_from'
                                           value='{{request('loan_requests_number_from')}}'/>
                                </div>

                                <div class="col">
                                    <label for="">@lang('site.loan_requests_number_to')</label>
                                    <input type="number" class="form-control" name='loans_count_to'
                                           value='{{request('loan_requests_number_to')}}'/>
                                </div>

                            </div>


                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>@lang('site.user_id_number')</td>
                                <td>

                                </td>
                                <td colspan="2">
                                    <button type='submit'
                                            class='btn btn-primary pull-left'>@lang('site.search')</button>
                                    <button type='reset' onclick="window.location.href= location.pathname"
                                            class='btn btn-danger pull-left'>@lang('site.reset')</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>


                    <table class="table table-hover " style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Verify#</th>
                            <th>Login#</th>
                            <th>Loan#</th>
                            <th> {{trans('messages.name')}} </th>
                            <th> {{trans('messages.phone_number')}} </th>
                            <th> {{trans('messages.id_number')}} </th>
                            {{-- <th> @lang('site.city')</th> --}}
                            {{-- <th> {{trans('messages.salary')}} </th> --}}
                            {{-- <th> {{trans('messages.obligation')}} </th> --}}
                            <th> {{trans('messages.number_of_invitations')}} </th>
                            <th> {{trans('messages.activation')}} </th>
                            <th> {{trans('messages.no_of_requests')}} </th>
                            {{-- <th> @lang('messages.last_request_date') </th> --}}
                            <th> {{trans('messages.create_date')}} </th>
                            <th> {{trans('messages.operations')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$user->verified_code}}</td>
                                <td>{{$user->login_code}}</td>
                                <td>
                                    @php
                                        $loan = \App\Models\Loan::whereUserId($user->id)->where('status','otp')->latest()->first();
                                        echo ($loan)? $loan->verified_code : '--';
                                    @endphp


                                </td>
                                <td class="text-center">{{ $user->{"name_".app()->getLocale()} }}</td>
                                <td><a href="tel:{{ $user->mobile_number }}"> {{ $user->mobile_number }} </a></td>
                                <td class="text-center">{{ $user->id_number }}</td>
                                {{-- <td class="text-center">{{ $user->city }}</td> --}}
                                {{-- <td class="text-center">{{ $user->salary }}</td> --}}
                                {{-- <td class="text-center">{{$user->total_monthly_costs}}</td> --}}
                                <td class="text-center">{{$user->referred_count}}</td>
                                <td class="text-center">
                                    @lang('site.'.$user->status)
                                </td>
                                <td class="text-center">
                                    <a href="{{route('loans.index').'?user_id='.$user->id}}">
                                        {{$user->active_loans_count}}
                                    </a>
                                </td>
                                {{-- <td class="text-center">{{$user->last_request_date}}</td> --}}
                                <td class="text-center">{{ $user->created_at->format('Y-m-d')}}</td>
                                <td class="text-center">
                                    <a href="{{route('chat.user',$user->id)}}" class="btn btn-primary mb-2">
                                        @lang('messages.chat')
                                    </a>
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
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--  END CONTENT AREA  -->
@endsection
@include('admin.users.script')



