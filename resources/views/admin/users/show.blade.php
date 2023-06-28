@extends('admin.layouts.master')
@extends('admin.users.style')


@section('navTitle')
{{trans('messages.users')}} / {{trans('messages.show')}} {{trans('messages.user')}}
@endsection



@push('page-styles')
    <style>
        th{
            color:white;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        .text-bold{
            color:white;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')

<br/>
<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('messages.show')}} {{trans('messages.user')}}</h5>
    </div>
    <div class="card-body">

        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-danger  mt-3">{{trans('messages.back')}}</a>
        </div>

        <table class="table">
            <tr>
                <td class='text-bold'>@lang('messages.user_id')</td>
                <td>{{$user->referral_id}}</td>
                <td colspan="2"></td>
            </tr>


            <tr>
                <th class="text-center" colspan="100%">@lang('messages.personal_info')</th>
            </tr>
            <tr>
                <td class='text-bold'>@lang('messages.english_name')</td>
                <td>{{$user->english_name}}</td>

                <td class='text-bold'>@lang('messages.arabic_name')</td>
                <td>{{$user->arabic_name}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('validation.attributes.mobile')</td>
                <td>{{$user->mobile_number}}</td>

                <td class='text-bold'>@lang('site.gender')</td>
                <td>{{$user->gender}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.id_number')</td>
                <td>{{$user->id_number}}</td>

                <td class='text-bold'>@lang('messages.id_expiration_date')</td>
                <td>{{$user->id_expiration_date}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.date_of_birth')</td>
                <td>{{$user->date_of_birth}}</td>

                <td class='text-bold'>@lang('messages.nationality')</td>
                <td>{{$user->nationality}}</td>
            </tr>

												<tr>
                <td class='text-bold'>@lang('messages.email')</td>
                <td>{{$user->email}}</td>

                <td class='text-bold'></td>
                <td></td>
            </tr>

            <tr>
                <th colspan="100%">@lang('site.address_details')</th>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.building_number')</td>
                <td>{{$user->building_number}}</td>

                <td class='text-bold'>@lang('messages.street_name')</td>
                <td>{{$user->street_name}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('site.city')</td>
                <td>{{$user->city}}</td>

                <td class='text-bold'>@lang('site.neighborhood')</td>
                <td>{{$user->neighborhood}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.postal_code')</td>
                <td>{{$user->postal_code}}</td>
            </tr>



            <tr>
                <th colspan="100%">@lang('site.eligibility_information')</th>
            </tr>


            <tr>
                <td class='text-bold'>@lang('site.employee')</td>
                <td>{{$user->employee? __('site.yes') : __('site.no')}}</td>

                <td class='text-bold'>@lang('messages.work_entity_name')</td>
                <td>{{$user->work_entity_name}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.salary')</td>
                <td>{{$user->salary}} @lang('site.rs')</td>

                <td class='text-bold'>@lang('messages.total_monthly_expenses')</td>
                <td>{{$user->total_monthly_expenses}}  @lang('site.rs')</td>
            </tr>


            <tr>
                <td class='text-bold'>@lang('messages.total_monthly_obligations')</td>
                <td>{{$user->total_monthly_obligations}}  @lang('site.rs')</td>

                <td class='text-bold'>@lang('messages.home')</td>
                <td>{{$user->home}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.marital_status')</td>
                <td class='text-bold'>@lang('site.'.$user->marital_status)</td>

                <td class='text-bold'>@lang('messages.number_of_children')</td>
                <td>{{$user->number_of_children}}</td>
            </tr>

            <tr>
                <td class='text-bold'>@lang('messages.number_of_domestic_workers')</td>
                <td>{{$user->number_of_domestic_workers}}</td>
                <td colspan='2'></td>
            </tr>

            <tr>
                <th colspan="100%">@lang('site.bank_accounts')</th>
            </tr>
            <tr>
                <td colspan="100%">
                    <table class='table'>
                        <tr>
                            <td class="text-bold">@lang('messages.iban')</td>
                            <td class="text-bold">@lang('site.bank')</td>
                            <td class="text-bold">@lang('site.default_account')</td>
                        </tr>
                        @foreach ($user->banks as $bank)
                            <tr>
                                <td>{{$bank->pivot->iban}}</td>
                                <td>{{$bank->{"title_".app()->getLocale()} }}</td>
                                <td>{{$bank->pivot->default? __('site.yes') : __('site.no')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>


        </table>


    </div>
</div>

@endsection
@extends('admin.users.script')
