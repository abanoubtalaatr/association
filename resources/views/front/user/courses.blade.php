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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $record)
                                <tr>
                                    <td>#{{$loop->index + 1}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->description}}</td>
                                    <td>


                                        @if($record->pivot->pass_course==1 && $record->pivot->attend_course ==1)
                                            {{--                                        <a target="_blank"href="{{url('/uploads/pics/certifications/users/'.$record->pivot->user_id.'/'. $record->pivot->course_id.'/'. $record->pivot->pivotParent->random_url)}}">--}}
                                            {{--                                            <i class="fas fa-file"></i>--}}
                                            {{--                                        </a>--}}

                                            <input hidden id="certification_link"
                                                   value="{{url('/uploads/pics/certifications/users/'.$record->pivot->user_id.'/'. $record->pivot->course_id.'/'. $record->pivot->pivotParent->random_url)}}">
                                            <button class="btn btn-primary"
                                                    onclick='copyToClipboard("{{url('/uploads/pics/certifications/users/'.$record->pivot->user_id.'/'. $record->pivot->course_id.'/'. $record->pivot->pivotParent->random_url)}}")'>@lang('site.share_certification_with_others') </button>
                                            <a class="btn btn-primary my-1"
                                               href="whatsapp://send?text={{url('/uploads/pics/certifications/users/'.$record->pivot->user_id.'/'. $record->pivot->course_id.'/'. $record->pivot->pivotParent->random_url)}}"
                                               class="button btn-w mx-2 text-decoration-none"
                                               data-action="share/whatsapp/share">@lang("site.share_certification")</a>
                                        @else
                                            <span>@lang('site.you_must_attend_and_pass_course')</span>
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
<script>
    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);

        textarea.select();
        document.execCommand('copy');

        document.body.removeChild(textarea);
        console.log('Text copied to clipboard');
    }

</script>
