@extends('layouts.admin')
@section('content')
<main class="main-content">
          <!--head-->
          <x-admin.head/>
          <!--table-->
          <div class="border-div">
            <div class="b-btm flex-div-2">
              <h4>{{$page_title}}</h4>
              {{-- <a style='text-align:center' href='{{route('user.create_ad')}}' class="button btn-red big">@lang('site.create_ad')</a> --}}
            </div>
            <div class="table-page-wrap">
                @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('validation.attributes.username')</th>
                        <th class="text-center">@lang('validation.attributes.email')</th>
                        <th class="text-center">@lang('site.visitors_number')</th>
                        <td class="text-center">@lang('validation.attributes.payment_number')</td>
                        <th>@lang('site.details')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class='text-center'>{{$record->user->username??''}}</td>
                            <td class='text-center'>{{$record->user->email??''}}</td>
                            <td class='text-center'>{{$record->visitors_number}}</td>
                            <td class="text-center">{{$record->user->payment_number??''}}</td>


                            <td>
                                <div class="actions">
                                    <a href="{{route('admin.user_ad_stats',[$record->user,$record->ad_id])}}" class="no-btn">
                                        <i class="fas fa-chart-bar"></i>
                                    </a>
                                </div>
                            </td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>

                {{$records->links()}}
                @else
                    <div class="row" style='margin-top:10px'>
                        <div class="alert alert-warning">@lang('site.no_data_to_display')</div>
                    </div>
                @endif
            </div>
          </div>
        </main>
@endsection
