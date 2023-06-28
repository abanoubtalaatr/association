<div class="box-shad payment">
    <form wire:submit.prevent='store'>
        <h5>@lang('validation.attributes.payment_method')</h5>
        <div class="row">
            <div class="col-md-4">
                <select wire:model='payment_method' class="@error('payment_method') is-invalid @enderror form-control contact-input">
                    <option>@lang('site.select_payment_method')</option>
                    @foreach($payment_methods as $payment_method)
                        <option value="{{$payment_method}}">@lang('site.'.$payment_method)</option>
                    @endforeach
                </select>
                @error('payment_method') <p class="text-danger">{{$message}}</p> @enderror
            </div>

            <div class="col-md-4">
                <input wire:model='payment_number' class="@error('payment_number') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.payment_number')"/>
                @error('payment_number') <p class="text-danger">{{$message}}</p> @enderror
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <button type='submit' class="button btn-red big">@lang('site.update')</button>
                </div>
            </div>
        </div>
    </form>
</div>
