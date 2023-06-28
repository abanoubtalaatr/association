@section('content')
    <main class="main-content">
        <x-user.head/>
        <!--ads-->
        <div class="border-div">
            <div class="row">
                @foreach($records as $record)
                    <div class="col-md-4" onclick="window.location.href='{{route('user.library.show',$record)}}'">
                        <div class="lib-ad text-center">
                            <div class="lib-img" style="position: relative;">
                                <img
                                    style='position: absolute;top: 0;bottom: 0;right: 0;left: 0;max-width: 100%;max-height: 100%;margin: auto;'
                                    src="{{$record->video_thumbnail_url}}" alt="">
                            </div>
                            <h5>{{$record->title }}</h5>
                            {{-- <p class="grey">Jonathan Downing</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
