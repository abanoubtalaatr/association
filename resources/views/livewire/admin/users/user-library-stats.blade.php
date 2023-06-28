<main class="main-content">
    <!--head-->
   <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm">
            <h4>@lang('site.statistics')</h4>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Totals-->
                <div class="box-det mt-30">
                    <div class="task-head">
                    <h5>@lang('site.clicks')</h5>
                    </div>
                    <div class="task-body">

                        <!-- Start totals-->
                        <div class="ad-details">
                                <div class="row b-div">

                                        <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    {{-- <span>@lang('site.total_clicks')</span> --}}
                                                </div>
                                                <p>{{$visits_count}}</p>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    <span>@lang('site.month_clicks')</span>
                                                </div>
                                                <p>{{$record->month_clicks}}</p>
                                            </div>
                                        </div> --}}

                                </div>
                        </div><!-- End totals -->
                    </div>
                </div>


                <!-- Countries -->
                <div class="box-det mt-30">
                    <div class="task-head">
                    <h5>@lang('general.countries')</h5>
                    </div>
                    <div class="task-body">

                        <div class="ad-details">
                                <div class="row b-div">
                                    @foreach($countries as $country_name=>$visitors_number)
                                        <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    <span>{{$country_name}}</span>
                                                </div>
                                                <p>{{$visitors_number}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>

                 <!-- Cities -->
                <div class="box-det mt-30">
                    <div class="task-head">
                    <h5>@lang('validation.attributes.ad_cities')</h5>
                    </div>
                    <div class="task-body">

                        <div class="ad-details">
                                <div class="row b-div">
                                    @foreach($cities as $city_name=>$visitors_number)
                                        <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    <span>{{$city_name}}</span>
                                                </div>
                                                <p>{{$visitors_number}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>


                <!-- Audiences -->
                <div class="box-det mt-30">
                    <div class="task-head">
                    <h5>@lang('validation.attributes.targeted_audience')</h5>
                    </div>
                    <div class="task-body">

                        <div class="ad-details">
                                <div class="row b-div">
                                    @foreach($audiences as $audience_name=>$visitors_number)
                                        <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    <span>{{$audience_name}}</span>
                                                </div>
                                                <p>{{$visitors_number}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>

                 <!-- Ages -->
                <div class="box-det mt-30">
                    <div class="task-head">
                    <h5>@lang('validation.attributes.ad_ages')</h5>
                    </div>
                    <div class="task-body">

                        <div class="ad-details">
                                <div class="row b-div">
                                    @foreach($ages as $age_name=>$visitors_number)
                                        <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    <span>{{$age_name}}</span>
                                                </div>
                                                <p>{{$visitors_number}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>

                 <!-- Genders -->
                <div class="box-det mt-30">
                    <div class="task-head">
                    <h5>@lang('validation.attributes.ad_genders')</h5>
                    </div>
                    <div class="task-body">

                        <div class="ad-details">
                                <div class="row b-div">
                                    @foreach($genders as $gender_name=>$visitors_number)
                                        <div class="col-md-6">
                                            <div class="ad-det">
                                                <div class="h6">
                                                    <span>{{$gender_name}}</span>
                                                </div>
                                                <p>{{$visitors_number}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>



            </div>

        </div><!-- End preview-->
    </div>
</main>

