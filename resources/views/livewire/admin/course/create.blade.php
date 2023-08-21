<main class="main-content" xmlns="http://www.w3.org/1999/html">
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
                    <div class="row">
                        <div class="col-6">
                            <label>@lang('site.training_hours')</label>
                            <input
                                wire:model='form.training_hours'
                                class="@error('form.training_hours') is-invalid @enderror form-control contact-input"
                                type="text" placeholder="@lang('validation.attributes.training_hours')"/>
                            @error('form.training_hours') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label>@lang('validation.attributes.valid_to')</label>
                            <div class="contact-group date" data-provide="datepicker">

                                <input wire:model='form.valid_to'
                                       class="@error('form.valid_to') is-invalid @enderror form-control" type='date'
                                       placeholder="@lang('validation.attributes.valid_to')">
                                @error('form.valid_to') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="col-12">
                        <label>@lang('validation.attributes.name')</label>
                        <input
                            wire:model='form.name'
                            class="@error('form.name') is-invalid @enderror form-control contact-input"
                            type="text" placeholder="@lang('validation.attributes.name')"/>
                        @error('form.name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-12">
                        <label>@lang('validation.attributes.description')</label>
    <textarea wire:model='form.description'
              class="@error('form.description') is-invalid @enderror form-control contact-input"
              placeholder="@lang('validation.attributes.description')">
    </textarea>
                        @error('form.description') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="col-lg-12">
                    <label>@lang('validation.attributes.date')</label>
                    <div class="contact-group date" data-provide="datepicker">

                        <input wire:model='form.date'
                               class="@error('form.date') is-invalid @enderror form-control" type='date'
                               placeholder="@lang('validation.attributes.date')">
                        @error('form.date') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                </div>
                <div class="btns text-center my-2">
                    <button type='submit' class="button btn-red big">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>
</main>
