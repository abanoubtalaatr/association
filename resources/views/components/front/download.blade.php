<!-- start download section -->
        <section class="download">
            <div class="container">
                <div class="row flex-sm-row-reverse-x">
                    <div class="col-lg-5">
                        <div class="down-info mt-lg-5 pt-lg-5">
                            <h2>@lang('site.download_our_app_now')</h2>
                            <p>@lang('site.the_rise')</p>
                            <ul class="down-list d-flex">
                                <li><a href="{{$settings->google_play}}"><img src="{{asset('assets_'.app()->getLocale())}}/images/badge-play.png" alt=""></a></li>
                                <li><a href="{{$settings->app_store}}"><img src="{{asset('assets_'.app()->getLocale())}}/images/badge-store.png" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="down-box">
                            <img src="{{asset('assets_'.app()->getLocale())}}/images/download.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
