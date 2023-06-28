  <main class="main-content">
          <x-user.head/>
          <!--table-->
          <div class="border-div">
            <div class="b-btm">
              <h4>{{$page_title}}</h4>
            </div>
            <div class="table-page-wrap">
            @if(count($records))
              <table class="table-page table">
                <thead>
                  <tr>
                    <th>@lang('validation.attributes.ad_title')</th>
                    <th>@lang('messages.payment_method')</th>
                    <th>@lang('validation.attributes.amount')</th>
                    <th>@lang('site.date')</th>
                    <th>@lang('site.card_no')</th>
                    <th>@lang('site.card_holder')</th>
                    <th>@lang('site.payment_status')</th>
                    <th>@lang('validation.attributes.budget')</th>
                    <th>@lang('site.status')</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td>{{$record->title}}</td>
                        <td>{{$record->payment_info->paymentBrand}}</td>
                        <td>{{$record->payment_info->amount}} @lang('site.sar_short')</td>
                        <td>{{date('Y-m-d H:i:s',strtotime($record->payment_info->timestamp))}}</td>
                        <td>{{$record->payment_info->card->bin}}****{{$record->payment_info->card->last4Digits}}</td>
                        <td>{{$record->payment_info->card->holder}}</td>
                        <td>@lang('site.approved')</td>
                        <td>{{$record->budget}} @lang('site.sar_short')</td>
                        <td>@lang('site.'.$record->status)</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

              {{$records->links()}}
                @else
                    <div class="row" style='margin-top:10px'>
                        <div class="alert alert-warning">@lang('messages.no_data_to_display')</div>
                    </div>
                @endif

            </div>
          </div>
        </main>
