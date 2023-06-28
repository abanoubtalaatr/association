
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
                            <label>@lang('site.title_ar')</label>
                            <input wire:model.defer='form.title_ar' class="@error('form.title_ar') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.title_ar')"/>
                            @error('form.title_ar') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label>@lang('site.title_en')</label>
                            <input wire:model.defer='form.title_en' class="@error('form.title_en') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.title_en')"/>
                            @error('form.title_en') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <label>@lang('validation.attributes.desc_ar')</label>
                            <textarea wire:model.defer='form.desc_ar' class="@error('form.desc_ar') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.desc_ar')"></textarea>
                            @error('form.desc_ar') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label>@lang('validation.attributes.desc_en')</label>
                            <textarea wire:model.defer='form.desc_en' class="@error('form.desc_en') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.desc_en')"></textarea>
                            @error('form.desc_en') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>



                        <div class="col-12">
                            <label>@lang('site.location')</label>
                            <select wire:model='form.type' class="form-control @error('form.type') is-invalid @enderror">
                                <option disabled>@lang('site.location')</option>
                                <option value="navbar">Navbar</option>
                                <option value="benifits">Benifits</option>
                                <option value="services">Services</option>
                                <option value="how_it_works">How it works</option>
                            </select>
                            @error('form.type') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="custom-file-upload">
                                @if($picture)
                                    <img style='max-width:100%' src="{{$picture->temporaryUrl()}}" alt="">
                                @else
                                    @isset($page)
                                        <img style='max-width:100%' src="{{$page->picture_url}}" alt="">
                                    @endisset
                                @endif
                            <img src="{{asset('frontAssets')}}/imgs/wallet/upload.svg" alt="">
                            <span>@lang('validation.attributes.image')</span>
                            <input wire:model='picture' class='form-control @error('picture') is-invalid @enderror' type="file"/>
                            @error('picture') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-12">
                            <label>@lang('validation.attributes.content_ar')</label>
                            <textarea wire:model.defer='form.content_ar' class="@error('form.content_ar') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.content_ar')"></textarea>
                            @error('form.content_ar') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-12">
                            <label>@lang('validation.attributes.content_en')</label>
                            <textarea wire:model.defer='form.content_en' class="@error('form.content_en') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.content_en')"></textarea>
                            @error('form.content_en') <p class="text-danger">{{$message}}</p> @enderror
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
