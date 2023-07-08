<main class="main-content">
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="">
            <h4 class="text-info">@lang('site.trainer_info')</h4>
            <hr>
            <div class="d-flex gap-2 flex-wrap ">
                <div class="border-end">
                    <span class="p-2">@lang('site.name') : {{$user->username}}</span>
                </div>
                <div class="border-end">
                    <span class="p-2">@lang('site.email') : {{$user->email}}</span>
                </div>
                <div class="border-end">
                    <span class="p-2">@lang('site.mobile') : {{$user->mobile}}</span>
                </div>
            </div>
            <hr>


        </div>
        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
            {{--            <a style='text-align:center' href='{{route('admin.course.create')}}' class="button btn-red big">@lang('site.create_new')</a>--}}
        </div>


        <div class="table-page-wrap">
            <div class="table-responsive">
                @if(count($records))
                    <table class="table-page table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.valid_to')</th>
                            <th>@lang('site.training_hours')</th>
                            <th>@lang('site.attend')</th>
                            <th>@lang('site.pass')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>#{{$loop->index + 1}}</td>

                                <td>{{$record->name}}</td>
                                <td>{{$record->description}}</td>
                                <td>{{\Carbon\carbon::parse($record->valid_to)->format('Y-m-d')}}</td>
                                <td>{{$record->training_hours}}</td>
                                <td>

                                    @if($record->pivot->attend_course && $record->pivot->attend_course == 1)
                                        @lang('site.yes')
                                    @else
                                        @lang('site.no')
                                    @endif
                                </td>
                                <td>
                                    @if($record->pivot->pass_course && $record->pivot->pass_course == 1)
                                        @lang('site.yes')
                                    @else
                                        @lang('site.no')
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$records->links()}}
                @else
                    <div class="alert alert-warning my-4">@lang('site.no_data_to_display')</div>
                @endif

            </div>
        </div>
    </div>
</main>
