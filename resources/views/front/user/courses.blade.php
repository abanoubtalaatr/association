@extends('layouts.user')
@section('content')
 <main class="main-content">
    <x-user.head></x-user.head>
    <!--table-->
    <div class="mr-30">
    <div class="table-wrap">
        <h5>{{$page_title}}</h5>
        <div class="table-responsive">
            @if(count($courses))
                <table class="table-page table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('messages.name')</th>
                            <th>@lang('messages.description')</th>
                            <th>@lang('site.certification')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $record)
                            <tr>
                                <td>#{{$loop->index + 1}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->description}}</td>
                                <td>

                                    <a target="_blank" href="{{url('/uploads/pics/certifications/users/'.$record->pivot->user_id.'/'. $record->pivot->course_id.'/'. $record->pivot->pivotParent->random_url)}}">
                                        <i class="fas fa-file"></i>
                                    </a>
                                    @if($record->pivot->pass_course==1 && $record->pivot->attend_course)

                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
{{--                {{$cor->links()}}--}}
            @else
                <div class="alert alert-warning">@lang('site.no_data_to_display')</div>
            @endif

        </div>
    </div>
    </div>
</main>
@endsection
