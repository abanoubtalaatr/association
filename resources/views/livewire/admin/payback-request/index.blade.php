<main
    x-data
    x-on:alert-error.window="
        $('#'+$event.detail.alert_id).find('span').text($event.detail.message);
        $('#'+$event.detail.alert_id).fadeIn();
        setTimeout(
            function(){

                $('#'+$event.detail.alert_id).fadeOut();
            },2000);"
    x-on:alert-success.window="

        $('#'+$event.detail.alert_id).find('span').text($event.detail.message);
        $('#'+$event.detail.alert_id).fadeIn();
        setTimeout(function(){
            $('#'+$event.detail.alert_id).fadeOut();
            $('#'+$event.detail.modal_id).modal('hide');
        },2000);
        "
    class="main-content"
>
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
                        <label for="status-select">@lang('site.status')</label>
                        <select wire:model='status' id='status-select' class="form-control  contact-input">
                            <option value>@lang('site.status')</option>
                            <option value="paid">@lang('site.paid')</option>
                            <option value="not_paid">@lang('site.not_paid')</option>
                            <option value="canceled">@lang('site.canceled')</option>
                        </select>
                    </div>

                    <div class="form-group col-3">
                        <label for="status-select">@lang('messages.payment_method')</label>
                        <select wire:model='payment_method' id='status-select' class="form-control  contact-input">
                            <option value>@lang('messages.payment_method')</option>
                            <option value="stc">STC Pay</option>
                            <option value="paypal">Paypal</option>
                        </select>
                    </div>


                </div>

                @if(count($records))
                    <table class="table-page table">
                        <thead>
                        <tr>
                            <th>@lang('site.soldier')</th>
                            <th>@lang('messages.payment_method')</th>
                            <th>@lang('validation.attributes.payment_number')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.amount')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.request_date')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>{{$record->soldier->username}}</td>
                                <td>{{$record->soldier->payment_method}}</td>
                                <td>{{$record->soldier->payment_number}}</td>
                                <td>{{$record->created_at}}</td>
                                <td>{{$record->amount}}</td>
                                <td>
                                    <div class="status {{$record->status_class}}">
                                        <span>@lang('site.'.$record->status)</span>
                                    </div>
                                </td>
                                <td>{{$record->created_at->format('Y-m-d')}}</td>
                                <td>
                                    <div class="actions">
                                        @if($record->status!='not_paid')
                                            @lang('site.'.$record->status)
                                        @else
                                        <div class="input-group mb-3">
                                            <input size='5' class='form-control @error('transaction_id') is-invalid @enderror' wire:model='transaction_id' aria-describedby="button-addon2"/>
                                            <button wire:click='accept({{$record->id}})' class="btn btn-success btn-sm">@lang('site.accept')</button>
                                        </div>



                                        @endif
                                    </div>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>

                    {{$records->links()}}
                @else
                    <div class="row" style='margin-top:10px'>
                        <div class="alert alert-warning">@lang('site.no_data_to_display')</div>
                    </div>
                @endif
            </div>
        </div>

    <!-- Accept Modal -->
    <div wire:ignore.self class="modal fade" id="request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('site.are_you_sure_you_wanna_accept_request')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <h3>@lang('site.request_id'): <span class="badge">{{optional($current_request)->id}}</span></h3>

                    <div class="alert alert-success" id='control-request-success' style='display:none'><span></span></div>
                    <div class="alert alert-danger" id='control-request-error' style='display:none'><span></span></div>

                    <h3>@lang('site.are_you_sure_you_wanna_accept_request')</h3>
                    <p class='text-danger'>@lang('site.this_action_cant_be_undone')</p>


                    <table class="table">
                        <tr>
                            <td class="text-bold">@lang('site.request_id')</td>
                            <td class="text-center">{{optional($current_request)->id}}</td>
                        </tr>

                        <tr>
                            <td class="text-bold">@lang('site.created_at')</td>
                            <td class="text-center">{{ optional($current_request)->created_at}}</td>
                        </tr>

                        <tr>
                            <td class="text-bold">@lang('site.soldier')</td>
                            <td class="text-center">{{optional(optional($current_request)->soldier)->username}}</td>
                        </tr>

                        <tr>
                            <td class="text-bold">@lang('messages.payment_method')</td>
                            <td class="text-center">{{optional(optional($current_request)->soldier)->payment_method}}</td>
                        </tr>

                        <tr>
                            <td class="text-bold">@lang('validation.attributes.payment_number')</td>
                            <td class="text-center">{{optional(optional($current_request)->soldier)->payment_number}}</td>
                        </tr>

                        <tr>
                            <td class="text-bold">@lang('site.amount')</td>
                            <td class="text-center">{{optional($current_request)->amount}} @lang('site.sar_short')</td>
                        </tr>
                    </table>

                     <div class="form-group">
                        <label for="">@lang('validation.attributes.transaction_id')</label>
                        <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" wire:model.defer='transaction_id'/>
                        @error('transaction_id') <p class="text-danger">{{$message}}</p>@enderror
                    </div>

                    <button type="button" wire:click.prevent="accept()" class="btn btn-success" >@lang('site.accept_request')</button>
                    <button type="button" wire:click.prevent="refuse()" class="btn btn-danger" >@lang('site.refuse_request')</button>


                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


</main>
