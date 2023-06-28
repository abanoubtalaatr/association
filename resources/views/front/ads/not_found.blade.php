<html>
	<head>
		<title>@lang('site.content_is_expired')</title>
         <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Arvo'>
		<style>
	.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
	}

	.page_404  img{ width:100%;}

	.four_zero_four_bg{
        height: 400px;
        background-position: center;
	}


	.four_zero_four_bg h1{
		font-size:80px;
    }

    .four_zero_four_bg h3{
            font-size:80px;
    }

	.link_404{
		color: #fff!important;
					padding: 10px 20px;
					background: #39ac31;
					margin: 20px 0;
					display: inline-block;}
	.contant_box_404{ margin-top:-50px;}
	</style>
	</head>
	<body>
		<section class="page_404">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 ">
						<div class="col-sm-10 col-sm-offset-1  text-center">
							<div class="contant_box_404" style="padding-top:50px;">
                                <img style='width:400px;' src="{{asset('new_frontAssets/images/2824441_clock_stopwatch_time_timer_icon.png')}}" alt="">
								<h2>@lang('site.sorry')</h2>

								<h1>@lang('site.content_expired')</h1>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</body>
</html>
