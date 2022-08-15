@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.main.main')

@section('content')
    <section id="content">
        <div class="content-wrap" style="padding:50px 0;">
            <div class="container clearfix">
                <div class="fancy-title title-dotted-border title-center">
                    <h1>Get in <span>touch</span> with <span>us</span></h1>
                </div>
                <div class="postcontent nobottommargin">

                    
                    <form id="contactUsForm">
                        <div class="form-group row">
                            <label for="text" class="col-12 col-form-label">How can we help you?</label>
                            <div class="col-12">
                                <select class="form-control form-control-lg" id="concern" required="required">
                                  <option selected="true" value="" disabled="disabled">Choose...</option>
                                  <option value="1">I’m a supplier looking to sell my products to Philsaga</option>
                                  <option value="2">I’m a service provider looking to offer services to Philsaga</option>
                                  <option value="3">I have concerns about my billings and payments</option>                                  
                                  <option value="4">I have other concerns..</option>
                                </select>
                            </div>
                            <small id="concernhelp" style="display:none;color:red;" class="form-text text-muted">Please select</small>
                        </div>
                    <button type="submit" class="button button-3d nomargin">Next <span class="icon icon-arrow-alt-circle-right"></span></button>
                    </form>
                </div>

                <div class="sidebar col_last nobottommargin">

                    <address>
                        <strong>Davao Corporate Office:</strong><br>
                        CP Garcia Highway, Catitipan, <br>
                        Davao City Philippines, PH 8000<br>
                    </address>
                    <abbr title="Phone Number"><strong>Phone:</strong></abbr> (082) 235 0045 - Local 1123 <br>
                    <abbr title="Fax"><strong>Fax:</strong></abbr> (082) 233-2475 <br>
                    <abbr title="Email Address"><strong>Email:</strong></abbr> <a href="mailto:purchasing@philsaga.com"> purchasing@philsaga.com </a>
                    <br><br>
                    <address>
                        <strong>Agusan Office:</strong><br>
                        Bayugan 3, Rosario, Agusan Del Sur<br>
                        Philippines, PH 8504<br>
                    </address>
                    <abbr title="Phone Number"><strong>Phone:</strong></abbr> (082) 235 0045 - Local 3103 <br>
                    <abbr title="Email Address"><strong>Email:</strong></abbr> <a href="mailto:purchasing@philsaga.com"> purchasing@philsaga.com </a>
                    
                    <div class="widget noborder notoppadding" style="display:none;">

                        <a href="#" class="social-icon si-small si-dark si-facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-dark si-twitter">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-dark si-dribbble">
                            <i class="icon-dribbble"></i>
                            <i class="icon-dribbble"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-dark si-forrst">
                            <i class="icon-forrst"></i>
                            <i class="icon-forrst"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-dark si-pinterest">
                            <i class="icon-pinterest"></i>
                            <i class="icon-pinterest"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-dark si-gplus">
                            <i class="icon-gplus"></i>
                            <i class="icon-gplus"></i>
                        </a>

                    </div>

                </div>

               
            </div>
        </div>
    </section>
@endsection

@section('pagejs')
    <script>
        $('#contactUsForm').submit(function (e) {          
            e.preventDefault();
            let val = $('#concern').val();
            if(val == ''){
                $('#concern').addClass("has-error");
                $('#concernhelp').show();
                return false;
            }
            if (val == 1 || val == 2) {
                window.location.href = "{{route('sp.register')}}";
            }
            else{
                window.location.href = "{{route('main.contact_page')}}";
            }
            return false
        });


    </script>
@endsection
