<ul class="navbar-nav mx-auto">
    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{url('/')}}">@lang('general.home')</a></li>
    {{-- @foreach($pages as $page)
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('show_page',$page)}}">{{$page->{"title_".app()->getLocale()} }}</a></li>
    @endforeach --}}
    <li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">@lang('site.contact_us')</a></li>
</ul>
