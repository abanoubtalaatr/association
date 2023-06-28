 <main class="main-content">
          <!--head-->
          <x-admin.head/>
          <!--table-->
          <div class="border-div">
            <div class="b-btm flex-div-2">
              <h4>{{$page_title}}</h4>
            </div>
            <div class="table-page-wrap">

                <div class="row">
                    <div class="form-group col-3">
                        <label for="status-select">@lang('messages.Ad_Title')</label>
                        <input wire:model='ad_title' type="text" class="form-control contact-input">
                    </div>
                </div>

                @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th>@lang('messages.Ad_Title')</th>
                        <th>@lang('validation.attributes.campagin_id')</th>
                        <th>@lang('site.clicks')</th>
                        <th>@lang('site.status')</th>
                        <th>@lang('validation.attributes.start_date')</th>
                        <th>@lang('site.details')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>
                            <td><a class="decor" href="{{route('admin.show_ad',$record->ad->id)}}">{{$record->ad->title}}</a></td>
                            <td>{{$record->ad->camp->title}}</td>
                            <td>{{\App\Services\StatsService::totalClicks($record->ad, $user)}}</td>
                            <td>
                                <div class="status {{$record->ad->status_class}}">
                                    <span>@lang('site.'.$record->ad->status)</span>
                                </div>
                            </td>
                            <td>{{$record->ad->start_date}}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{route('admin.user_ad_stats',[$user,$record->ad])}}" class='no-btn'><i class="far fa-chart-bar green"></i></a>
                                </div>
                            </td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>

                {{$records->links()}}
                @else
                    <div class="row" style='margin-top:10px'>
                        <div class="alert alert-warning">@lang('messages.no_ads')</div>
                    </div>
                @endif
            </div>
          </div>
        </main>
