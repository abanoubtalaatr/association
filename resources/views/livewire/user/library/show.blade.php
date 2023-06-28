@section('content')
<main class="main-content">
          <!--head-->
         <x-user.head/>
{{--    {{dd($link_new_lines)}}--}}
          <!--ad-->
          <div class="border-div">
            <div class="row">
              <div class="col-md-7">
                <div class="box-det">
                  <div class="task-head">
                    <h5>{{$record->title}}</h5>
                  </div>
                  <div class="task-body">
                    {{$record->description}}
                  </div>
                </div>
                <div class="btns" x-data="{link:'{{$link}}', link_new_lines:$('#copy-link-div').html() }">
                    <button
                        class="button btn-border"
                        x-on:click="
                            navigator.clipboard.writeText($('#copy-link-textarea').val());
                            $('#copy-link-with-data').slideDown('slow');">
                        @lang('site.copy_link')
                    </button>
                    <a href='https://api.whatsapp.com/send?text={{$record->title}}{{$record->description}}%0A %0A{{route('show_library',[$record,auth()->user()->utm])}}' class="button btn-green">
                        <img src="{{asset('frontAssets/imgs/library/whatsapp.svg')}}" alt="">@lang('site.share_on_whatsapp')
                    </a>
                </div>


                <div class="box-det" id='copy-link-with-data' style='display:none;margin-top:10px;'>
                  <div class="task-head">
                    <h5>@lang('site.share')</h5>
                  </div>
                  <div class="task-body" id='copy-link-div'>
                    <textarea id="copy-link-textarea" class='d-none' >
                        {{$record->title}}
                        {{$record->description}}
                        {{route('show_library',[$record,auth()->user()->utm])}}
                    </textarea>
                    {{$record->title}} <br><br> {{$record->description}} <br><br> {{route('show_library',[$record,auth()->user()->utm])}}
                  </div>
                </div>


              </div>
              <div class="col-md-5">
                <div class="box-det">
                  <div class="task-head">
                    <h5>@lang('site.media_preview')</h5>
                  </div>
                  <div class="task-body">
                    <div class="mac-wrap">
                        <img src="{{asset('frontAssets/imgs/home/mac@2x.png')}}" alt="">
                        <x-preview.desktop :record="$record"/>
                    </div>
                        {{-- <h6 class="grey">@la</h6> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
@endsection


