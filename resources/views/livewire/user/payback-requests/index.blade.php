
<main class="main-content">
    <!--head-->
    <x-user.head/>
    <!--table-->
    <div class="border-div">
    <div class="b-btm flex-div-2">
        <h4>{{$page_title}}</h4>
        @livewire('user.update-payment-method')
    </div>
        <h5 class="mt-5">{{trans('general.info_payback_request')  . \App\Models\Setting::first()->minimum_payback_amount .trans('general.rial')}}</h5>
<hr>
        <div class="table-page-wrap">

        <div class="row">


            <div class="form-group col-3">
                <label for="status-select">@lang('site.status')</label>
                <select wire:model='status' id='status-select' class="form-control  contact-input">
                    <option value>@lang('site.status')</option>
                    <option value="paid">@lang('site.paid')</option>
                    <option value="not_paid">@lang('site.not_paid')</option>
                    <option value="canceled">@lang('site.canceled')</option>
                </select>
            </div>

        </div>

        @if(count($records))
        <table class="table-page table">
            <thead>
            <tr>
                <th class='text-center'>#</th>
                <th class='text-center'>@lang('site.created_at')</th>
                <th class='text-center'>@lang('site.amount')</th>
                <th class='text-center'>@lang('site.status')</th>
                <th class='text-center'>@lang('validation.attributes.transaction_id')</th>
            </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td class='text-center'>{{$loop->index+1}}</td>
                    <td class='text-center'>{{$record->created_at->format('Y-m-d')}}</td>
                    <td class='text-center'>{{$record->amount}} @lang('site.sar_short')</td>

                    <td class='text-center'>
                        <div class="status {{$record->status_class}}">
                            <span>@lang('site.'.$record->status)</span>
                        </div>
                    </td>
                    <td class='text-center'>{{$record->transaction_id?? '---'}}</td>
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
