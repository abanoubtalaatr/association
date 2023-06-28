<!-- start benfits -->
<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head text-center head-shape">
                    <h2>@lang('site.benifits')</h2>
                    <p>@lang('site.we_have_benifit')</p>
                </div>
            </div>
            @foreach($pages as $page)
                <div class="col-lg-4">
                    <div class="benfits text-center">
                        <img src="{{$page->picture_url}}" alt="">
                        <h3>{{$page->{"title_".app()->getLocale()} }}</h3>
                        <p>{{$page->{"desc_".app()->getLocale()} }}</p>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>
