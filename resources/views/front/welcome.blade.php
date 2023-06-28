<!DOCTYPE html>
<html lang="en">
<!-- Start head -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Awn</title>

    <!-- bootstrap included -->
    <link rel="stylesheet" href="{{asset('frontAssets')}}/css/bootstrap.min.css" />
    <!-- start css file -->
    <link rel="stylesheet" href="{{asset('frontAssets')}}{{app()->getLocale()=='en'? '/en-assets' : ''}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('frontAssets')}}{{app()->getLocale()=='en'? '/en-assets' : ''}}/css/responsive.css" />
    <!-- font Awesome  library-->
    <link rel="stylesheet" href="{{asset('frontAssets')}}{{app()->getLocale()=='en'? '/en-assets' : ''}}/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


</head>
<!-- start body -->

<body>
    <main class="homePage">

        <!-- start header section -->
        <header id="head">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-light pt-3">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#"><img src="{{asset('frontAssets')}}/images/logo-top.png"
                                        alt=""></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page"
                                                href="#">@lang('messages.homepage')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#ab">@lang('messages.about_app')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#ft">@lang('site.features')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#con">@lang('messages.Contact_us')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn download-btn" href="#dl">@lang('site.download')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn download-btn"
                                                href="{{url('/'.((app()->getLocale() === 'ar') ? 'en' : 'ar'))}}">
                                                {{(app()->getLocale() === 'ar') ? 'English' : 'العربية'}}
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
                <!-- start hero -->
                <div class="hero">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="hero-box">
                                <h1>{{ $settings->hero_title }}</h1>
                                <p>{!! $settings->hero_body !!}</p>
                                <ul>
{{--                                    <li><a href="#" class="btn btn-1 mb-4">@lang('site.more')</a></li>--}}
                                    <br>
                                    <li><a href="{{ $settings->ios_app_url ?: '#' }}" class="ms-2"><img
                                                src="{{asset('frontAssets')}}/images/icon-app-appstore.png" alt=""></a>
                                    </li>
                                    <li><a href="{{ $settings->android_app_url ?: '#' }}"><img src="{{asset('frontAssets')}}/images/icon-app-googlestore.png"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-img-box">
                                <img src="{{asset('frontAssets')}}/images/hero.png" alt="">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </header>
        <!-- start about section -->
        <section class="about" id="ab">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-box">
                            <div class="ab-box d-flex mb-3">
                                <img src="{{asset('frontAssets')}}/images/Mailbox.png" alt="">
                                <h2 class="heading-sec pt-4">@lang('messages.about_app')</h2>
                            </div>
                            <p>{!! $about_us !!}</p>
                            <a href="#" class="btn btn-2">@lang('site.more')</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-box-img">
                            <img src="{{asset('frontAssets')}}/images/askin-girl.png" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- start feats section -->
        <section class="feats" id="ft">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="featuers text-center">
                            <div class="feat-head">
                                <h3></h3>
                                <h2>@lang('site.features')</h2>
                                <p></p>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-4">
                                    <div class="feat-box text-center">
                                        <img src="{{asset('frontAssets')}}/images/A.png" alt="">

                                        <p>{!! $settings->first_feature !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="feat-box text-center">
                                        <img src="{{asset('frontAssets')}}/images/B.png" alt="">

                                        <p>{!! $settings->second_feature !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="feat-box text-center">
                                        <img src="{{asset('frontAssets')}}/images/C.png" alt="">

                                        <p>{!! $settings->third_feature !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start download -->
        <section class="download" id="dl">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="down-info">
                            <h2 class="heading-sec heading-sec-2">@lang('site.you_can_see_our_apps') </h2>
                            <p>{!! $settings->app_share_text !!}</p>
                            <a href="javascript:void(0);" class="btn btn-1">@lang('site.download')</a>
                            <ul class="mt-3">
                                <li><a href="{{ $settings->ios_app_url ?: '#' }}" class="ms-2"><img
                                            src="{{asset('frontAssets')}}/images/icon-app-appstore.png" alt=""></a></li>
                                <li><a href="{{ $settings->android_app_url ?: '#' }}"><img src="{{asset('frontAssets')}}/images/icon-app-googlestore.png"
                                            alt=""></a></li>
                            </ul>
                            <div class="girl-box">
                                <img src="{{asset('frontAssets')}}/images/idea-girl.png" alt="">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="app-box">
                            <img src="{{asset('frontAssets')}}/images/app.png" alt="">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start contact section -->
        <section class="contact" id="con">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-5">

                        <div class="con-head text-center">
                            <div class="ab-box d-flex mb-3 text-center justify-content-center">
                                <img src="{{asset('frontAssets')}}/images/Mailbox.png" alt="">
                                <h2 class="heading-sec pt-4">@lang('messages.contact')</h2>

                            </div>
                            <p>@lang('site.home_contact_message')</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="card-contant">
                            <h2 class="heading-sec heading-sec-2">@lang('site.contact_info')</h2>
                            <ul class="my-5 info-list">
                                <li style='display:none'><a href="javascript:void(0);"><img
                                            src="{{asset('frontAssets')}}/images/location.png" alt=""> 19/A, Cirikon
                                        City hall Tower</a></li>
                                <li><a href="javascript:void(0);"><img src="{{asset('frontAssets')}}/images/phone-fill.png" alt="">
                                        {{$settings->mobile_number}}</a></li>
                                <li><a href="javascript:void(0);"><img src="{{asset('frontAssets')}}/images/mail-sharp.png" alt="">
                                        {{$settings->email}}</a></li>
                            </ul>
                            <h2 class="heading-sec heading-sec-2 heading-sec-3">@lang('site.follow_us') </h2>
                            <ul class="social mt-5">
                                <li><a href="{{$settings->instgram ?: '#'}}"><img
                                            src="{{asset('frontAssets')}}/images/01.png"></a></li>
                                <li><a href="{{$settings->twitter ?: '#'}}"><img
                                            src="{{asset('frontAssets')}}/images/02.png"></a></li>
                                <li><a href="{{$settings->facebook ?: '#'}}"><img
                                            src="{{asset('frontAssets')}}/images/03.png"></a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <form class="mt-5" id='contact-form'>

                            <div class="alert alert-ok" id='contact-alert-ok' style='display:none'>
                                <span>@lang('site.message_sent_successfully')</span>
                            </div>

                            <div class="mb-3 the-form-group">
                                <input type="text" class="form-control" name="name" placeholder="@lang('site.name')" />
                                <p class="invalid-feedbacks" style='color:red'></p>
                            </div>
                            <div class="mb-3 the-form-group">
                                <input type="text" class="form-control" name="subject"
                                    placeholder="@lang('site.message_subject')">
                                <p class="invalid-feedbacks" style='color:red'></p>
                            </div>
                            <div class="mb-3 the-form-group">
                                <input type="email" class="form-control" name="email" placeholder="@lang('site.email')">
                                <p class="invalid-feedbacks" style='color:red'></p>
                            </div>
                            <div class="mb-4 the-form-group">
                                <textarea class="form-control form-control-2" name="message" rows="5"
                                    placeholder="@lang('site.message')"></textarea>
                                <p class="invalid-feedbacks" style='color:red'></p>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" id='send-contact-btn'
                                    class="btn btn-2">@lang('site.send')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- start subscrib section -->
        <section class="sub" style="display:none">
            <div class="container">
                <div class="row sub-box text-center">
                    <div class="col-lg-2 col-md-2">

                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="sub-head">
                            <h2 class="heading-sec heading-sec-2">اشترك معنا ليصلك كل جديد</h2>
                            <p>لكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن
                                كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو
                                عبارات </p>
                            <form action="">
                                <div class="mb-4">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="برجاء كتابة الايميل">
                                </div>
                                <div class="mt-1">
                                    <button type="button" class="btn btn-3">اشتراك</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start sub-foot -->
        <section class="sub-foot">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ab-box d-flex mb-3">
                            <img src="{{asset('frontAssets')}}/images/Mailbox.png" alt="">
                            <div class="cli-info">
                                <h2 class="pt-3">@lang('site.users_trust_our_app')</h2>
                                <p>@lang('site.join_us_now_to_enjoy_our_services') </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <ul class="client pt-3 float-start">
																												@foreach($partners as $partner)
																																<li>
																																				<a href="javascript:void(0);" title="{{ $partner->name }}">
																																								<img src="{{ $partner->image_url }}" alt="{{ $partner->name }}">
																																				</a>
																																</li>
																												@endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- start footer -->
        <footer>
            <!-- start floating button -->
            <div class="floating-btn text-center shadow-lg">
                <a href="#head">
                    <img src="{{asset('frontAssets')}}/images/chevron-right.png" alt="">
                </a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="foot-box text-center">
                            <img src="{{asset('frontAssets')}}/images/logo-colored.png" alt="" class="mb-3">
                            <ul class="social mb-3">
                                <li><a href="{{$settings->instgram ?: '#'}}"><img src="{{asset('frontAssets')}}/images/01.png"
                                            alt=""></a></li>
                                <li><a href="{{$settings->twitter ?: '#'}}"><img src="{{asset('frontAssets')}}/images/02.png"
                                            alt=""></a></li>
                                <li><a href="{{$settings->facebook ?: '#'}}"><img src="{{asset('frontAssets')}}/images/03.png"
                                            alt=""></a></li>

                            </ul>
                            <p>© copyright awn Co. {{date('Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <!-- end of main -->
    <!-- start scripts -->
    <script src="{{asset('frontAssets')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('frontAssets')}}/js/jquery.js"></script>
    <script src="{{asset('frontAssets')}}/js/popper.min.js"></script>
    <script>
        $(document).ready(function(){
                var csrf = document.querySelector('meta[name="csrf-token"]').content;
                $('#send-contact-btn').click(function(e){
                    let that = $(this);
                    e.preventDefault();
                    $('.invalid-feedbacks').each(()=>{
                        $(this).text('');
                    });
                    $.ajax({
                        url:'{{url('/api/contact-us')}}',
                        type:'POST',
                        data:{
                            _token:csrf,
                            name:$('[name=name]').val(),
                            email:$('[name=email]').val(),
                            subject:$('[name=subject]').val(),
                            message:$('[name=message]').val()
                        },
                        beforeSend:function(){
                            that.attr('disabled','disabled');
                            $(':input').attr('disabled','disabled');
                        },
                        dataType:'JSON',
                        success:function(res){
                            that.removeAttr('disabled');
                            $(':input').removeAttr('disabled');
                            $('#contact-alert-ok').fadeIn();
                            $('#contact-form')[0].reset();
                        },
                        error(res){
                            that.removeAttr('disabled');
                            $(':input').removeAttr('disabled');
                            let errors = res.responseJSON.errors;
                            for(error_key in errors){
                                let error_message = errors[error_key][0];
                                $('[name='+error_key+']')
                                .parents('.the-form-group')
                                .find('p.invalid-feedbacks')
                                .text(error_message);
                            }
                        }
                    });
                });
            });
    </script>


</body>

<!-- end of body -->

</html>
