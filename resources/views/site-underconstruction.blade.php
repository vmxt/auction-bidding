<!DOCTYPE html>
<html dir="ltr" lang="en-US">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="author" content="SemiColonWeb" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Stylesheets
      ============================================= -->
      <link rel="shortcut icon" href="{{ Setting::get_company_favicon_storage_path() }}" type="image/x-icon" />
      <link href="{{ asset('css/google_font.css') }}" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/bootstrap.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/plugins/construction/style.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/swiper.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/dark.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/font-icons.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/animate.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/magnific-popup.css') }}" type="text/css" />
            
      <!-- Bootstrap File Upload CSS -->
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/responsive.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/plugins/construction/css/colors.css') }}" type="text/css" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
      <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/custom.css') }}" type="text/css" />
      <style>
        
          .heading-block:after{
              border-top: 0px;
          }

          #toast-container > div {
            background: green;
          }

      </style>

  </head>

  <body>
    
    <section id="content">
      <div class="content-wrap">
        <div class="container">

          <div class="heading-block text-center border-bottom-0">
            <h1>We are currently Under Construction</h1>
            <span>Please check back again within Some Days as We're Pretty Close</span>
          </div>

          <img src="{{ asset('img/under-construction.jpg') }}" style="display: block; margin: 0 auto;" />         

          <div class="subscribe-widget mt-5">
            
            <div class="widget-subscribe-form-result"></div>
            
            <form id="widget-subscribe-form" action="{{ route('subscriber') }}" method="post" class="nobottommargin">
              @csrf
              <div class="input-group input-group-lg mx-auto" style="max-width:750px;" id="remove-mobile">
                
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="icon-email2"></i></div>
                </div>
                
                <input type="email" name="email" class="form-control required email" placeholder="Subscribe to get notified when this page is ready">

                <div class="input-group-append">
                  <button class="btn btn-secondary" type="submit">Subscribe Now</button>
                </div>
              </div>
            </form>

          </div>

        </div>
      </div>
    </section>

  </body>
  <!-- External JavaScripts
  ============================================= -->
  <script src="{{ asset('theme/pmc_sms/supplier-portal/js/jquery.js') }}"></script>
  <script src="{{ asset('theme/pmc_sms/supplier-portal/js/plugins.js') }}"></script>
  <script src="{{ asset('theme/pmc_sms/supplier-portal/js/functions.js') }}"></script>
  <script type="text/javascript">
      if ($(window).width() < 768) {
         
         $('#remove-mobile').remove();

         var html_append  = '<div class="form-group">';
             html_append += '<input type="email" name="email" class="form-control required email" placeholder="Subscribe to get notified when this page is ready">';
             html_append += '</div>';
             html_append += '<div class="form-group">';
             html_append += '<button class="btn btn-secondary btn-block" type="submit">Subscribe Now</button>';
             html_append += '</div>';

         $('#widget-subscribe-form').append(html_append);
      }
  </script>

</html>