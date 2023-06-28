<main class="main-content">
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
            <a style='text-align:center' href='{{route('admin.create_discount')}}'
               class="button btn-red big">@lang('site.create_new')</a>
        </div>


        <div class="table-page-wrap">
            <div class="table-responsive">
                @if(count($records))
                    <table class="table-page table mt-5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('validation.attributes.discount_code')</th>
                            <th>@lang('validation.attributes.discount_type')</th>
                            <th>@lang('validation.attributes.discount_value')</th>
                            <th>@lang('validation.attributes.number_of_times')</th>
                            <th>@lang('general.number_of_times_is_used')</th>
                            <th>@lang('validation.attributes.start_date')</th>
                            <th>@lang('validation.attributes.expire_at')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>#{{$loop->index + 1}}</td>
                                <td>{{$record->discount_code }}</td>
                                <td>{{app()->getLocale() =='ar'? $record->type=='value'?'قيمة':'نسبة مئوية':$record->type}}</td>
                                <td>{{$record->value}}</td>
                                <td>{{$record->number_of_times}}</td>
                                <td>{{$record->number_of_times_is_used}}</td>
                                <td>{{$record->start_at}}</td>
                                <td>{{$record->expire_at}}</td>

                                <td>
                                    <div class="actions">
                                        <a class="no-btn" href='{{route('admin.edit_discount',$record)}}'><i
                                                class="far fa-edit blue"></i></a>

                                        <a class="no-btn" href='{{route('admin.delete_discount',$record)}}'><i
                                                class="fas fa-trash red"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$records->links()}}
                @else
                    <div class="alert alert-warning mt-5">@lang('site.no_data_to_display')</div>
                @endif

            </div>
        </div>
    </div>
</main>
