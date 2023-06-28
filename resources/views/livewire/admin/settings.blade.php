<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="edit-c">
            <form wire:submit.prevent='update'>
                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.email')</label>
                        <input wire:model='form.email' placeholder="@lang('validation.attributes.email')"
                               class="@error('form.email') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.email') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.address')</label>
                        <input wire:model='form.address' placeholder="@lang('validation.attributes.address')"
                               class="@error('form.address') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.address') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.mobile')</label>
                        <input wire:model='form.mobile' placeholder="@lang('validation.attributes.mobile')"
                               class="@error('form.mobile') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.mobile') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.website_link')</label>
                        <input wire:model='form.website_link' placeholder="@lang('validation.attributes.website_link')"
                               class="@error('form.website_link') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.website_link') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.facebook')</label>
                        <input wire:model='form.facebook' placeholder="@lang('validation.attributes.facebook')"
                               class="@error('form.facebook') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.facebook') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.instagram')</label>
                        <input wire:model='form.instagram' placeholder="@lang('validation.attributes.instagram')"
                               class="@error('form.instagram') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.instagram') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.twitter')</label>
                        <input wire:model='form.twitter' placeholder="@lang('validation.attributes.twitter')"
                               class="@error('form.twitter') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.twitter') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                {{-- <div class="row">
                   <div class="col-6">
                       <label for="">@lang('validation.attributes.publisher_video')</label>
                       <input wire:model='form.publisher_video'  placeholder="@lang('validation.attributes.publisher_video')" class="@error('form.publisher_video') is-invalid @enderror form-control contact-input" type="text"/>
                       @error('form.publisher_video') <p class="text-danger">{{$message}}</p> @enderror
                       <hr/>
                   </div>

                   <div class="col-6">
                       <input wire:model='form.advertiser_video'  placeholder="@lang('validation.attributes.advertiser_video')" class="@error('form.advertiser_video') is-invalid @enderror form-control contact-input" type="text"/>
                       @error('form.advertiser_video') <p class="text-danger">{{$message}}</p> @enderror
                       <hr/>
                   </div>
               </div> --}}

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.google_play')</label>
                        <input wire:model='form.google_play' placeholder="@lang('validation.attributes.google_play')"
                               class="@error('form.google_play') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.google_play') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.app_store')</label>
                        <input wire:model='form.app_store' placeholder="@lang('validation.attributes.app_store')"
                               class="@error('form.app_store') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.app_store') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.lat')</label>
                        <input wire:model='form.lat' placeholder="@lang('validation.attributes.lat')"
                               class="@error('form.lat') is-invalid @enderror form-control contact-input" type="text"/>
                        @error('form.lat') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.lng')</label>
                        <input wire:model='form.lng' placeholder="@lang('validation.attributes.lng')"
                               class="@error('form.lng') is-invalid @enderror form-control contact-input" type="text"/>
                        @error('form.lng') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.ad_min_budget')</label>
                        <input wire:model='form.ad_min_budget'
                               placeholder="@lang('validation.attributes.ad_min_budget')"
                               class="@error('form.ad_min_budget') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.ad_min_budget') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.ad_click_price')</label>
                        <input wire:model='form.ad_click_price'
                               placeholder="@lang('validation.attributes.ad_click_price')"
                               class="@error('form.ad_click_price') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.ad_click_price') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.soldier_ad_click_price')</label>
                        <input wire:model='form.soldier_ad_click_price'
                               placeholder="@lang('validation.attributes.soldier_ad_click_price')"
                               class="@error('form.soldier_ad_click_price') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.soldier_ad_click_price') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <label>@lang('validation.attributes.ad_click_price_currency')</label>
                        <select wire:model='form.ad_click_price_currency'
                                class="form-control @error('form.ad_click_price_currency') is-invalid @enderror">
                            <option value="sar">@lang('site.sar_short')</option>
                            <option value="usd">@lang('site.usd')</option>
                        </select>
                        @error('form.ad_click_price_currency') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">@lang('validation.attributes.min_ad_view_duration')</label>
                        <input wire:model='form.min_ad_view_duration'
                               placeholder="@lang('validation.attributes.min_ad_view_duration')"
                               class="@error('form.min_ad_view_duration') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.min_ad_view_duration') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-4">
                        <label for="">@lang('validation.attributes.solider_ad_max_profit')</label>
                        <input wire:model='form.solider_ad_max_profit'
                               placeholder="@lang('validation.attributes.solider_ad_max_profit')"
                               class="@error('form.solider_ad_max_profit') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.solider_ad_max_profit') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-4">
                        <label for="">@lang('validation.attributes.minimum_payback_amount')</label>
                        <input wire:model='form.minimum_payback_amount'
                               placeholder="@lang('validation.attributes.minimum_payback_amount')"
                               class="@error('form.minimum_payback_amount') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.minimum_payback_amount') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.mission_ar')</label>
                        <textarea wire:model='form.mission_ar' placeholder="@lang('validation.attributes.mission_ar')"
                                  class="@error('form.mission_ar') is-invalid @enderror form-control contact-input"></textarea>
                        @error('form.mission_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.mission_en')</label>
                        <textarea wire:model='form.mission_en' placeholder="@lang('validation.attributes.mission_en')"
                                  class="@error('form.mission_en') is-invalid @enderror form-control contact-input"></textarea>
                        @error('form.mission_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.vision_ar')</label>
                        <textarea wire:model='form.vision_ar' placeholder="@lang('validation.attributes.vision_ar')"
                                  class="@error('form.vision_ar') is-invalid @enderror form-control contact-input"></textarea>
                        @error('form.vision_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.vision_en')</label>
                        <textarea wire:model='form.vision_en' placeholder="@lang('validation.attributes.vision_en')"
                                  class="@error('form.vision_en') is-invalid @enderror form-control contact-input"></textarea>
                        @error('form.vision_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                    <div class="col-6">
                        <label
                            for="">@lang('validation.attributes.number_of_days_will_send_notification_to_solider')</label>
                        <input wire:model='form.number_of_days'
                               placeholder="@lang('validation.attributes.number_of_days_will_send_notification_to_solider')"
                               class="@error('form.number_of_days') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.number_of_days') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

{{--                    <div class="col-6">--}}
{{--                        <label for="">@lang('validation.attributes.library_visit_price')</label>--}}
{{--                        <input wire:model='form.library_visit_price'--}}
{{--                               placeholder="@lang('validation.attributes.library_visit_price')"--}}
{{--                               class="@error('form.library_visit_price') is-invalid @enderror form-control contact-input"--}}
{{--                               type="text"/>--}}
{{--                        @error('form.library_visit_price') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                        <hr/>--}}
{{--                    </div>--}}

{{--                    <div class="col-6">--}}
{{--                        <label for="">@lang('validation.attributes.library_max_profit')</label>--}}
{{--                        <input wire:model='form.library_max_profit'--}}
{{--                               placeholder="@lang('validation.attributes.library_max_profit')"--}}
{{--                               class="@error('form.library_max_profit') is-invalid @enderror form-control contact-input"--}}
{{--                               type="text"/>--}}
{{--                        @error('form.library_max_profit') <p class="text-danger">{{$message}}</p> @enderror--}}

{{--                    </div>--}}
                </div>
                <hr>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.solider_whats_app_message')</label>
                        <textarea wire:model='form.solider_whats_app_message'
                                  placeholder="@lang('validation.attributes.solider_whats_app_message')"
                                  class="@error('form.solider_whats_app_message') is-invalid @enderror form-control contact-input"></textarea>
                        @error('form.solider_whats_app_message') <p class="text-danger">{{$message}}</p> @enderror

                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.solider_whats_app_file')</label>
                        <input type="file" wire:model="pdfFile">
                        @if($this->settings['solider_whats_app_file'])
                            <div class="flex">
                            <a target="_blank" class="d-block w-50 text-center button btn-info my-2"
                               href="{{url('uploads/pics/'.$this->settings['solider_whats_app_file'])}}">@lang('site.watch_the_file')</a>

                            <button type="button" class="d-block w-50  text-center button btn-danger my-2" wire:click="deleteSoliderFile">@lang('site.delete_the_file')</button>
                            </div>
                        @endif
                        <div class="progress" wire:loading>
                            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                        </div>
                        @error('pdfFile') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <hr>


                <div class="row mb-3">
                    <button class="btn btn-danger"> @lang('site.app')</button>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('site.latest_android_version')</label>
                        <input wire:model='form.latest_android_version'
                               placeholder="@lang('site.latest_android_version')"
                               class="@error('form.latest_android_version') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.latest_android_version') <p class="text-danger">{{$message}}</p> @enderror

                    </div>

                    <div class="col-6">
                        <label for="">@lang('site.latest_ios_version')</label>
                        <input wire:model='form.latest_ios_version'
                               placeholder="@lang('site.latest_ios_version')"
                               class="@error('form.latest_ios_version') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.latest_ios_version') <p class="text-danger">{{$message}}</p> @enderror

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('site.app_status')</label>
                        <div class="form-group ">
                            <select wire:model='form.app_status' id='status-select' class="form-control  contact-input">
                                <option value>@lang('site.status')</option>
                                <option value="active">@lang('site.active')</option>
                                <option value="inactive">@lang('site.inactive')</option>
                            </select>
                        </div>
                        @error('form.app_status') <p class="text-danger">{{$message}}</p> @enderror

                    </div>

                    <div class="col-6">
                        <label for="">@lang('site.app_inactive_message')</label>
                        <input wire:model='form.app_inactive_message'
                               placeholder="@lang('site.app_inactive_message')"
                               class="@error('form.app_inactive_message') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.app_inactive_message') <p class="text-danger">{{$message}}</p> @enderror

                    </div>
                </div>
                <hr>

                <div class="row mt-5">
                    <div class="col-12">
                        <button type='button' wire:click="logoutAllMobileUsers()"
                                class="button btn-red big">@lang('site.logout_all_users')</button>
                    </div>
                    <hr class="mt-3">
                </div>
                <div class="btns text-center d-block mt-4">
                    <button type='submit' class="button btn-red big">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>
</main>
<script>
    document.addEventListener('livewire-upload-progress', event => {
    @this.progress = Math.floor(event.detail.progress);
    });
</script>
