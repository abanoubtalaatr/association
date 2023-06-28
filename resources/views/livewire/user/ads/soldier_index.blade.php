@section('content')
    <main class="main-content">
        <x-user.head/>
        <!--ads-->
        <div class="border-div">
            <div class="row">
                @if($error_message)
                    <div class="alert alert-danger">
                        {{$error_message}}
                    </div>
                @else
                    @if(count($records))
                        @foreach($records as $record)
                            <div class="col-md-4" onclick="window.location.href='{{route('user.show_ad',$record)}}'">
                                <div class="lib-ad text-center">
                                    <div class="lib-img" style="position: relative;">
                                        <img
                                        style='position: absolute;top: 0;bottom: 0;right: 0;left: 0;max-width: 100%;max-height: 100%;margin: auto;'
                                        src="{{$record->whatsapp_thumbnail_url}}" alt="">
                                    </div>
                                    <h5>{{$record->title }}</h5>
                                </div>
                            </div>
                        @endforeach
                    @else
                            <div class="alert alert-warning">
                                @lang('site.no_ads')
                            </div>
                    @endif
                @endif



            </div>
        </div>
    </main>
@endsection
