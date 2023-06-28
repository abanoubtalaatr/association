<main class="main-content">
          <!--head-->
          <x-user.head/>
          <!--table-->
          <div class="border-div">
            <div class="b-btm flex-div-2">
              <h4>{{$page_title}}</h4>
              <a style='text-align:center' href='{{route('user.create_ad')}}' class="button btn-red big">@lang('site.create_ad')</a>
            </div>
            <div class="table-page-wrap">

                <div class="row">
                    <div class="form-group col-3">
                        <label for="status-select">@lang('messages.Ad_Title')</label>
                        <input wire:model='title' type="text" class="form-control contact-input">
                    </div>


                    <div class="form-group col-3">
                        <label for="status-select">@lang('site.status')</label>
                        <select wire:model='status' id='status-select' class="form-control  contact-input">
                            <option value>@lang('site.status')</option>
                            <option value="unpaid">@lang('site.unpaid')</option>
                            <option value="active">@lang('site.active')</option>
                            <option value="reviewing">@lang('site.reviewing')</option>
                            <option value="finished">@lang('site.finished')</option>
                        </select>
                    </div>

                    <div class="form-group  col-3">
                        <label for="campagin-select">@lang('validation.attributes.campagin_id')</label>
                        <select wire:model='camp_id' id='campagin-select' class="form-control  contact-input">
                            <option value>@lang('validation.attributes.campagin_id')</option>
                            @foreach($camps as $camp)
                                <option value="{{$camp->id}}">{{$camp->title}}</option>
                            @endforeach
                        </select>
                    </div>


                </div>

                @if(count($records))
                <div class="table-responsive">
                    <table class="table-page table">
                        <thead>
                        <tr>
                            <th>@lang('messages.Ad_Title')</th>
                            {{-- <th>@lang('messages.description')</th> --}}
                            <th>@lang('validation.attributes.campagin_id')</th>
                            <th>@lang('site.clicks')</th>
                            @if(auth('users')->user()->user_type=='advertiser')
                                <th>@lang('site.budget')</th>
                            @endif
                            <th>@lang('site.status')</th>
                            <th>@lang('validation.attributes.start_date')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td><a class="decor" href="{{route('user.show_ad',$record->id)}}">{{$record->title}}</a></td>
                                {{-- <td>{{$record->short_description}}</td> --}}
                                <td>{{$record->camp->title}}</td>
                                <td>{{$record->clicks_count}}</td>
                                @if(auth('users')->user()->user_type=='advertiser')
                                    <td>{{$record->remaining_budget}} / {{$record->budget}}</td>
                                @endif

                                <td>
                                    <div class="status {{$record->status_class}}">
                                        <span>@lang('site.'.$record->status)</span>
                                    </div>
                                </td>
                                <td>{{$record->start_date}}</td>
                                <td>
                                    <div class="actions">
                                        @if($record->status=='unpaid')
                                            <a href="{{route('user.edit_ad',$record)}}" class='no-btn'><i class="far fa-edit blue"></i></a>
                                        @else
                                            <a href="{{route('user.ad_stats',$record)}}" class='no-btn'><i class="far fa-chart-bar green"></i></a>
                                        @endif

                                        @if($record->status !='inactive')
                                            <button
                                                wire:click='deactivate({{$record->id}})'
                                                class="no-btn">
                                                <i class="fas @if($record->status=='inactive') fa-lock red @else fa-unlock green @endif"></i>
                                            </button>
                                        @endif

                                    </div>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>

                    {{$records->links()}}
                </div>
                @else
                    <div class="row" style='margin-top:10px'>
                        <div class="alert alert-warning">@lang('messages.no_ads')</div>
                    </div>
                @endif
            </div>
          </div>
        </main>
