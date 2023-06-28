<div>
    <form wire:submit.prevent='check' class="mb-5">

        <input wire:model='discount_code'
               class="@error('discount_code') is-invalid @enderror form-control contact-input"
               type="text" placeholder="@lang('validation.attributes.discount_code')">
        @error('discount_code') <p class="text-danger">{{$message}}</p> @enderror
        @if(session()->has('error_message_for_discount_code'))
            <p class="text-danger mt-2">{{session()->get('error_message_for_discount_code')}}</p>
        @endif

        @if(session()->has('valid_message_for_discount_code'))
            <p class="text-success mt-2">{{session()->get('valid_message_for_discount_code')}}</p>
        @endif
        @if(session()->has('valid_message_for_discount_code'))
            @lang('general.ad_before_discount') : <input type="text" class="border-none" style="border: none;
    background: transparent;" disabled wire:model="adBeforeDiscount">

            : @if(isset($adAfterDiscount)) <p>  @lang('general.ad_after_discount') : {{$adAfterDiscount}}</p>@endif
        @endif
        <hr>

        <div class="btns    ">
            {{-- <button class="button btn-border big">@lang('site.cancel')</button> --}}
            {{-- {{$errors}} --}}
            <button type='submit' class="button btn-success">@lang('general.check_discount_code')</button>
        </div>

    </form>
</div>
