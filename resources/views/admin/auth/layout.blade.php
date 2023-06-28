<!DOCTYPE html>
<html  lang="en" data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin') }}/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('admin') }}/bootstrap/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- END SPECIAL  STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/forms/switches.css">
    <!-- END SPECIAL STYLES -->
    
   
</head>
<body class="form">
     <!--  BEGIN NAVBAR  -->
     <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item dropdown language-dropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @continue($localeCode == LaravelLocalization::getCurrentLocale())
                    <a class="nav-link" data-language="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <i class="flag-icon flag-icon-{{ $localeCode == 'en' ? 'us' : 'sa' }}"></i>
                            {{ $properties['native'] }}
                    </a>
                    @endforeach
                </li>
            </ul>
        </header>
     </div>

           

               
    @yield('auth')

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('admin') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="{{ asset('admin') }}/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('admin') }}/bootstrap/js/bootstrap.min.js"></script>
 <!------- begin flash msg---------->
 <script> 
    $('#alertMessage').not('.alert-important').delay(5000).fadeOut(350);
</script>
<!------- end flash msg---------->


<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('admin') }}/assets/js/authentication/form-2.js"></script>

 </body>
</html>