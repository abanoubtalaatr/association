<main class="main-content">
        <x-admin.head/>
          <!--campaign-->
          <div class="border-div">
            <div class="b-btm">
              <h4>{{$page_title}}</h4>
            </div>
            <div class="row mt-30">
              <div class="col-lg-7">


                <form x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                            wire:submit.prevent='store' action="" class="contac-form row">
                    <div class="form-group">
                        <label for="form.title">@lang('messages.title')</label>
                        <input wire:model.defer='form.title' class="form-control" type="text" placeholder="@lang('validation.attributes.title')"/>
                        @error('form.title')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="form.description">@lang('messages.description')</label>
                        <input wire:model.defer='form.description' class="form-control" type="text" placeholder="@lang('validation.attributes.description')"/>
                        @error('form.description')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="form.content">@lang('site.content')</label>
                        <textarea wire:model.defer='form.content' class="form-control" placeholder="@lang('validation.attributes.content')"></textarea>
                        @error('form.content')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="form.media_type">@lang('validation.attributes.media_type')</label>
                        <select wire:model.defer='form.media_type' class="form-control contact-input">
                            <option selected>@lang('validation.attributes.media_type')</option>
                            <option value="video">@lang('site.video')</option>
                            <option value="image">@lang('site.image')</option>
                        </select>
                        @error('form.media_type')<p style='color:red'> {{$message}} </p>@enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="new_media_file">@lang('validation.attributes.media_file')</label>
                        <input wire:model='new_media_file' type="file" class="form-control">
                        @error('new_media_file')<p style='color:red'> {{$message}} </p>@enderror

                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    <hr>
                    <div class="btns text-center">
                      <button :disabled="isUploading" type = 'submit' class="button btn-red big">@lang('site.edit_task')</button>
                    </div>

                </form>


              </div>
              <div class="col-lg-5">
                <div class="box-det">
                    <div class="task-head">
                        <h5>@lang('site.preview')</h5>
                    </div>
                    <div class="task-body">
                        <div class="mac-wrap">
                            <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/mac@2x.png" alt="">
                            @if($this->current_media_type=='video')
                                <video
                                    class='ad'
                                    src="{{$media_url}}"
                                    controls
                                    style='max-width:100%;max-height:100%'>
                                </video>

                            @else
                                <img class="ad" src="{{$media_url}}" style="max-width:100%;max-height:100%" />
                            @endif
                            </div>
                            <h6 class="grey">@lang('site.desktop')</h6>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </main>
