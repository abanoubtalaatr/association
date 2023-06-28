@extends('layouts.user')
@section('content')
    <section class="dashboard">
        <!--head-->
        <x-user.head/>
        <!--dashboard-->
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        {{-- <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">clicks</button> --}}
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">




                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dash dash-x my-3 ">
                                    <h5>@lang('site.this_week_visitors')</h5>
                                    <canvas id="line-chart" width="100%" height="80px" class="border-0"></canvas>
                                </div>
                            </div>
                            <div class=" col-lg-6 mt-3 ">
                                <div class="table-wrap table-wrap-2">
                                    <h5> @lang('general.countries')</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('general.country')</th>
                                                <th class='text-center'>@lang('site.visitors_number')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($country_stats as $country_name=>$visitors_number)
                                                <tr>
                                                    <td>{{$country_name}}</td>
                                                    <td class="td text-center">{{$visitors_number}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>


                                <hr>

                                <div class="table-wrap table-wrap-2">
                                    <h5> @lang('general.cities')</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('general.city')</th>
                                                <th class='text-center'>@lang('site.visitors_number')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($city_stats as $city_name=>$visitors_number)
                                                <tr>
                                                    <td>{{$city_name}}</td>
                                                    <td class="td text-center">{{$visitors_number}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div><!-- my tab content-->
            </div>


        </div>
    </section>
@endsection

@push('styles')
<style>
        .nav-tabs{
            justify-content: center;
        }
        .nav-tabs .nav-item .nav-link{
            font-size: 24px;
            color: #747B82;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #B63339;
            background-color: #fff;
            border-color: #fff #fff #B63339;
        }
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }
        .nav-tabs .nav-link {
            margin-bottom: -1px;
            background: 0 0;
            border: 2px solid transparent;
            border-radius: 0 !important;
        }
        .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
            border-color: #fff #fff #B63339;
        }
        .td{
            text-align: end;
        }
        .dash-x{
            height: unset;
        }
        .table-wrap-2{
            padding: 15px;
        }
        @media only screen and (max-width: 600px) {
            .nav-tabs .nav-item .nav-link{
                font-size: 16px;
        }
    }
</style>
@endpush



@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const ctx = document.getElementById('line-chart').getContext('2d');
        const datapoints = [{{implode(',',$week_stats)}}];
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    '@lang('site.week_days.sun')',
                    '@lang('site.week_days.mon')',
                    '@lang('site.week_days.tue')',
                    '@lang('site.week_days.wed')',
                    '@lang('site.week_days.thu')',
                    '@lang('site.week_days.fri')',
                    '@lang('site.week_days.sat')'
                ],
                datasets: [
                    {
                    data: datapoints,
                    borderColor: '#B7B7B7',
                    fill: false,
                    cubicInterpolationMode: 'monotone',
                    tension: 0.4
                    }
                ]
            },
            options: {
                plugins: {
                legend: {
                    display: false
                }
                },
                scales: {
                x: {
                    grid: {
                    display: false
                    }
                },
                y: {
                    grid: {
                    color: '#F0EDFF'
                    }
                },
                xAxes: [{
                    ticks: {
                    fontColor: "#fff",
                    }
                }],
                }
            }
        });

    </script>
@endpush
