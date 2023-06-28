<main class="main-content">
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
            <a style='text-align:center' href='{{route('admin.create_role')}}'
               class="button btn-red big">@lang('site.create_new')</a>
        </div>


        <div class="table-page-wrap">
            <div class="table-responsive">
                @if(count($records))
                    <table class="table-page table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name_en')</th>
                            <th>@lang('site.name_ar')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>#{{$loop->index + 1}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->name_ar}}</td>
                                <td>{{$record->created_at}}</td>
                                <td>
                                    <div class="actions">
                                        <a class="no-btn" href='{{route('admin.edit_role',$record)}}'><i
                                                class="far fa-edit blue"></i></a>
                                        @if(!$record->is_owner)
                                            <button class="no-btn" wire:click='destroy({{$record->id}})'><i
                                                    class="fas fa-trash red"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$records->links()}}
                @else
                    <div class="alert alert-warning">@lang('site.no_data_to_display')</div>
                @endif

            </div>
        </div>
    </div>
</main>
