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

            <div class="row">
                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.username')</label>
                    <input wire:model='username' type="text" class="form-control contact-input">
                </div>

                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.email')</label>
                    <input wire:model='email' type="text" class="form-control contact-input">
                </div>

{{--                <div class="form-group col-3">--}}
{{--                    <label for="status-select">@lang('validation.attributes.tasks')</label>--}}
{{--                    <select wire:model='task_level' id='status-select' class="form-control  contact-input">--}}
{{--                        <option value>@lang('site.tasks')</option>--}}
{{--                        <option value="1">@lang('site.first_task')</option>--}}
{{--                        <option value="start_the_second">@lang('site.start_second_task')</option>--}}
{{--                        <option value="2">@lang('site.second_task')</option>--}}
{{--                        <option value="3">@lang('site.third_task')</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="form-group col-3">
                    <label for="status-select">@lang('site.status')</label>
                    <select wire:model='status' id='status-select' class="form-control  contact-input">
                        <option value>@lang('site.status')</option>
                        <option value="active">@lang('site.active')</option>
                        <option value="inactive">@lang('site.inactive')</option>
                    </select>
                </div>

                <div class="form-group col-3">
                    <label for="status-select">@lang('general.user_type')</label>
                    <select wire:model='user_type' id='status-select' class="form-control  contact-input">
                        <option value>@lang('general.user_type')</option>
                        <option value="soldier">@lang('site.soldier')</option>
                        <option value="advertiser">@lang('site.advertiser')</option>
                    </select>
                </div>


            </div>

            @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('validation.attributes.username')</th>
                        <th class="text-center">@lang('validation.attributes.email')</th>
                        <th class="text-center">@lang('validation.attributes.user_type')</th>
                        {{--                        <td class="text-center">@lang('validation.attributes.payment_number')</td>--}}
{{--                        <td class="text-center">@lang('validation.attributes.task')</td>--}}
                        <td class="text-center">@lang('validation.attributes.mobile_number')</td>
                        <td class="text-center">@lang('site.wallet')</td>
                        <td class="text-center">@lang('validation.attributes.created_at')</td>
                        <th class="text-center">@lang('site.status')</th>
                        <th>@lang('site.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>

                            <td class="text-center">{{ $rowNumber++ }}</td>
                            <td class='text-center'>{{$record->username}}</td>
                            <td class='text-center'>{{$record->email}}</td>
                            <td class="text-center">@lang('site.'.$record->user_type)</td>
                            {{--                            <td class="text-center">{{$record->payment_number}}</td>--}}

{{--                            @if(isset($start_task_two) && $start_task_two ==true)--}}
{{--                                <td class="text-center">@lang('site.start_second_task') </td>--}}
{{--                            @elseif($record->task_level == 0)--}}
{{--                                <td class="text-center">@lang('site.not_complete')</td>--}}
{{--                            @elseif($record->task_level ==1)--}}
{{--                                <td class="text-center">@lang('site.completed') @lang('site.first_task')</td>--}}
{{--                            @elseif($record->task_level ==2)--}}
{{--                                <td class="text-center">@lang('site.completed') @lang('site.second_task')</td>--}}
{{--                            @elseif($record->task_level ==3 || $record->task_level > 3)--}}
{{--                                <td class="text-center">@lang('site.completed') @lang('site.third_task')</td>--}}
{{--                            @endif--}}

                            <td class='text-center'>{{$record->mobile}}</td>
                            <td class='text-center'>{{$record->wallets->sum('amount')}}</td>
                            <td class='text-center'>{{$record->created_at}}</td>
                            <td class='text-center'>
                                <div class="status {{$record->status_class}}">
                                    <span>@lang('site.'.$record->status)</span>
                                </div>
                            </td>

                            <td>
                                <div class="actions">
                                    @if($record->user_type=='soldier')
                                        <a href="{{route('admin.user_stats',$record->id)}}" class="no-btn">
                                            <i class="fas fa-chart-bar"></i>
                                        </a>
                                        <a href="users/{{$record->id}}/ads/stats" class="no-btn">
                                            <i class="fas fa-poll"></i>
                                        </a>
{{--                                        <a href="{{route('admin.user_single_library_stats',$record->id)}}"--}}
{{--                                           class="no-btn">--}}
{{--                                            <i class="fas fa-chart-pie"></i>--}}
{{--                                        </a>--}}
                                    @endif
                                    <a href="{{route('admin.'.($record->user_type=='soldier'? 'payback_requests' : 'billing.index'))}}?user_id={{$record->id}}"
                                       class="no-btn">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>

                                    <button
                                        wire:click='toggleStatus({{$record->id}})'
                                        class="no-btn">
                                        <i class="fas @if($record->status=='active') fa-lock red @else fa-unlock green @endif"></i>
                                    </button>
                                    <a href='{{route('admin.users.edit',$record->id)}}' class="no-btn"><i
                                            class="far fa-edit blue"></i></a>



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
