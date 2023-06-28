
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
                            <input wire:model='form.discount_code' class="@error('form.discount_code') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.discount_code')"/>
                            @error('form.discount_code') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                        <div class="col-6">
                            <input wire:model='form.number_of_times' class="@error('form.number_of_times') is-invalid @enderror form-control contact-input" type="number" placeholder="@lang('validation.attributes.number_of_times')"/>
                            @error('form.number_of_times') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="contact-group date" data-provide="datepicker">
                                <label>@lang('validation.attributes.start_date')</label>
                                <input wire:model='form.start_at' class="@error('form.start_at') is-invalid @enderror form-control" type="date" placeholder="@lang('validation.attributes.start_date')">
                                @error('form.start_at') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr/>
                        </div>


                        <div class="col-6">
                            <div class="contact-group date" data-provide="datepicker">
                                <label>@lang('validation.attributes.expire_at')</label>
                                <input wire:model='form.expire_at' class="@error('form.expire_at') is-invalid @enderror form-control" type="date" placeholder="@lang('validation.attributes.expire_at')">
                                @error('form.expire_at') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="form-check-label mb-3" for="flexRadioDefault1">
                                {{trans('validation.attributes.discount_type')}}
                            </label>

                            <div class="form-check mr-4">
                                <input wire:model='form.type' value="value" class="form-check-input" type="radio">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{trans('validation.attributes.value')}}
                                </label>
                            </div>
                            <div class="form-check">
                                <input wire:model='form.type' value="percentage" class="form-check-input" type="radio">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    {{trans('validation.attributes.discount_percentage')}}

                                </label>
                            </div>
                            @error('form.type') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>


                        <div class="col-6">
                            <input wire:model='form.value' class="@error('form.value') is-invalid @enderror form-control contact-input" type="number" placeholder="@lang('validation.attributes.discount_value')"/>
                            @error('form.value') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                    <div class="btns text-center">
                        <button type='submit' class="button btn-red big">@lang('site.save')</button>
                    </div>

                </form>
            </div>
          </div>
        </main>
