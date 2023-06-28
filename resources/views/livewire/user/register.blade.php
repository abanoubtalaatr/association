<section class="login">
    <div class="row">
        <div class="col-md-5">
            <x-langselect/>
            <div class="login-back">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8">

                        <div class="register-head">
                            <h4 class="grey">@lang('site.create_new_account_as_a_creator')</h4>

                            {{-- <p class="grey">@lang('site.please_select_account_type')</p> --}}
                        </div>
                        <div class="step" @if($step==2) style='display:none' @endif>
                            <div class="select-user">
                                <div class="row">
                                    <div class="col-6" wire:click="changeUserType('advertiser')">
                                        <div
                                            class="register-u @if(isset($form['user_type']) && $form['user_type'] == 'advertiser') active @endif">
                                            <p>@lang('site.as_advertiser')</p>
                                        </div>
                                    </div>
                                    {{--                        <div class="col-6" wire:click="changeUserType('soldier')">--}}
                                    {{--                          <div class="register-u @if(isset($form['user_type']) && $form['user_type'] == 'soldier') active @endif">--}}
                                    {{--                            <p>@lang('site.as_soldier')</p>--}}
                                    {{--                          </div>--}}
                                    {{--                        </div>--}}
                                </div>
                            </div>
                            <div class="btns">
                                <button class="button btn-red full next-step-btn">@lang('site.next')</button>
                            </div>
                        </div>
                        <div class="step" @if($step==1) style='display:none' @endif>
                            <form wire:submit.prevent='store'>
                                <input wire:model.defer='form.username' class="form-control register-input" type="text"
                                       placeholder="@lang('validation.attributes.username')"/>
                                @error('form.username') <span class="invalid-info">{{$message}}</span> @enderror


                                @if($form['user_type']=='advertiser')
                                    <input wire:model.defer='form.email' class="form-control register-input" type="text"
                                           placeholder="@lang('messages.email')"/>
                                    @error('form.email') <span class="invalid-info">{{$message}}</span> @enderror
                                @endif

                                @if($form['user_type']=='soldier')
                                    <input wire:model.defer='form.mobile' class="form-control register-input"
                                           name='mobile' type="text"
                                           placeholder="@lang('validation.attributes.mobile')"/>
                                    @error('form.mobile') <span class="invalid-info">{{$message}}</span> @enderror
                                @endif

                                <div class="input-group register-group">
                                    <input wire:model.defer='form.password' class="form-control" type="password"
                                           placeholder="@lang('messages.password')">
                                    <div class="input-group-prepend check"><i class="fas fa-eye-slash"></i></div>
                                </div>
                                <p class="red"> {{trans('site.password_vaild')}} </p>
                                @error('form.password') <span class="invalid-info">{{$message}}</span> @enderror

                                <div class="input-group register-group">
                                    <input wire:model.defer='form.password_confirmation' class="form-control"
                                           type="password" placeholder="@lang('messages.password_confirmation')">
                                    <div class="input-group-prepend check"><i class="fas fa-eye-slash"></i></div>
                                </div>
                                @error('form.password_confirmation') <span
                                    class="invalid-info">{{$message}}</span> @enderror

                                <button type='submit'
                                        class="button btn-red full mt-4">@lang('messages.Register')</button>
                            </form>
                        </div>
                        <div class="mr-30 text-center">
                            <a class="grey" href="{{route('user.login_form')}}">
                                @lang('site.already_have_an_account')!
                                <span class="red">@lang('messages.Login')</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="login-img"><img
                    src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/login/login-img@2x.png" alt="">
            </div>
        </div>
    </div>
</section>
