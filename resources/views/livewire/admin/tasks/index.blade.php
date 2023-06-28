<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
    <div class="b-btm flex-div-2">
        <h4>{{$page_title}}</h4>
        <a style='text-align:center' href='{{route('admin.task.create')}}' class="button btn-red big">@lang('site.create_new')</a>
    </div>
    <div class="table-page-wrap">
        <table class="table-page table">
        <thead>
            <tr>
                <th>@lang('site.series')</th>
                <th>@lang('site.title')</th>
                <th>@lang('site.actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    <td>{{$record->title}}</td>
                    <td>
                        <div class="actions">
                            <a href='{{route('admin.task.edit',$record->id)}}' class="no-btn"><i class="far fa-edit blue"></i></a>
                            @if($record->id!=1)
                                <button class="no-btn" wire:click='destroy({{$record->id}})'><i class="fas fa-trash red"></i></button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</main>
