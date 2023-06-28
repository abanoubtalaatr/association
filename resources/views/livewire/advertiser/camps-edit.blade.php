<main class="main-content">
        <x-user.head/>
          <!--campaign-->
          <div class="border-div">
            <div class="b-btm">
              <h4>{{$page_title}}</h4>
            </div>
            <div class="row mt-30">
              <div class="col-lg-12">


                <form  wire:submit.prevent='update' action="" class="contac-form row">
                    <div class="form-group">
                        <label for="form.title">@lang('messages.title')</label>
                        <input wire:model.defer='form.title' class="form-control" type="text" placeholder="@lang('validation.attributes.title')"/>
                        @error('form.title')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>@lang('validation.attributes.type')</label>
                        <select wire:model.defer='form.type' class="form-control contact-input">
                            <option selected>@lang('validation.attributes.type')</option>
                            @foreach ($types as $type)
                                <option value="{{$type}}">@lang('site.'.$type)</option>
                            @endforeach
                        </select>
                        @error('form.type')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="btns text-center">
                      <button type = 'submit' class="button btn-red big">@lang('site.create_camp')</button>
                    </div>

                </form>


              </div>

            </div>
          </div>
        </main>
