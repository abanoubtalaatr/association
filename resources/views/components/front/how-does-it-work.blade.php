<!-- start how it work -->
        <section class="clients bg-none">
            <div class="container">
                <div class="row" style="align-items: center;justify-content: center;">
                    <div class="col-12">
                        <div class="section-head text-center head-shape">
                            <h2>@lang('site.how_does_it_work')</h2>
                            <p>@lang('site.we_have_articles')</p>
                        </div>
                    </div>

                    @foreach($pages as $page)
                        <div class="col-lg-3 col-md-6">
                        
                            <div class="benfits benfits-2 text-center @if($loop->last) none-background  @endif">
                                <img src="{{$page->picture_url}}" alt="">
                                <h3> {{$page->{"title_".app()->getLocale()} }}</h3>
                                <p>{{$page->{"desc_".app()->getLocale()} }}</p>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </section>

        <style>
            .none-background::before{
                background: none
            }
        </style>