<main class="main-content">
    <!--head-->
    <x-user.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="row mt-30">

            <!-- Start ad data-->
            <div class="col-lg-6">
                {{-- {{$errors}} --}}
                <form wire:submit.prevent='store' class='scroll-form'>
                    <div class="ad-new">
                        <div class="ad-form">

                            <div class="form-group">
                                <label for="">@lang('validation.attributes.camp_id')</label>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#create-camp-modal"
                                   class="btn btn-success btn-sm">@lang('site.create_camp')</a>
                                <select wire:model='form.camp_id' id='camp_id'
                                        class="@error('form.camp_id') is-invalid @enderror form-control contact-input">
                                    <option>@lang('site.select_camp')</option>
                                    @foreach($camps as $camp)
                                        <option
                                            {{$camp->id == $form['camp_id']? "selected" : ""}} value="{{$camp->id}}">{{$camp->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('form.camp_id') <p class='text-danger'>{{$message}}</p>@enderror
                            <hr>

                            <label for="">@lang('validation.attributes.title')</label>
                            <input wire:model='form.title'
                                   class="@error('form.title') is-invalid @enderror form-control contact-input"
                                   type="text" placeholder="@lang('validation.attributes.ad_title')">
                            @error('form.title') <p class='text-danger'>{{$message}}</p>@enderror
                            <hr>

                            <label for="">@lang('validation.attributes.short_description')</label>
                            <span wire:ignore>
                                <textarea id='short_description' wire:model='form.short_description'
                                          class="@error('form.short_description') is-invalid @enderror form-control contact-input"
                                          rows="5"
                                          placeholder="@lang('validation.attributes.short_description')"></textarea>
                            </span>
                            @error('form.short_description') <p class='text-danger'>{{$message}}</p>@enderror
                            <hr>

                            @lang('validation.attributes.content')
                            <span wire:ignore>
                                <textarea id='ad_content' wire:model='form.content'
                                          class="@error('form.content') is-invalid @enderror form-control contact-input"
                                          rows="5" placeholder="@lang('validation.attributes.ad_content')"></textarea>
                            </span>
                            @error('form.content') <p class='text-danger'>{{$message}}</p>@enderror
                            <hr>
                        </div>

                        <div class="ad-form">
                            <div class="contact-group date" data-provide="datepicker">
                                <label>@lang('validation.attributes.start_date')</label>
                                <input wire:model='form.start_date'
                                       class="@error('form.start_date') is-invalid @enderror form-control" type="date"
                                       placeholder="@lang('validation.attributes.start_date')">
                                @error('form.start_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr>


                            <div class="contact-group date" data-provide="datepicker">
                                <label>@lang('validation.attributes.start_time')</label>
                                <input wire:model='form.start_time'
                                       class="@error('form.start_time') is-invalid @enderror form-control" type='time'
                                       placeholder="@lang('validation.attributes.start_time')">
                                @error('form.start_time') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr>


                            <div class="form-group contact-group">
                                <input wire:model='form.budget'
                                       class="@error('form.start_date') is-invalid @enderror form-control" type="text"
                                       placeholder="@lang('validation.attributes.budget_in_sar')">
                                @error('form.budget') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr>

                            <div class="form-group" wire:ignore>
                                <label for="">@lang('validation.attributes.gender')</label>
                                <br>
                                <input type="checkbox" id="select_all_genders"/>@lang('site.select_all')
                                <br>
                                <select id='ad_genders' wire:model='ad_genders' multiple
                                        class="@error('ad_genders') is-invalid @enderror form-control contact-input  my-select-2">
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">@lang('site.'.$gender->value)</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ad_genders') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <div class="form-group" wire:ignore>
                                <label for="">@lang('validation.attributes.ad_ages')</label>
                                <br>
                                <input type="checkbox" id="select_all_ages"/>@lang('site.select_all')
                                <br>
                                <select id='ad_ages' wire:model='ad_ages' multiple
                                        class="@error('ad_ages') is-invalid @enderror form-control contact-input  my-select-2">
                                    @foreach($ages as $age)
                                        <option value="{{$age->id}}">{{$age->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ad_ages') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <div class="form-group" wire:ignore>
                                <label for="">@lang('validation.attributes.targeted_audiences')</label>
                                <br>
                                <input type="checkbox" id="select_all_targeted_audiences"/>@lang('site.select_all')
                                <br>
                                <select id='ad_targeted_audiences' wire:model='ad_targeted_audiences' multiple
                                        class="@error('ad_targeted_audiences') is-invalid @enderror form-control contact-input  my-select-2">
                                    @foreach($audiences as $aud)
                                        <option value="{{$aud->id}}">{{$aud->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ad_targeted_audiences') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>


                            <div class="form-group" wire:ignore>
                                <label for="">@lang('validation.attributes.ad_countries')</label>
                                <br>
                                <select id='ad_countries' wire:model='ad_countries' multiple
                                        class="@error('ad_countries') is-invalid @enderror contact-input  my-select-2">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ad_countries') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <div class="form-group" wire:ignore>
                                <label for="">@lang('validation.attributes.ad_cities')</label>
                                <br>
                                <input type="checkbox" id="select_all_cities"/>@lang('site.select_all')
                                <br>
                                <select id='ad_cities' wire:model='ad_cities' multiple
                                        class="@error('ad_cities') is-invalid @enderror contact-input  my-select-2">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->{"name_".app()->getLocale()} }}</option>
                                    @endforeach
                                </select>


                            </div>
                            @error('ad_cities') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <div class="form-group" wire:ignore>
                                <label for="">@lang('validation.attributes.ad_languages')</label>
                                <br>
                                <input type="checkbox" id="select_all_languages"/>@lang('site.select_all')
                                <br>
                                <select id='ad_languages' wire:model='ad_languages' multiple
                                        class="@error('ad_languages') is-invalid @enderror form-control contact-input  my-select-2">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ad_languages') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <!-- Upload ad media-->
                            <div class="">
                                <div class="row">
                                    <h3>@lang('validation.attributes.media')</h3>
                                </div>
                                <x-filepond wire:model="media_files"/>
                            </div>

                            <div class="row">
                                <div class="custom-file-upload">
                                    <img src="{{asset('frontAssets')}}/imgs/wallet/upload.svg" alt="">
                                    <span>@lang('validation.attributes.whatsapp_thumbnail')</span>
                                    <input wire:model='form.whatsapp_thumbnail'
                                           class='form-control @error('form.whatsapp_thumbnail') is-invalid @enderror'
                                           type="file"/>
                                    @error('form.whatsapp_thumbnail') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="red">
                                {{trans('site.file_vaild') ,' , ', trans('site.file_size')}}
                            </div>
                        </div>

                        <div class="ad-form">
                            <h4>@lang('site.call_of_action')</h4>
                            <input wire:model='form.button_text'
                                   class="form-control @error('form.button_text') is-invalid @enderror contact-input"
                                   type="text" placeholder="@lang('validation.attributes.button_text')">
                            @error('form.button_text') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <input wire:model='form.link'
                                   class="@error('form.link') is-invalid @enderror form-control contact-input"
                                   type="text" placeholder="@lang('validation.attributes.link')">
                            @error('form.link') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>

                            <div class="btns text-center">
                                {{-- <button class="button btn-border big">@lang('site.cancel')</button> --}}
                                {{-- {{$errors}} --}}
                                <button type='submit' class="button btn-red big">@lang('site.create_ad')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- Start ad data-->

            <!-- Start preview-->
            <div class="col-lg-6">


                <div class="box-det">
                    <div class="task-head">
                        <h5>@lang('site.media_preview')</h5>
                    </div>
                    <div class="task-body">

                        <div class="row">
                            <!-- Whatsapp preview-->
                            <div class="col-lg-12">
                                <div class="ad-wrap" style='display:block !important'>
                                    <div class="whats-p">
                                        <div class="chat">
                                            <div class="w-det">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="w-img">
                                                            <img src="{{$this->whatsapp_preview}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <h5 dir='rtl'
                                                            style='font-align:right;font-weight:bold;'>{{$form['title']}}</h5>
                                                        <p dir='rtl'
                                                           style='font-align:right'>{{$form['short_description']}}</p>
                                                        <p>http://adsoldiers.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <h5 style='white-space: pre-wrap;'>{{$form['content']}}</h5>
                                                <a href="#"></a>
                                            </div>
                                            <div class="bubble-arrow alt"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-7">
                                <!-- Desktop-->
                                <div class="ad-wrap" style='display:block !important'>
                                    <div class="mac-wrap" style="position: relative">
                                        <img src="{{asset('frontAssets')}}/imgs/home/mac@2x.png" alt="">
                                        @if(strstr($this->media_preview,'.mp4'))
                                            <video
                                                class='ad'
                                                src="{{$this->media_preview}}"
                                                controls>
                                            </video>

                                        @else
                                            <img class="ad" src="{{$this->media_preview}}"
                                                 style="max-width:100%;max-height:100%"/>
                                        @endif

                                        <button
                                            class="button btn-red call-of-action-button">{{$form['button_text']}}</button>
                                    </div>
                                    {{-- <h6 class="grey">@lang('site.desktop')</h6> --}}
                                </div><!-- Desktop-->

                            </div>
                            <div class="col-lg-5">
                                <!-- Mobile -->
                                <div class="ad-wrap" style='display:block !important'>
                                    <div class="mob-wrap">
                                        <img src="{{asset('frontAssets')}}/imgs/camp/mob.png" alt="">
                                        @if(strstr($this->media_preview,'.mp4'))
                                            <video
                                                class='ad'
                                                src="{{$this->media_preview}}"
                                                controls
                                                style='max-width:100%;max-height:100%'>
                                            </video>

                                        @else
                                            <img class="ad" src="{{$this->media_preview}}"
                                                 style="max-width:100%;max-height:100%"/>
                                        @endif
                                        <button
                                            class="button btn-red call-of-action-button">{{$form['button_text']}}</button>
                                    </div>
                                    <h6 class="grey">@lang('site.mobile')</h6>
                                </div>


                            </div><!-- Mobile -->
                        </div>
                    </div>


                </div>
            </div><!-- End preview-->

        </div>
    </div>


    <div
        class="div modal fade"
        id="create-camp-modal"
        wire:ignore
        x-data
        @hide-modal.window="
                console.log($event.detail.new_camp_id);
                $('#camp_id').val($event.detail.new_camp_id);
                {{-- $('#camp_id').trigger('change'); --}}
            $('#create-camp-modal').modal('hide');

">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">@lang('validation.attributes.title')</label>
                        <input wire:model.defer='camp.title' type="text"
                               class="form-control @error('title') is-invalid @enderror"/>
                        <p
                            {{-- x-show='@entangle('errors.camp.title')' --}}
                            {{-- @notify-error.window="console.log($event.detail)" --}}
                            class='text-danger'></p>
                    </div>

                    <div class="form-group">
                        <label>@lang('validation.attributes.type')</label>
                        <select wire:model.defer='camp.type' class="form-control contact-input">
                            <option selected>@lang('validation.attributes.type')</option>
                            @foreach ($camp_types as $type)
                                <option value="{{$type}}">@lang('site.'.$type)</option>
                            @endforeach
                        </select>
                        @if($errors->has('type'))<p style='color:red'> fdfdfdfd </p>@endif
                    </div>


                    <div class="btns">
                        {{$errors}}
                        <button class="button btn-red"
                                onclick="$('#create-camp-modal').modal('hide');">@lang('site.cancel')</button>
                        <button class="button btn-border" wire:click='storeCamp'>@lang('site.create_camp')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@push('scripts')
    {{-- <script src='{{asset('frontAssets/js/multiselect.js')}}'></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>


        window.addEventListener('onContentChanged', () => {
            $('.my-select-2').select2();
        });



        $(document).ready(()=>{
            var selectElement = $("#ad_targeted_audiences");

            // Set the height of the select element to 400 pixels
            selectElement.height(400);
            $('.my-select-2').select2();

            // $('#camp_id').change(e=>{
            //     @this.set('form.camp_id', $('#camp_id').select2('val'));
            // });


            $('#ad_genders').change(e=>{
            @this.set('ad_genders', $('#ad_genders').select2('val'));
            });

            $('#select_all_genders').click(e=>{
                if($("#select_all_genders").is(':checked') ){
                    $("#ad_genders > option").attr("selected","selected");
                    $("#ad_genders").trigger("change");
                }else{
                    $("#ad_genders > option").removeAttr("selected");
                    $("#ad_genders").trigger("change");
                }
            });

            $('#ad_ages').change(e=>{
            @this.set('ad_ages', $('#ad_ages').select2('val'));
            });
            $('#select_all_ages').click(e=>{
                if($("#select_all_ages").is(':checked') ){
                    $("#ad_ages > option").attr("selected","selected");
                    $("#ad_ages").trigger("change");
                }else{
                    $("#ad_ages > option").removeAttr("selected");
                    $("#ad_ages").trigger("change");
                }
            });



            $('#ad_targeted_audiences').change(e=>{
            @this.set('ad_targeted_audiences', $('#ad_targeted_audiences').select2('val'));
            });
            $('#select_all_targeted_audiences').click(e=>{
                if($("#select_all_targeted_audiences").is(':checked') ){
                    $("#ad_targeted_audiences > option").attr("selected","selected");
                    $("#ad_targeted_audiences").trigger("change");
                }else{
                    $("#ad_targeted_audiences > option").removeAttr("selected");
                    $("#ad_targeted_audiences").trigger("change");
                }
            });


            $('#ad_countries').change(e=>{
            @this.set('ad_countries', $('#ad_countries').select2('val'));
            });


            $('#ad_cities').change(e=>{
            @this.set('ad_cities', $('#ad_cities').select2('val'));
            });

            $('#select_all_cities').click(e=>{
                if($("#select_all_cities").is(':checked') ){
                    $("#ad_cities > option").attr("selected","selected");// Select All Options
                    $("#ad_cities").trigger("change");// Trigger change to select 2
                }else{
                    $("#ad_cities > option").removeAttr("selected");
                    $("#ad_cities").trigger("change");// Trigger change to select 2
                }
            });



            $('#ad_languages').change(e=>{
            @this.set('ad_languages', $('#ad_languages').select2('val'));
            });
            $('#select_all_languages').click(e=>{
                if($("#select_all_languages").is(':checked') ){
                    $("#ad_languages > option").attr("selected","selected");
                    $("#ad_languages").trigger("change");
                }else{
                    $("#ad_languages > option").removeAttr("selected");
                    $("#ad_languages").trigger("change");
                }
            });


            $("#ad_content").emojioneArea();
            $('#ad_content').change(e=>{
            @this.set('form.content', $('#ad_content').val());
            });


            $("#short_description").emojioneArea();
            $('#short_description').change(e=>{
            @this.set('form.short_description', $('#short_description').val());
            });

        });

    </script>
@endpush
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('whatsapp.css')}}">
@endpush
