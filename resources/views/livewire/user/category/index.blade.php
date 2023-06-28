@section('content')
<main class="main-content">
    <!--head-->
    <x-user.head/>
    <!--library-->
    <div class="border-div">
    <div class="row mr-d">
        @foreach($records as $record)
            <div
                class="col-6 col-md-4 col-lg-3"
                onclick="window.location.href='{{route('user.library',$record)}}'"
            >
                <div class="library">
                    <img src="{{url('uploads/pics/'.$record->picture)}}" style='max-width:50px;'>
                    <h5>{{$record->{"title_".app()->getLocale()} }}</h5>
                </div>
            </div>
        @endforeach
        <div class="col-6 col-md-4 col-lg-3">
            <div class="library">
                <h5 class="grey">soon</h5>
            </div>
        </div>
    </div>
    </div>
</main>

@endsection
