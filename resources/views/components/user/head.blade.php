<!--head-->
<div class="head-notifi">
    <div id="menu-toggle"><i class="fas fa-bars"></i></div>
    <h3>@isset($page_title) {{$page_title}} @endisset</h3>
    <ul class="notifi-head">
        <li class="notifi-li">
            <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale()=='en' ? 'ar' : 'en')}}">
                <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/{{app()->getLocale()=='en'? 'sa.svg' : 'us.png'}}" alt="">
            </a>
        </li>
    </ul>
</div>
