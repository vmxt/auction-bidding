<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <link rel="shortcut icon" href="{{ Setting::get_company_favicon_storage_path() }}" type="image/x-icon" />
    <!-- Stylesheets
    ============================================= -->
    <link href="{{ asset('css/google_font.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/plugins/construction/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/swiper.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/dark.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/font-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/magnific-popup.css') }}" type="text/css" />
    
    <!-- DatePicker CSS -->
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/datepicker.css') }}" type="text/css" />
    
    <!-- Bootstrap File Upload CSS -->
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/bs-filestyle.css') }}" type="text/css" />
    
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/responsive.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/plugins/construction/css/colors.css') }}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/custom.css') }}" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .heading-block:after{
            border-top: 0px;
        }
    </style>
 
    @if ($page->name == 'Home')
        <title>{{ Setting::info()->company_name }}</title>
    @else
        <title>{{ (empty($page->meta_title) ? $page->name:$page->meta_title) }} | {{ Setting::info()->company_name }}</title>
    @endif

    @yield('pagecss')
    @yield('customcss')
    {!! \Setting::info()->google_analytics !!}
    
</head>

<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">
        
        @include('theme.'.env('FRONTEND_TEMPLATE').'.main.layout.header-top-bar')

        @include('theme.'.env('FRONTEND_TEMPLATE').'.main.layout.header')
        
        <!-- InstanceBeginEditable name="editableRegion" -->
        
        @yield('content')

        <!-- Content
        ============================================= -->

        
        @include('theme.'.env('FRONTEND_TEMPLATE').'.main.layout.footer')
{{--    @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.main.layout.privacy-policy') --}}

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>
   
    <!-- External JavaScripts
    ============================================= -->
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/jquery.js') }}"></script>
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/plugins.js') }}"></script>
        
    <!-- DatePicker JS -->
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/datepicker.js') }}"></script>
    
    <!-- Bootstrap File Upload Plugin -->
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/bs-filestyle.js') }}"></script>

    <!-- Footer Scripts
    ============================================= -->
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/functions.js') }}"></script>
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/custom.js') }}"></script>
    
    <script src="{{ asset('js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('js/privacy_policy.js') }}"></script>
    @yield('pagejs')
    @yield('customjs')
</body>
<!-- InstanceEnd --></html>