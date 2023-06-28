 <main class="main-content">
          <!--modal-->
          <div class="div modal fade" id="delete-modal" wire:ignore x-data @hide-modal.window="$('#delete-modal').modal('hide');">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                    <img src="{{asset('frontAssets/imgs/home/alert.svg')}}"/>
                    <h5>@lang('general.are_you_sure')</h5>
                  <div class="btns">
                    <button class="button btn-border" onclick="$('#delete-modal').modal('hide');">@lang('site.no')</button>
                    <button class="button btn-red" wire:click='destroy'>@lang('site.yes')</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--head-->
         <x-user.head/>
          <!--table-->
          <div class="border-div">
            <div class="b-btm flex-div-2">
              <h4>{{$page_title}}</h4>
              <a style='text-align:center' href='{{route('user.create_camp')}}' class="button btn-red big">@lang('site.create_camp')</a>
            </div>
            <div class="table-page-wrap">
            @if(count($records))
              <table class="table-page table">
                <thead>
                  <tr>
                    <th>@lang('site.title')</th>
                    <th>@lang('site.status')</th>
                    <th>@lang('validation.attributes.type')</th>
                    <th>@lang('site.clicks')</th>
                    <th>@lang('validation.attributes.budget')</th>
                    <th>@lang('site.ads')</th>
                    <th>@lang('site.actions')</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td><a class="decor" href="{{route('user.ads')}}?camp_id={{$record->id}}">{{$record->title}}</a></td>
                        <td>
                            <div class='status @if($record->status=='active') green @else  red @endif'>
                                <span>
                                    @lang('site.'.$record->status)
                                </span>
                            </div>
                        </td>
                        <td>{{$record->type}}</td>
                        <td>
                            <div class="status yellow"><span>{{$record->total_clicks}}</span></div>
                        </td>
                        <td>
                            <div class="status green"><span>{{$record->total_budget}} @lang('site.sar_short')</span></div>
                        </td>
                        <td>
                        <div class="status grey"><span>{{$record->ads_count}}</span></div>
                        </td>
                        <td>
                        <div class="actions">
                            <a class="no-btn" href='{{route('user.edit_camp',$record)}}'><i class="far fa-edit blue"></i></a>
                            @if($record->status=='active')
                                <button
                                    wire:click='setCurrentCamp({{$record->id}})'
                                    class="no-btn" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fas fa-lock red"></i></button>
                            @endif
                        </div>
                        </td>
                    </tr>
                    @endforeach
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
