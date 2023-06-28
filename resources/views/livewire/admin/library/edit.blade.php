 <main class="main-content">
          <!--head-->
          <x-admin.head/>
          <!--table-->
          <div class="border-div">
            <div class="b-btm">
              <h4>{{$page_title}}</h4>
            </div>
            <div class="row mt-30">

              <!-- Start ad data-->
              <div class="col-lg-5">
                <form wire:submit.prevent='store' class='scroll-form'>
                    <div class="ad-new">
                        <div class="ad-form">
                            <div wire:ignore>
                                <label for="">@lang('site.select_category')</label>
                                <select

                                    wire:model='form.category_id'
                                    class="@error('form.category_id') is-invalid @enderror form-control contact-input"
                                    id='category_id'
                                >
                                    <option value=''>@lang('site.select_category')</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->{"title_".app()->getLocale()} }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form.category_id') <p class='text-danger'>{{$message}}</p>@enderror

                            <hr>

                            <label for="">@lang('validation.attributes.title')</label>
                            <span wire:ignore>
                                <input id='library_title' wire:model='form.title' class="@error('form.title') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.title')">
                            </span>
                            @error('form.title') <p class='text-danger'>{{$message}}</p>@enderror
                            <hr>


                            <label for="">@lang('validation.attributes.short_description')</label>
                            <span wire:ignore>
                                <input
                                    id='library_short_description'
                                    wire:model='form.short_description'
                                    class="@error('form.short_description') is-invalid @enderror form-control contact-input"
                                    type="text"
                                    placeholder="@lang('validation.attributes.short_description')">
                            </span>
                                @error('form.short_description') <p class="text-danger">{{$message}}</p> @enderror
                            <hr>


                            <label for="">@lang('validation.attributes.description')</label>

                            <span wire:ignore>
                                <textarea
                                    id='library_description'
                                    wire:model='form.description'
                                    class="form-control @error('form.description') is-invalid @enderror contact-input"
                                    placeholder="@lang('validation.attributes.description')">
                                </textarea>
                            </span>
                            @error('form.description') <p class='text-danger'>{{$message}}</p>@enderror
                            <hr>

                        </div>


                        <div class="ad-form">


                            <div class="row">
                                    <div class="custom-file-upload">



                                        <img src="{{asset('frontAssets')}}/imgs/wallet/upload.svg" alt="">
                                        <span>@lang('validation.attributes.video_thumbnail')</span>
                                        <input wire:model='video_thumbnail' class='form-control @error('video_thumbnail') is-invalid @enderror' type="file"/>
                                        @error('video_thumbnail') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                            </div>


                            <!-- Upload ad media-->
                            <div class="">
                                <div class="row">
                                    <h3>@lang('validation.attributes.media')</h3>
                                </div>
                                <x-filepond wire:model="media_files"/>
                            </div>


                            <div class="btns text-center">
                                <button type='submit' class="button btn-red big">@lang('site.save')</button>
                            </div>
                        </div>
                    </div>
                </form>
              </div><!-- Start ad data-->

              <!-- Start preview-->
              <div class="col-lg-7">


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
                                                    <h5 dir='rtl' style='font-align:right;font-weight:bold;'>{{$form['title']}}</h5>
                                                    <p dir='rtl' style='font-align:right'>{{$form['short_description']}}</p>
                                                    <p>http://adsoldiers.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <h5 style='white-space: pre-wrap;'>{{$form['description']}}</h5>
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
                                    @if(strstr($media_preview,'.mp4'))
                                        <video
                                            class='ad'
                                            src="{{$media_preview}}"
                                            controls>
                                        </video>

                                    @else
                                        <div class="my-slider ad">
                                            @foreach($all_media_files as $single_media)
                                                <img class="" src="{{$single_media}}" style="max-height: 350px;object-fit:contain">
                                            @endforeach
                                        </div>
                                    @endif


                                </div>
                            {{-- <h6 class="grey">@lang('site.desktop')</h6> --}}
                            </div><!-- Desktop-->

                        </div>
                        <div class="col-lg-5">
                              <!-- Mobile -->
                            <div class="ad-wrap" style='display:block !important'>
                                <div class="mob-wrap" >
                                    <img src="{{asset('frontAssets')}}/imgs/camp/mob.png" alt="">
                                    @if(strstr($this->media_preview,'.mp4'))
                                        <video
                                            class='ad'
                                            src="{{$this->media_preview}}"
                                            controls
                                            style='max-width:100%;max-height:100%'>
                                        </video>

                                    @else
                                        <div class="my-slider ad">
                                            @foreach($all_media_files as $single_media)
                                                <img class="" src="{{$single_media}}" style="max-height: 350px;object-fit:contain">
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                                <h6 class="grey">@lang('site.mobile')</h6>
                                </div>


                            </div><!-- Mobile -->
                        </div>
                    </div>

                </div><!-- End box-det-->


                @if($form['media_type']=='slider' && count($form['media'])>1)
                <div class="box-det">
                  <div class="task-head">
                    <h5>@lang('site.library_pics')</h5>
                  </div>
                  <div class="task-body">

                    <div class="row">

                        @foreach ($form['media'] as $file)
                            <div class="col-3">
                                <div class="row text-center">
                                    <img src="{{url('uploads/pics/'.$file)}}" style="width:100px;height:100px;" class='img-rounded text-center'>
                                </div>
                                <button wire:click="deletePic('{{$file}}')" type='button' class="btn btn-sm btn-danger">@lang('messages.delete')</button>

                            </div>
                        @endforeach

                    </div>
                </div><!-- End box-det-->
                @endif



              </div><!-- End preview-->

            </div>
          </div>
</main>

@push('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
        /* .slick-prev, .slick-next{
            top:35% !important;
        } */
        .slick-list{
            height:100% !important;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        window.addEventListener('onContentChanged', () => {
            console.log('changeddddd');
            initSlickSlider();
        });

        function initSlickSlider(){
            $('.my-slider').slick({
                {{ app()->getLocale()=='ar'? 'rtl:true,' : '' }}
                dots: true,
                infinite: true,
                autoplay:true,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{breakpoint: 1024,settings: {slidesToShow: 3,slidesToScroll: 3,infinite: true,dots: true}},{breakpoint: 600,settings: {slidesToShow: 2,slidesToScroll: 2}},{breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}]});
        }


        document.addEventListener('livewire:load', function () {
            initSlickSlider();
            $('select').select2();

            $('#category_id').change(e=>{
                @this.set('form.category_id', $('#category_id').select2('val'));
            });


            $("#library_title").emojioneArea();
            $('#library_title').change(e=>{
                @this.set('form.title', $('#library_title').val());
            });

            $("#library_description").emojioneArea();
            $('#library_description').change(e=>{
                @this.set('form.description', $('#library_description').val());
            });

            $("#library_short_description").emojioneArea();
            $('#library_short_description').change(e=>{
                @this.set('form.short_description', $('#library_short_description').val());
            });


        });




    </script>
@endpush
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{asset('whatsapp.css')}}">
@endpush
