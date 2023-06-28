 <!-- start join section -->
        <section class="join">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-head text-center">
                            <h2>@lang('site.where_to_start')</h2>
                            <p>@lang('site.where_to_start_desc')</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="join-card">
                            <img src="{{asset('assets_'.app()->getLocale())}}/images/1.png" alt="">
                            <h3>@lang('site.i_am_a_soldier').</h3>
                            <p>{{$settings->{"i_am_publisher_".app()->getLocale()} }}</p>
                            <a href="{{route('user.register_form')}}" class="btn btn-1 float-end">@lang('site.join_team') <i class="fa-solid fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="join-card">
                            <img src="{{asset('assets_'.app()->getLocale())}}/images/2.png" alt="">
                            <h3>@lang('site.i_am_an_advertiser')</h3>
                            <p>{{$settings->{"i_am_advertiser_".app()->getLocale()} }}</p>
                            <a href="{{route('user.register_form')}}" class="btn btn-1 float-end">@lang('site.join_team') <i class="fa-solid fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
