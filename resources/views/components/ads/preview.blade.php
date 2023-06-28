<div class="box-det">
                  <div class="task-head">
                    <h5>@lang('site.media_preview')</h5>
                  </div>
                  <div class="task-body">
                    <div class="ad-wrap">
                      <div class="mac-wrap">
                        <img src="{{asset('frontAssets')}}/imgs/home/mac@2x.png" alt="">
                        @if(strstr($this->media_preview,'.mp4'))
                            <video
                                class='ad'
                                src="{{$this->media_preview}}"
                                controls
                                style='max-width:100%'>
                            </video>

                        @else
                            <img class="ad" src="{{$this->media_preview}}" alt="">
                        @endif

                        <p>{{$this->media_preview}}</p>
                       </div>
                      <h6 class="grey">@lang('site.desktop')</h6>
                    </div>
                    <div class="ad-wrap">
                      <div class="mob-wrap">
                          <img src="{{asset('frontAssets')}}/imgs/camp/mob.png" alt="">
                          <img class="ad" src="{{asset('frontAssets')}}/imgs/camp/ad-mob@2x.png" alt="">
                        </div>
                      <h6 class="grey">@lang('site.mobile')</h6>
                    </div>
                    <div class="ad-wrap">
                      <div class="whats-wrap"><img src="{{asset('frontAssets')}}/imgs/camp/ad-whats.png" alt="">
                        <div class="flex-div-2">
                          <div>
                            <h5>Data running low?<span>Get Smartapp to ...</span></h5>
                            <p>website.com</p>
                          </div>
                          <button class="button btn-border">Install Now</button>
                        </div>
                      </div>
                      <h6 class="grey">@lang('site.whatsapp_preview')</h6>
                    </div>
                  </div>
                </div>
