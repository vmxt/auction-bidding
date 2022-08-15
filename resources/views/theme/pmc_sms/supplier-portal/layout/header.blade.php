<header id="header" class="sticky-style-2">
    <div class="container clearfix">
        <!-- Logo
        ============================================= -->
        <div id="logo">
            <a href="{{ route('home') }}" class="standard-logo"><img src="{{ Setting::get_company_logo_storage_path() }}" alt="PMC"></a>
            <a href="{{ route('home') }}" class="retina-logo"><img style="height:55px !important;" src="{{ Setting::get_company_logo_storage_path() }}" alt="PMC"></a>  
        </div><!-- #logo end -->

        <!--<ul class="header-extras">
            <li>
                <i class="i-plain icon-call nomargin"></i>
                <div class="he-text">
                    Call Us
                    <span>(91) 22 54215821</span>
                </div>
            </li>
            <li>
                <i class="i-plain icon-line2-envelope nomargin"></i>
                <div class="he-text">
                    Email Us
                    <span>info@canvas.com</span>
                </div>
            </li>
            <li>
                <i class="i-plain icon-line-clock nomargin"></i>
                <div class="he-text">
                    We'are Open
                    <span>Mon - Sat, 10AM to 6PM</span>
                </div>
            </li>
        </ul>-->

    </div>

    <div id="header-wrap">
        
        @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.supplier-portal.layout.menu')
        <!-- Primary Navigation
        ============================================= -->

    </div>

</header>

@if(Session::has('success') || Session::has('error'))
    <div class="container">
        <div class="row mb-20">
            <div class="col-md-12 mt-3">
                @if(Session::has('success'))
                    <div class="style-msg successmsg">
                        <div class="sb-msg"><i class="icon-thumbs-up"></i><strong> Success:</strong> {{ session()->get('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>   
                @endif
                @if(Session::has('error') )
                    <div class="style-msg errormsg">
                        <div class="sb-msg"><i class="icon-remove"></i><strong> Error: </strong> {{ session()->get('error') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>   
                @endif
            </div>
        </div>
    </div>
@endif


{{-- <header>
    <div class="head-wrapper navik-header">
        <div class="container">
            <div class="navik-header-container">
                <!--Logo-->
                <div class="logo" data-mobile-logo="{{ asset('storage').'/logos/'.Setting::getFaviconLogo()->company_logo }}" data-sticky-logo="{{ asset('storage').'/logos/'.Setting::getFaviconLogo()->company_logo }}">
                    <a href="{{ url('/') }}"><img src="{{ asset('storage').'/logos/'.Setting::getFaviconLogo()->company_logo }}" alt="logo"/></a>
                </div>

                <div class="burger-menu">
                    <div class="line-menu line-half first-line"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu line-half last-line"></div>
                </div>

                @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.layout.menu')

            </div>
        </div>
    </div>
</header> --}}
