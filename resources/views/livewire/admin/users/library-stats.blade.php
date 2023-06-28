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
                  <label for="status-select">@lang('messages.library_Title')</label>
                  <input wire:model='library_Title' type="text" class="form-control contact-input">
              </div>
          </div>

          @if(count($records))
          <table class="table-page table">
              <thead>
              <tr>
                  <th>@lang('messages.library_Title')</th>
                  <th>@lang('site.clicks')</th>
                  <th>@lang('validation.attributes.desc')</th>
                  <th>@lang('site.details')</th>
              </tr>
              </thead>
              <tbody>
                  @foreach($records as $record)
                  <tr>
                      <td><a class="decor" href="{{route('admin.library.edit',$record->id)}}">{{$record->title}}</a></td>
                      <td>{{$record->pivot->visitors_number}}</td>

                      <td>{{$record->short_description}}</td>
                      <td>
                          <div class="actions">
                              <a href="{{route('admin.user_single_library_stats',[$user,$record])}}" class='no-btn'><i class="far fa-chart-bar green"></i></a>
                          </div>
                      </td>
                  @endforeach
                  </tr>
              </tbody>
          </table>

          {{$records->links()}}
          @else
              <div class="row" style='margin-top:10px'>
                  <div class="alert alert-warning">@lang('messages.no_libraries')</div>
              </div>
          @endif
      </div>
    </div>
  </main>
