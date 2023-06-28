 <section class="login">
        <div class="row">
          <div class="col-md-5">
            <div class="login-back">
              <div class="row justify-content-center">
                <div class="col-md-8">
                 <x-langselect/>
                  <div class="login-form">

                    <form wire:submit.prevent='login' style="text-align: {{app()->getLocale()=='ar'? 'right' : 'left' }} ">
                        <div class="login-logo"><img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/logo.svg" alt=""></div>
                        <p>@lang('site.enter_login_data')<span> @lang('site.to_continue')</span></p>



                        @if($error_message)
                            <div class="alert alert-danger">
                                {{$error_message}}
                            </div>
                        @endif

                        <div class="input-group login-group floating-label-group">
                            <div class="input-group-prepend"><img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/login/user.svg" alt=""></div>
                            <input wire:model.defer='username' class="form-control" type="text" autocomplete="flase" autofocus>
                            <label class="floating-label">@lang('validation.attributes.username')</label>

                        </div>
                        @error('username') <span class="invalid-info">{{$message}}</span> @enderror

                        <div class="input-group login-group floating-label-group">
                            <div class="input-group-prepend"><img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/login/lock.svg" alt=""></div>
                            <input wire:model.defer='password' class="form-control" type="password" id="password" autocomplete="chrome-off">
                            <label class="floating-label">@lang('validation.attributes.password')</label>
                            <div class="input-group-prepend check"><i class="fas fa-eye-slash"></i></div>
                        </div>
                        @error('password') <span class="invalid-info">{{$message}}</span> @enderror

                        <div class="flex-div-2"><a class="grey" href="#">@lang('site.remember_me')</a>
                        <label class="switch">
                            <input wire:model='remember_me' type="checkbox"><span class="slider"></span>
                        </label>
                        </div>
                        <div class="login-btns">
                        <button type='submit' class="button btn-red full">@lang('messages.Login')</button>
                        <button onclick='window.location.href="{{route('user.register_form')}}"' style='text-align:center' class="button btn-border full">@lang('messages.I_dont_have_an_account')</button>
                        </div><a class="red" href="{{route('user.forgot-password')}}">@lang('site.i_forgot_my_password')</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="login-img"><img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/login/login-img@2x.png" alt=""></div>
          </div>
        </div>
      </section>
