@extends('layouts.user')
@section('content')
 <!-- Main Content-->
<main class="main-content">
    <!--head-->
    <x-user.head></x-user.head>
    <!--dashboard-->
    <div class="border-div">
        <div class="row">
            <div class="col-md-7">
                <div class="box-det">
                    <div class="task-head">
                        <h5>{{$record->title}}</h5>
                    </div>
                    <div class="task-body">
                    <p>{{$record->description}}</p>
                    </div>
                </div>
                @if($record->id==2)
                    <a href='{{route('user.category')}}' class="button btn-red">@lang('site.go_to_library')</a>
                @elseif($record->id==3)
                    <a href='{{route('user.ads')}}' class="button btn-red">@lang('site.go_to_ads')</a>
                @endif
            </div>
            <div class="col-md-5">
            <div class="box-det">
                <div class="task-head">
                <h5>@lang('site.task_preview')</h5>
                </div>
                <div class="task-body">
                    <div class="mac-wrap">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/mac@2x.png" alt="">
                        @if($record->media_type=='image')
                            <img class="ad" src="{{$record->media_url}}" alt="">
                        @else
                            <video
                                x-data
                                x-on:ended="
                                    $.ajax({
                                        url:'{{route('user.complete_task',$record->id)}}',
                                        dataType:'JSON',
                                        success:function(){
                                            setTimeout(function(){
                                                window.location.href='{{route('user.tasks')}}';
                                            },1500);

                                        }
                                    });
                                "
                                class='ad'
                                src="{{$record->media_url}}"
                                controls
                                autoplay
                                style='max-width:100%'>
                            </video>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</main>
@endsection
