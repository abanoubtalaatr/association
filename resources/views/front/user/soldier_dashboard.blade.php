@extends('layouts.user')
@section('content')
<main class="main-content">
    <x-user.head/>
    <!--wallet-->
    <div class="border-div">

        @if(auth('users')->user()->user_type=='soldier')


            <div class="row">
            <div class="col-6 col-md-4">
                <div class="dash box-shad">
                <div class="dash-img-wrap"><img src="{{asset('frontAssets/imgs/wallet/balance.svg')}}" alt=""></div>
                <h4>@lang('site.sar_short') {{$wallet_balance}}</h4>
                <p class="grey">@lang('site.wallet_balance')</p>
                </div>
            </div>


            <div class="col-6 col-md-4">
                <div class="dash box-shad">
                <div class="dash-img-wrap"><img src="{{asset('frontAssets/imgs/wallet/correct.svg')}}" alt=""></div>
                <h4>@lang('site.sar_short') {{$paid}}</h4>
                <p class="grey">@lang('site.paid_transactions')</p>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="dash box-shad">
                <div class="dash-img-wrap"><img src="{{asset('frontAssets/imgs/wallet/pending.svg')}}" alt=""></div>
                <h4>@lang('site.sar_short') {{$not_paid}}</h4>
                <p class="grey">@lang('site.not_paid_transactions')</p>
                </div>
            </div>
            {{-- <div class="col-6 col-md-3">
                <div class="dash box-shad">
                <div class="dash-img-wrap"><img src="assets_en/imgs/wallet/cancelled.svg" alt=""></div>
                <h4>@lang('site.sar_short') {{$canceled}}</h4>
                <p class="grey">@lang('site.canceled_transactions')</p>
                </div>
            </div> --}}
        </div>


            <div class="box-shad mr-30">
                {{-- <h5>@lang('site.transaction_history') </h5>
                <div class="table-responsive">
                    <table class="table-sort dataTables_length">
                    <thead>
                        <tr>
                            <th>@lang('site.id')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.amount')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payback_requests as $pb)
                        <tr>
                            <td>{{$pb->id}}</td>
                            <td>{{$pb->created_at}}</td>
                            <td><div>@lang('site.'.$pb->status)</div></td>
                            <td>{{$pb->amount}} @lang('site.sar_short')</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div> --}}
            </div>

        @endif
    </div>
</main>
@endsection
