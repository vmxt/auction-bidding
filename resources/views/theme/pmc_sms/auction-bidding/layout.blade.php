<!DOCTYPE html>
<html dir="ltr" lang="en-US"><!-- InstanceBegin template="/Templates/source.dwt" codeOutsideHTMLIsLocked="false" -->
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Roboto:300,400,500,700&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/style.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/swiper.css') }}" type="text/css" />

	<!-- Construction Demo Specific Stylesheet -->
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/demo/construction.css') }}" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/magnific-popup.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/demo/css/fonts.css') }}" type="text/css" />
	
	<!-- Bootstrap Data Table Plugin -->
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/components/bs-datatable.css') }}" type="text/css" />
	
	<!-- Date & Time Picker CSS -->
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/components/datepicker.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/components/timepicker.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/components/daterangepicker.css') }}" type="text/css" />
	
	<link rel="stylesheet" href="{{ asset('theme/pmc_sms/auction-bidding/css/custom.css') }}" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
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

		<!-- Top Bar
		============================================= -->
		<div id="top-bar">
			<div class="container clearfix">

				<div class="row justify-content-between">
					<div class="col-12 col-md-auto">

						<!-- Top Social
						============================================= -->
						<ul id="top-social">
							<li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
							<li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
							<li><a href="#" class="si-dribbble"><span class="ts-icon"><i class="icon-dribbble"></i></span><span class="ts-text">Dribbble</span></a></li>
							<li><a href="#" class="si-github"><span class="ts-icon"><i class="icon-github-circled"></i></span><span class="ts-text">Github</span></a></li>
							<li><a href="#" class="si-pinterest"><span class="ts-icon"><i class="icon-pinterest"></i></span><span class="ts-text">Pinterest</span></a></li>
							<li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
						</ul><!-- #top-social end -->

					</div>

					<div class="col-12 col-md-auto">

						<!-- Top Links
						============================================= -->
						<div class="top-links">
							<ul class="top-links-container">
								<li class="top-links-item"><a href="#">Locations</a>
									<ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#">San Francisco</a></li>
										<li class="top-links-item"><a href="#">London</a></li>
										<li class="top-links-item"><a href="#">Amsterdam</a></li>
									</ul>
								</li>
								<li class="top-links-item"><a href="faqs.html">FAQs</a></li>
								<li class="top-links-item"><a href="contact.html">Contact</a></li>
							</ul>
						</div><!-- .top-links end -->

					</div>
				</div>

			</div>
		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header" class="header-size-sm" data-sticky-shrink="false">
			<div class="container">
				<div class="header-row">

					<!-- Logo
					============================================= -->
					<div id="logo" class="ms-auto ms-lg-0 me-lg-auto">
						<a href="index.html" class="standard-logo"><img src="{{ asset('theme/pmc_sms/auction-bidding/demo/images/logo.png') }}" alt="Canvas Logo"></a>
						<a href="index.html" class="retina-logo"><img src="{{ asset('theme/pmc_sms/auction-bidding/demo/images/logo%402x.png') }}" alt="Canvas Logo"></a>
					</div><!-- #logo end -->

					<div class="header-misc d-none d-lg-flex">

						<ul class="header-extras">
							<li>
								<i class="i-plain icon-call m-0"></i>
								<div class="he-text">
									Call Us
									<span>(1) 22 54215821</span>
								</div>
							</li>
							<li>
								<i class="i-plain icon-line2-envelope m-0"></i>
								<div class="he-text">
									Email Us
									<span>info@canvas.com</span>
								</div>
							</li>
							<li>
								<i class="i-plain icon-line-clock m-0"></i>
								<div class="he-text">
									We'are Open
									<span>Mon - Sat, 10AM to 6PM</span>
								</div>
							</li>
						</ul>

					</div>

				</div>
			</div>

			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-between flex-row-reverse flex-lg-row justify-content-lg-center">

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div><!-- #top-search end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows">

							<ul class="menu-container">
								<li class="menu-item current"><a class="menu-link" href="#"><div>Home</div></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>About Us</div></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>News</div></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>Careers</div></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>Contact</div></a></li>
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->
		
        @yield('content')
		
		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">

					<div class="row">
						<div class="col-lg-9">
							<div class="widget clearfix">

								<img src="{{ asset('theme/pmc_sms/auction-bidding/images/footer-widget-logo.png') }}" alt="Image" class="alignleft" style="margin-top: 8px; padding-right: 18px; border-right: 1px solid #4A4A4A;">

								<p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards with a Retina &amp; Responsive Approach. Browse the amazing Features this template offers.</p>

								<div class="line" style="margin: 30px 0;"></div>

								<div class="row col-mb-30">
									<div class="col-lg-3 col-6 widget_links">
										<ul>
											<li><a href="#">Home</a></li>
											<li><a href="#">About</a></li>
											<li><a href="#">FAQs</a></li>
											<li><a href="#">Support</a></li>
											<li><a href="#">Contact</a></li>
										</ul>
									</div>

									<div class="col-lg-3 col-6 widget_links">
										<ul>
											<li><a href="#">Shop</a></li>
											<li><a href="#">Portfolio</a></li>
											<li><a href="#">Blog</a></li>
											<li><a href="#">Events</a></li>
											<li><a href="#">Forums</a></li>
										</ul>
									</div>

									<div class="col-lg-3 col-6 widget_links">
										<ul>
											<li><a href="#">Corporate</a></li>
											<li><a href="#">Agency</a></li>
											<li><a href="#">eCommerce</a></li>
											<li><a href="#">Personal</a></li>
											<li><a href="#">One Page</a></li>
										</ul>
									</div>

									<div class="col-lg-3 col-6 widget_links">
										<ul>
											<li><a href="#">Restaurant</a></li>
											<li><a href="#">Wedding</a></li>
											<li><a href="#">App Showcase</a></li>
											<li><a href="#">Magazine</a></li>
											<li><a href="#">Landing Page</a></li>
										</ul>
									</div>
								</div>

							</div>
						</div>

						<div class="col-lg-3 mt-5 mt-lg-0">
							<div class="widget clearfix">

								<div class="row col-mb-30">
									<div class="col-12">
										<div class="footer-big-contacts">
											<span>Call Us:</span>
											(1) 22 55412474
										</div>
									</div>

									<div class="col-12">
										<div class="footer-big-contacts">
											<span>Send an Email:</span>
											info@canvas.com
										</div>
									</div>
								</div>

							</div>

							<div class="widget subscribe-widget clearfix">

								<div class="row col-mb-30">
									<div class="col-12 col-sm-6 clearfix">
										<a href="#" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>
										<a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
									</div>
									<div class="col-12 col-sm-6 clearfix">
										<a href="#" class="social-icon si-dark si-colored si-rss mb-0" style="margin-right: 10px;">
											<i class="icon-rss"></i>
											<i class="icon-rss"></i>
										</a>
										<a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
									</div>
								</div>

							</div>
						</div>
					</div>

				</div><!-- .footer-widgets-wrap end -->
			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row justify-content-between col-mb-30">
						<div class="col-12 col-md-auto text-center text-md-start">
							Copyrights &copy; 2020 All Rights Reserved by Canvas Inc.<br>
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
						</div>

						<div class="col-12 col-md-auto text-center text-md-end">
							<div class="copyrights-menu copyright-links clearfix">
								<a href="#">Home</a>/<a href="#">About Us</a>/<a href="#">Team</a>/<a href="#">Clients</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>
							</div>
						</div>
					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{ asset('theme/pmc_sms/auction-bidding/js/jquery.js') }}"></script>
	<script src="{{ asset('theme/pmc_sms/auction-bidding/js/plugins.min.js') }}"></script>
	
	<!-- Date & Time Picker JS -->
	<script src="{{ asset('theme/pmc_sms/auction-bidding/js/components/moment.js') }}"></script>
	<script src="{{ asset('theme/pmc_sms/auction-bidding/js/components/timepicker.js') }}"></script>
	<script src="{{ asset('theme/pmc_sms/auction-bidding/js/components/datepicker.js') }}"></script>

	<!-- Include Date Range Picker -->
	<script src="{{ asset('theme/pmc_sms/auction-bidding/js/components/daterangepicker.js') }}"></script>
	
	<!-- Footer Scripts
	============================================= -->
	<!--<script src="{{ asset('theme/pmc_sms/auction-bidding/js/functions.js') }}"></script>-->
    @yield('pagejs')
    @yield('customjs')
	
	<script>

		$(document).ready(function() {
			//$('#datatable1').dataTable();
		});
		
		$(function() {
			$('.component-datepicker.default').datepicker({
				autoclose: true,
				startDate: "today",
			});

			$('.component-datepicker.today').datepicker({
				autoclose: true,
				startDate: "today",
				todayHighlight: true
			});

			$('.component-datepicker.past-enabled').datepicker({
				autoclose: true,
			});

			$('.component-datepicker.format').datepicker({
				autoclose: true,
				format: "dd-mm-yyyy",
			});

			$('.component-datepicker.autoclose').datepicker();

			$('.component-datepicker.disabled-week').datepicker({
				autoclose: true,
				daysOfWeekDisabled: "0"
			});

			$('.component-datepicker.highlighted-week').datepicker({
				autoclose: true,
				daysOfWeekHighlighted: "0"
			});

			$('.component-datepicker.mnth').datepicker({
				autoclose: true,
				minViewMode: 1,
				format: "mm/yy"
			});

			$('.component-datepicker.multidate').datepicker({
				multidate: true,
				multidateSeparator: " , "
			});

			$('.component-datepicker.input-daterange').datepicker({
				autoclose: true
			});

			$('.component-datepicker.inline-calendar').datepicker();

			$('.datetimepicker').datetimepicker({
				showClose: true
			});

			$('.datetimepicker1').datetimepicker({
				format: 'LT',
				showClose: true
			});

			$('.datetimepicker2').datetimepicker({
				inline: true,
				sideBySide: true
			});

			$('.datetimepicker3,.datetimepicker4').datetimepicker();

			// .daterange1
			$(".daterange1").daterangepicker({
				"buttonClasses": "button button-rounded button-mini m-0",
				"applyClass": "button-color",
				"cancelClass": "button-light"
			});

			// .daterange2
			$(".daterange2").daterangepicker({
				"opens": "center",
				timePicker: true,
				timePickerIncrement: 30,
				locale: {
					format: 'MM/DD/YYYY h:mm A'
				},
				"buttonClasses": "button button-rounded button-mini m-0",
				"applyClass": "button-color",
				"cancelClass": "button-light"
			});

			// .daterange3
			$(".daterange3").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			},
			function(start, end, label) {
				var years = moment().diff(start, 'years');
				alert("You are " + years + " years old.");
			});

			// reportrange
			function cb(start, end) {
				$(".reportrange span").html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			}
			cb(moment().subtract(29, 'days'), moment());

			$(".reportrange").daterangepicker({
				"buttonClasses": "button button-rounded button-mini m-0",
				"applyClass": "button-color",
				"cancelClass": "button-light",
				ranges: {
				   'Today': [moment(), moment()],
				   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				   'This Month': [moment().startOf('month'), moment().endOf('month')],
				   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				}
			}, cb);

			// .daterange4
			$(".daterange4").daterangepicker({
				autoUpdateInput: false,
				locale: {
					cancelLabel: 'Clear'
				},
				"buttonClasses": "button button-rounded button-mini m-0",
				"applyClass": "button-color",
				"cancelClass": "button-light"
			});

			$(".daterange4").on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			});

			$(".daterange4").on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});

		});

	</script>	
	
</body>
<!-- InstanceEnd --></html>