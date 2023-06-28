<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="edit-c">
            <form wire:submit.prevent='store'>
                <div class="row">
                    <div class="col-6">
                        <input wire:model='form.line1_ar'
                               class="@error('form.line1_ar') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.line1_ar')"/>
                        @error('form.line1_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <input wire:model='form.line1_en'
                               class="@error('form.line1_en') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.line1_ar')"/>
                        @error('form.line1_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <input wire:model='form.line2_ar'
                               class="@error('form.line2_ar') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.line2_ar')"/>
                        @error('form.line2_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <input wire:model='form.line2_en'
                               class="@error('form.line2_en') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.line2_en')"/>
                        @error('form.line2_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <input wire:model='form.line3_ar'
                               class="@error('form.line3_ar') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.line3_ar')"/>
                        @error('form.line3_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input wire:model='form.line3_en'
                               class="@error('form.line3_en') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.line3_en')"/>
                        @error('form.line3_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <input wire:model='form.button_text_ar'
                               class="@error('form.button_text_ar') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.button_text_ar')"/>
                        @error('form.button_text_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input wire:model='form.button_text_en'
                               class="@error('form.button_text_en') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.button_text_en')"/>
                        @error('form.button_text_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <input wire:model='form.button_link_ar'
                               class="@error('form.button_link_ar') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.button_link_ar')"/>
                        @error('form.button_link_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input wire:model='form.button_link_en'
                               class="@error('form.button_link_en') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.button_link_en')"/>
                        @error('form.button_link_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <label class="form-check-label" for="isAdmin">
                            {{trans('general.show_banner_in_site')}}
                        </label> :
                        <input wire:model='form.is_active'
                               class="@error('form.is_active') is-invalid @enderror form-check-input form-check-input-lg"
                               type="checkbox" placeholder="@lang('validation.attributes.is_active')"/>
                        @error('form.is_active') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label class="form-check-label" for="is_active_in_mobile">
                            {{trans('general.show_banner_in_app')}}
                        </label> :
                        <input wire:model='form.is_active_in_mobile'
                               class="@error('form.is_active_in_mobile') is-invalid @enderror form-check-input form-check-input-lg"
                               type="checkbox" placeholder="@lang('validation.attributes.is_active')"/>
                        @error('form.is_active_in_mobile') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="custom-file-upload">
                        @if($picture)
                            <img style='max-width:100%' src="{{$picture->temporaryUrl()}}" alt="">
                        @else
                            @isset($slider)
                                <img style='max-width:100%' src="{{$slider->picture_url}}" alt="">
                            @endisset
                        @endif
                        <img src="{{asset('frontAssets')}}/imgs/wallet/upload.svg" alt="">
                        <span>@lang('validation.attributes.picture')</span>
                        <input wire:model='picture' class='form-control @error('picture') is-invalid @enderror'
                               type="file"/>
                        @error('picture') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                </div>

                <div class="btns text-center">
                    <button type='submit' class="button btn-red big">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>
</main>
