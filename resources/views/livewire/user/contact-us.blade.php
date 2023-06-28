<main class="main-content">
    <!--head-->

    <x-user.head/>

    <!--details-->
    <div class="border-div">
        <div class="contact-det">
            <div class="contact-head">
                <div class="contact-imgs">
                    <div class="back-img"><img
                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/contact/contact-head@2x.png"
                            alt=""></div>
                    <div class="contact-user"><img
                            src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/contact/contact-user@2x.png"
                            alt="">
                        <h5>@lang('site.contact_info')</h5>
                        <p class="grey">@lang('site.you_can_contact_us_anytime')</p>
                    </div>
                </div>
                <div class="more-det">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact"><i class="fas fa-map-marker-alt"></i>
                                <h6>{{$settings->address??"Saudi Arabia"}}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact"><i class="fas fa-envelope"></i>
                                <h6>{{$settings->email??""}}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact"><i class="fas fa-phone-alt"></i>
                                <h6>{{$settings->mobile??""}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-msg">

            <div x-data="{show_success_message:@entangle('success_message')}"
                 x-on:scroll-to-top.window="window.scroll({top: 0,left: 0,behavior: 'smooth'});console.log('scrolled');"
                 x-show="show_success_message" class="alert alert-success">
                {{$this->success_message}}
            </div>


            <h4>@lang('site.send_us')</h4>
            <p>@lang('site.you_can_contact_us_anytime')</p>
            <div class="row">
                <div class="col-md-7">
                    <form wire:submit.prevent='store'>
                        <input wire:model='form.sender_name'
                               class="@error('form.sender_name') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.sender_name')"/>
                        @error('form.sender_name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr>

                        <input wire:model='form.sender_email'
                               class="@error('form.sender_email') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.sender_email')">
                        @error('form.sender_email') <p class="text-danger">{{$message}}</p> @enderror
                        <hr>

                        <textarea wire:model='form.message'
                                  class="@error('form.message') is-invalid @enderror form-control contact-input"
                                  placeholder="@lang('site.content')" rows="5"></textarea>
                        @error('form.message') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>

                        <div class="row justify-content-center">
                            <div class="col-10">
                                <button type='submit' class="button btn-red full">@lang('site.send')</button>
                            </div>
                        </div>
                    </form>
                </div><!-- col-md-7-->
                <div class="col-md-5" wire:ignore>
                    <div class="map-wrap">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
