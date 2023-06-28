@extends('layouts.user')
@section('content')
 <main class="main-content">
    <!--head-->
   <x-user.head/>
    <!--table-->
    <div class="border-div">
    <div class="b-btm">
        <h4>@lang('site.preview')</h4>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="box-det mt-30">
                <div class="task-head">
                <h5>{{$record->title}}</h5>
                </div>
                <div class="task-body">


                    <div class="ad-details">
                        <p>{{$record->content}}</p>
                            <div class="row b-div">
                                <div class="col-md-6">
                                    <div class="ad-det">
                                        <div class="h6"><img src="{{asset("frontAssets")}}/imgs/ads/calendar.svg" alt=""><span>@lang('validation.attributes.start_date') :</span></div>
                                        <p>{{$record->start_date}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ad-det">
                                        <div class="h6"><img src="{{asset("frontAssets")}}/imgs/ads/wallet.svg" alt=""><span>@lang('validation.attributes.budget') :</span></div>
                                        <p class="green">{{$record->budget}} @lang('site.sar_short')</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ad-det">
                                        <div class="h6"><img src="{{asset("frontAssets")}}/imgs/ads/wallet.svg" alt=""><span>@lang('site.remaining_budget') :</span></div>
                                        <p class="red">{{$record->remaining_budget}} @lang('site.sar_short')</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ad-det">
                                        <div class="h6"><img src="{{asset("frontAssets")}}/imgs/ads/click.svg" alt=""><span>@lang('site.clicks') :</span></div>
                                        <p>{{$record->clicks_count}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ad-det">
                                        <div class="h6"><img src="{{asset("frontAssets")}}/imgs/ads/gender.svg" alt=""><span>@lang('site.gender') :</span></div>
                                        <p>{{$record->genders()->pluck('value')->implode(',')}}</p>
                                    </div>
                                </div>
                            </div>

                    </div>
                        <div class="flex-div-2">
                            <p>@lang('site.status') :</p>
                            <button class="button btn-grey big">@lang('site.'.$record->status)</button>
                        </div>
                </div>
            </div>


                <div class="more-det">
                    <div class="one-det">
                        <p class="grey">@lang('validation.attributes.campagin_id') :</p>
                        <p class="sm-b">{{$record->camp->title}}</p>
                    </div>
                    <div class="one-det">
                        <p class="grey">@lang('validation.attributes.button_text')  :</p>
                        <p class="sm-b">{{$record->button_text}}</p>
                    </div>
                    <div class="one-det">
                        <p class="grey">@lang('validation.attributes.link') :</p>
                        <a class="sm-b" href="#">{{$record->link}}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon-det more-det">
                        <div class="icon-img green"><img src="{{asset("frontAssets")}}/imgs/ads/idea.svg" alt=""></div>
                        <div class="icon-txt">
                            <h6 class="grey">@lang('validation.attributes.targeted_audiences') :</h6>
                            <p>{{$record->audiences()->pluck('value')->implode(',')}}</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-det more-det">
                            <div class="icon-img orange"><img src="{{asset("frontAssets")}}/imgs/ads/user-r.svg" alt=""></div>
                            <div class="icon-txt">
                                <h6 class="grey">@lang('validation.attributes.ad_ages') :</h6>
                                <p>{{$record->ages()->pluck('value')->implode(',')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-det more-det">
                        <div class="icon-img blue"><img src="{{asset("frontAssets")}}/imgs/ads/flag.svg" alt=""></div>
                            <div class="icon-txt">
                                <h6 class="grey">@lang('validation.attributes.country_id') :</h6>
                                <p>{{$record->countries()->pluck('value')->implode(',')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-det more-det">
                            <div class="icon-img blue"><img src="{{asset("frontAssets")}}/imgs/ads/flag.svg" alt=""></div>
                            <div class="icon-txt">
                                <h6 class="grey">@lang('validation.attributes.ad_cities') :</h6>
                                <p>{{$record->cities()->pluck('name_en')->implode(',')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-det more-det">
                        <div class="icon-img yellow"><img src="{{asset("frontAssets")}}/imgs/ads/language.svg" alt=""></div>
                        <div class="icon-txt">
                            <h6 class="grey">@lang('validation.attributes.ad_languages') :</h6>
                            <p>{{$record->languages()->pluck('value')->implode(',')}}</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="info border-top">
                    @if($record->is_paid)
                    <h4>@lang('site.payment_info')</h4>
                    <div class="more-det">

                        <div class="row">
                            <div class="col-md-8">
                            <div class="one-det">
                                <p class="grey">Payment ID :</p>
                                <p class="reg grey2">{{$record->payment_info->id}}</p>
                            </div>
                            <div class="one-det">
                                <p class="grey">Amount Paid :</p>
                                <p class="reg">{{$record->payment_info->amount}} {{$record->payment_info->currency}}</p>
                            </div>
                            <div class="one-det">
                                <p class="grey">Card :</p>
                                <p class="reg">{{$record->payment_info->card->bin}}**********{{$record->payment_info->card->last4Digits}}</p>
                            </div>
                            <div class="one-det">
                                <p class="grey">Payment Status :</p>
                                <p class="reg">Approved</p>
                            </div>
                            <div class="one-det">
                                <p class="grey">Payment Date :</p>
                                <p class="reg">{{$record->payment_info->timestamp}}</p>
                            </div>
                            <div class="one-det">
                                <p class="grey">Card Holder :</p>
                                <p class="reg">{{$record->payment_info->customer->givenName}}</p>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="one-det">
                                <p class="grey">Payment Method :</p>
                                <p class="reg grey2">{{$record->payment_info->paymentBrand}}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

        </div>

        <!-- Start preview-->
        <div class="col-lg-5">
            <div class="box-det mt-30">
                <div class="task-head">
                <h5>@lang('site.media_preview')</h5>
                </div>
                <div class="task-body">
                     <!-- Desktop-->
                    <div class="ad-wrap" style='display:block !important'>
                        <div class="mac-wrap" style="position: relative">
                            <img src="{{asset('frontAssets')}}/imgs/home/mac@2x.png" alt="">
                            @if(strstr($record->media_preview_url,'.mp4'))
                                <video
                                    class='ad'
                                    src="{{$record->media_preview_url}}"
                                    controls>
                                </video>

                            @else
                                <img class="ad" src="{{$record->media_preview_url}}" style="max-width:100%;max-height:100%" />
                            @endif

                            <button class="button btn-red call-of-action-button">{{$record->button_text}}</button>
                        </div>
                    </div><!-- Desktop-->





                      <!-- Mobile -->
                            <div class="ad-wrap" style='display:block !important'>
                                <div class="mob-wrap" >
                                    <img src="{{asset('frontAssets')}}/imgs/camp/mob.png" alt="">
                                    @if(strstr($record->media_preview_url,'.mp4'))
                                        <video
                                            class='ad'
                                            src="{{$record->media_preview_url}}"
                                            controls
                                            style='max-width:100%;max-height:100%'>
                                        </video>

                                    @else
                                        <img class="ad" src="{{$record->media_preview_url}}" style="max-width:100%;max-height:100%" />
                                    @endif
                                    <button class="button btn-red call-of-action-button">{{$record->button_text}}</button>
                                </div>
                                <h6 class="grey">@lang('site.mobile')</h6>
                                </div>


                            </div><!-- Mobile -->




                    <div class="ad-wrap" style='display:block !important'>
                        <div class="whats-p">
                            <div class="chat">
                                <div class="w-det">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="w-img">
                                                <img src="{{url('uploads/pics/'.$record->whatsapp_thumbnail)}}"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <h5 dir='rtl' style='font-align:right;font-weight:bold;'>{{$record->title}}</h5>
                                            <p dir='rtl' style='font-align:right'>{{$record->short_description}}</p>
                                            <p>http://adsoldiers.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h5 style='white-space: pre-wrap;'>{{$record->content}}</h5>
                                    <a href="#"></a>
                                </div>
                                <div class="bubble-arrow alt"></div>
                            </div>
                        </div>
                    </div>



                </div><!-- task body-->
            </div>
        </div><!-- End preview-->
    </div>
    </div>
</main>
@endsection


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{asset('frontAssets/css/multiselect.css')}}"> --}}
    <style>
        .whats-p{
        /* background: url('whats-app-b.png'); */
        width: 100%;
        float: right;
        padding-bottom: 15px;
      }
      .w-det{
        background: rgb(0, 0, 0,.05);
        border-radius:5px ;
        overflow: hidden;
      }
      .chat{
        background: #dbf8c7;
        /* margin: 10px 25px 3px 0px; */
        padding: 10px;
        background: #DCF8C6;

        width: 100%;

        display: block;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 2px 1px rgb(0 0 0 / 20%);
      }
      .chat p,.chat h5,.chat h4{color: rgb(89, 89, 89);text-decoration: none;}
      .chat a{text-decoration: none;}
      .chat .bubble-arrow.alt {
        position: absolute;
        bottom: 20px;
        left: auto;
        right: 4px;
        float: right;
        top: 0;
      }
      .chat .bubble-arrow:after {
        content: "";
        position: absolute;
        border-top: 15px solid #DCF8C6;
        transform: scaleX(-1);
        border-left: 15px solid transparent;
        border-radius: 4px 0 0 0px;
        width: 0;

      }
      .chat a{color: #4285f3;}
      .chat img{max-width: 100%;}
    </style>
@endpush

