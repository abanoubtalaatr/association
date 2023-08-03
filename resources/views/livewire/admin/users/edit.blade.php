<main class="main-content">
    <x-admin.head/>
    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="row mt-30">
            <div class="col-lg-12">


                <form wire:submit.prevent='update' action="" class="contac-form row">

                    <div class="form-group col-6">
                        <label for="form.mobile">@lang('validation.attributes.mobile')</label>
                        <input wire:model.defer='form.mobile' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.mobile')"/>
                        @error('form.mobile')<p style='color:red'> {{$message}} </p>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="form.email">@lang('validation.attributes.email')</label>
                        <input wire:model.defer='form.email' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.email')"/>
                        @error('form.email')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group col-6">
                        <label for="form.title">@lang('validation.attributes.title')</label>
                        <input wire:model.defer='form.title' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.title')"/>
                        @error('form.title')<p style='color:red'> {{$message}} </p>@enderror
                    </div>


                    <div class="form-group col-6">
                        <label for="form.first_name">@lang('validation.attributes.first_name')</label>
                        <input wire:model.defer='form.first_name' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.first_name')"/>
                        @error('form.first_name')<p style='color:red'> {{$message}} </p>@enderror
                    </div>


                    <div class="form-group col-6">
                        <label for="form.last_name">@lang('validation.attributes.last_name')</label>
                        <input wire:model.defer='form.last_name' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.last_name')"/>
                        @error('form.last_name')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label
                            for="form.fourth_name_in_arabic">@lang('validation.attributes.fourth_name_in_arabic')</label>
                        <input wire:model.defer='form.fourth_name_in_arabic' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.fourth_name_in_arabic')"/>
                        @error('form.fourth_name_in_arabic')<p style='color:red'> {{$message}} </p>@enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="form.passport">@lang('validation.attributes.passport')</label>
                        <input wire:model.defer='form.passport' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.passport')"/>
                        @error('form.passport')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="form.hospital">@lang('validation.attributes.hospital')</label>
                        <input wire:model.defer='form.hospital' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.hospital')"/>
                        @error('form.hospital')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="form.specialty">@lang('validation.attributes.specialty')</label>
                        <input wire:model.defer='form.specialty' class="form-control" type="text"
                               placeholder="@lang('validation.attributes.specialty')"/>
                        @error('form.specialty')<p style='color:red'> {{$message}} </p>@enderror
                    </div>
                    <hr>


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

                    <hr>


                    <div class="btns text-center">
                        <button type='submit' class="button btn-red big">@lang('site.edit_user')</button>
                    </div>

                </form>


            </div>

        </div>
    </div>
</main>
