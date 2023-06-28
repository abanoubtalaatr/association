@section('styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/plugins/table/datatable/dt-global_style.css">
    <link href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/forms/switches.css">
    <link href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin') }}/plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="{{ asset('admin') }}/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
				<link href="{{ asset('admin') }}/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />

    <!-- END PAGE LEVEL STYLES -->
@endsection
