<main class="main-content">
    <x-admin.head/>

    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="row mt-30">
            <div class="col-lg-12">


                <form wire:submit.prevent='update' action="" class="contact-form row ">

                    <div class="form-group col-6">
                        <label for="form.name">@lang('validation.attributes.name')</label>
                        <input wire:model.defer='form.name' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.name')"/>
                        @error('form.name')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="form.email">@lang('validation.attributes.email')</label>
                        <input wire:model.defer='form.email' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.email')"/>
                        @error('form.email')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group col-6">
                        <label for="form.mobile">@lang('validation.attributes.phone')</label>
                        <input wire:model.defer='form.phone' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.phone')"/>
                        @error('form.phone')<p style='color:red'> {{$message}} </p>@enderror
                    </div>


                    <div class="form-group col-6">
                        <label for="form.password">@lang('validation.attributes.password')</label>
                        <input wire:model.defer='form.password' class="form-control" type="password"
                               placeholder="@lang('validation.attributes.password')"/>
                        @error('form.password')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label
                            for="form.password_confirmation">@lang('validation.attributes.password_confirmation')</label>
                        <input wire:model.defer='form.password_confirmation' class="form-control" type="password"
                               placeholder="@lang('validation.attributes.password_confirmation')"/>
                        @error('form.password_confirmation')<p style='color:red'> {{$message}} </p>@enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="">@lang('site.roles')</label>
                        <select id='selectedRoles' wire:model='selectedRoles'
                                class="@error('selectedRoles') is-invalid @enderror form-control contact-input  my-select-2">
                            <option value="" disabled="disabled">Select Option</option>

                            @foreach($roles as $role)
                                <option selected value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>

                    <div class="btns text-center">
                        <button type='submit' class="button btn-red big">@lang('site.edit_admin')</button>
                    </div>

                </form>


            </div>

        </div>
    </div>
</main>
@push('scripts')
    {{-- <script src='{{asset('frontAssets/js/multiselect.js')}}'></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        window.addEventListener('onContentChanged', () => {
            $('select').select2();
        });

        $(document).ready(()=>{
           $('select').select2();
            $('#camp_id').change(e=>{
                @this.set('form.camp_id', $('#camp_id').select2('val'));
            });


            $('#selectedRoles').change(e=>{
                @this.set('selectedRoles', $('#selectedRoles').select2('val'));
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
            $('#roles').click(e=>{
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
    {{-- <link rel="stylesheet" href="{{asset('frontAssets/css/multiselect.css')}}"> --}}
    <style>
        .whats-p {
            /* background: url('whats-app-b.png'); */
            width: 100%;
            float: right;
            padding-bottom: 15px;
        }

        .w-det {
            background: rgb(0, 0, 0, .05);
            border-radius: 5px;
            overflow: hidden;
        }

        .chat {
            background: #dbf8c7;
            /* margin: 10px 25px 3px 0px; */
            padding: 10px;
            background: #DCF8C6;

            width: 100%;

            display: block;
            border-radius: 5px;
            position: relative;
            box-shadow: 0px 2px 1px rgb(0 0 0 / 20%);
        }

        .chat p, .chat h5, .chat h4 {
            color: rgb(89, 89, 89);
            text-decoration: none;
        }

        .chat a {
            text-decoration: none;
        }

        .chat .bubble-arrow.alt {
            position: absolute;
            bottom: 20px;
            left: auto;
            right: 4px;
            float: right;
            top: 0;
        }

        .chat .bubble-arrow:after {
            content: "";
            position: absolute;
            border-top: 15px solid #DCF8C6;
            transform: scaleX(-1);
            border-left: 15px solid transparent;
            border-radius: 4px 0 0 0px;
            width: 0;

        }

        .chat a {
            color: #4285f3;
        }

        .chat img {
            max-width: 100%;
        }
    </style>
@endpush
