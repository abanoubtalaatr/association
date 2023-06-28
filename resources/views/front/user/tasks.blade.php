@extends('layouts.user')
@section('content')
 <main class="main-content">
    <x-user.head></x-user.head>
    <!--table-->
    <div class="mr-30">
    <div class="table-wrap">
        <h5>{{$page_title}}</h5>
        <div class="table-responsive">
            @if(count($records))
                <table class="table-page table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('messages.title')</th>
                            <th>@lang('messages.description')</th>
                            <th>@lang('site.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>#{{$loop->index + 1}}</td>
                                <td>
                                    @if($record->id<=auth('users')->user()->task_level)
                                        {{$record->title}}
                                    @else
                                        <a href="{{route('user.show_task',$record->id)}}">
                                            {{$record->title}}
                                        </a>
                                    @endif
                                </td>
                                <td>{{$record->description}}</td>
                                <td>
                                    @if($record->id>auth('users')->user()->task_level)
                                        <div class="status yellow"><span>@lang('site.incomplete')</span></div>
                                    @else
                                        <div class="status green">
                                            <span>@lang('site.complete')</span>
                                        </div>
                                    @endif
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
@endsection
