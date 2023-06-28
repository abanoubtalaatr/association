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
                        <input
                            wire:model='form.title_ar'
                            class="@error('form.title_ar') is-invalid @enderror form-control contact-input"
                            type="text" placeholder="@lang('validation.attributes.title_ar')"/>
                        @error('form.title_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <input
                            wire:model='form.title_en'
                            class="@error('form.title_en') is-invalid @enderror form-control contact-input"
                            type="text" placeholder="@lang('validation.attributes.title_en')"/>
                        @error('form.title_en') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <textarea
                            wire:model='form.description_ar' class="@error('form.description_ar') is-invalid @enderror form-control contact-input"
                             placeholder="@lang('validation.attributes.description_ar')">
                        </textarea>

                        @error('form.description_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                    <div class="col-6">
                        <textarea
                            wire:model='form.description_en' class="@error('form.description_en') is-invalid @enderror form-control contact-input"
                            placeholder="@lang('validation.attributes.description_en')">
                        </textarea>

                        @error('form.description_en') <p class="text-danger">{{$message}}</p> @enderror
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
