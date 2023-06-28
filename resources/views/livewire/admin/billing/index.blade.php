<main class="main-content">
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="table-page-wrap">
            <div class="row">
                <hr>
                <div class="form-group col-3">
                    <label for="status-select">@lang('site.search')</label>
                    <input wire:model='title' type="text" class="form-control contact-input">
                </div>
                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.ad_title')</label>
                    <select wire:model='ad_id' id='status-select' class="form-control  contact-input">
                        <option value>@lang('validation.attributes.ad_title')</option>
                        @foreach($myAds as $record)
                            <option value="{{$record->id}}">{{$record->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <label for="status-select">@lang('site.status')</label>
                    <select wire:model='status' id='status-select' class="form-control  contact-input">
                        <option value>@lang('site.status')</option>
                        <option value="unpaid">@lang('site.unpaid')</option>
                        <option value="reviewing">@lang('site.reviewing')</option>
                        <option value="active">@lang('site.active')</option>
                        <option value="finished">@lang('site.finished')</option>
                        <option value="inactive">@lang('site.inactive')</option>
                    </select>
                </div>

            </div>

            @if(count($records))
                <table class="table-page table mt-3">
                    <thead>
                    <tr>
                        <th><a wire:click.prevent="sortBy('title')" href="#">
                                @lang('validation.attributes.ad_title')
                                @if ($sortDirection == 'asc' && $sortBy=='title')
                                    <i class="fa fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa fa-sort-alpha-down"></i>
                                @endif
                            </a></th>

                        <th>
                            <a wire:click.prevent="sortBy('budget')" href="#">
                                @lang('validation.attributes.budget')
                                @if ($sortDirection == 'asc' && $sortBy=='budget')
                                    <i class="fa fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa fa-sort-alpha-down"></i>
                                @endif
                            </a></th>
                        <th>
                            <a wire:click.prevent="sortBy('status')" href="#">
                                @lang('site.status')
                                @if ($sortDirection == 'asc' && $sortBy=='status')
                                    <i class="fa fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa fa-sort-alpha-down"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            @lang('messages.payment_method')
                            <a wire:click.prevent="sortBy('paymentBrand')"
                               href="#">

                                @if ($sortDirection == 'asc' && $sortBy=='paymentBrand')
                                    <i class="fa fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa fa-sort-alpha-down"></i>
                                @endif
                            </a>
                        </th>
                        {{--                        <th>@lang('validation.attributes.amount')</th>--}}
                        <th>
                            @lang('site.date')
                            <a wire:click.prevent="sortBy('timestamp')"
                               href="#">

                                @if ($sortDirection == 'asc' && $sortBy=='timestamp')
                                    <i class="fa fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa fa-sort-alpha-down"></i>
                                @endif
                            </a>
                        </th>
                        <th>@lang('site.card_no')</th>
                        <th>@lang('site.card_holder')</th>
{{--                        <th>@lang('site.payment_status')</th>--}}

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{$record->title}}</td>
                            <td>{{$record->budget}} @lang('site.sar_short')</td>
                            <td>@lang('site.'.$record->status)</td>
                            <td>{{optional($record->payment_info)->paymentBrand}}</td>
                            {{--                            <td>{{optional($record->payment_info)->amount}} @lang('site.sar_short')</td>--}}
                            <td>
                                @if(isset($record->payment_info->timestamp))
                                    {{(\Carbon\Carbon::parse($record->payment_info->timestamp)->format('Y-m-d : H:m:s'))}}
                                @endif
                            </td>
                            <td>
                                @if(isset($record->payment_info->card->bin))
                                    {{$record->payment_info->card->bin}}
                                @endif
                            </td>
                            <td>
                                @if(isset($record->payment_info->customer->givenName))
                                    {{$record->payment_info->customer->givenName}}
                                @endif
                            </td>
                            {{-- <td>{{optional($record->payment_info)->card->holder}}</td> --}}
{{--                            <td>@lang('site.approved')</td>--}}

                        </tr>
                    @endforeach
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
