<!-- start clients -->
        <section class="clients">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-head text-center head-shape">
                            <h2>@lang('site.our_clients')</h2>
                            {{-- <p>@lang('site.you_can_be_the_first')</p> --}}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="responsive">
                            @foreach($partners as $partner)
                                <a href="#">
                                    <img src="{{$partner->picture_url}}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </section>
