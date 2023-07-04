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
                    <div class="col-12">
                        <input
                            wire:model='form.name'
                            class="@error('form.name') is-invalid @enderror form-control contact-input"
                            type="text" placeholder="@lang('validation.attributes.name')"/>
                        @error('form.name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-12">
    <textarea wire:model='form.description'
              class="@error('form.description') is-invalid @enderror form-control contact-input"
              placeholder="@lang('validation.attributes.description')">
    </textarea>
                        @error('form.description') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="contact-group date" data-provide="datepicker">
                        <label>@lang('validation.attributes.date')</label>
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
