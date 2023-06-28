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

            <table class='table table-responsive'>
                <tr>
                    <td class='text-bold'>@lang('site.id')</td>
                    <td>{{$paybackRequest->id}}</td>

                    <td class='text-bold'>@lang('site.created_at')</td>
                    <td>{{$paybackRequest->created_at}}</td>
                </tr>

                <tr>
                    <td class='text-bold'>@lang('site.soldier')</td>
                    <td>{{$paybackRequest->soldier->username}}</td>

                    <td class='text-bold'>@lang('site.amount')</td>
                    <td>{{$paybackRequest->amount}}</td>
                </tr>

                <tr>
                    <td class='text-bold'>@lang('validation.attributes.payment_method')</td>
                    <td>{{$paybackRequest->soldier->payment_method}}</td>

                    <td class='text-bold'>@lang('validation.attributes.payment_number')</td>
                    <td>{{$paybackRequest->soldier->payment_number}}</td>
                </tr>


            </table>

            <form wire:submit.prevent='store'>
                <div class="form-group">
                    <label for="transaction_id">@lang('validation.attributes.transaction_id')</label>
                    <input wire:model='form.transaction_id' type="text" class="form-control @error('form.transaction_id') is-invalid @enderror" id='transaction_id'>
                     @error('form.transaction_id') <p class="text-danger">{{$message}}</p> @enderror
                </div>
                <button class="btn btn-success" wire:click='store'>@lang('site.save')</button>
            </form>

        </div>
    </div>
    </div>
</main>
