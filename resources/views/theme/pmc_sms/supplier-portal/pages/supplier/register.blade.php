@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/bs-filestyle.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/custom.css') }}" type="text/css" />
    <style type="text/css">
        .field-req {
            color: red;
        }

        .file-caption-name {
            font-family: 'Raleway', sans-serif;
            text-transform: uppercase;
            font-size: 14px;
        }
        ul.select2-selection__rendered {
            padding-right: 30px !important;
        }

        ul.select2-selection__rendered:after {
            content: "";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border-top: 5px solid #333;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
        }
    </style>
@endsection

@section('content')
@if(!Session::has('success'))
    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Supplier Registration</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Supplier Registration</a></li>                      
            </ol>
        </div>
    </section>
@endif

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">    
                @if(Session::has('success'))
                    <div class="row justify-content-md-center">                        
                        <div class="col-sm-6">
                            <div class="feature-box fbox-center fbox-bg fbox-light fbox-effect">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-line-check i-alt"></i></a>
                                </div>
                                <div class="fbox-content">
                                    <h3 class="text-success">Success<span class="subtitle text-secondary">We have received your application. Our representative will contact you via email for the next step of your application.</span></h3>
                                </div>
                            </div>
                        </div>                       
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <h3>Register
                            <br><span class="small">Carefully fill up the fields below. All information are required.</span></h3>
                            <h6> <span style="color: red; margin-bottom: 15px;font-size:16px;">Note: </span>Selected territory cannot be change once you submit the form. </h6>
                        </div>                    
                        <div class="col-lg-9">
                            <form method="POST" enctype="multipart/form-data" action="{{route('sp.submit-registration')}}" id="reg-form">
                                @csrf
                                <div class="form-group row">
                                    <label for="text" class="col-sm-4 col-form-label">Company Name:  <span class="field-req">*</span></label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_name') is-invalid @enderror reg_input" name="company_name" type="text" placeholder="" value="{{ old('company_name') }}" id="vendor_name_field">
                                        @hasError(['inputName' => 'company_name'])@endhasError
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-sm-4 col-form-label">Company Address: <span class="field-req">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control @error('company_address') is-invalid @enderror reg_input" name="company_address" rows="3">{{ old('company_address') }}</textarea>
                                        @hasError(['inputName' => 'company_address'])@endhasError
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="text" class="col-sm-4 col-form-label">Commodity: 
                                        <span class="field-req">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control reg_input" multiple="multiple" id="commodities" 
                                            name="commodities[]">                                       
                                          @forelse(\App\SupplierModels\SupplierCategoryMaster::orderBy('name')->get() as $c)
                                            <option value="{{$c->name}}">{{$c->name}}</option>
                                          @empty
                                          @endforelse
                                        </select>
                                        @hasError(['inputName' => 'commodities'])@endhasError
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-sm-4 col-form-label">Territory: <span class="field-req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary ls0 nott" for="new-application">
                                                <input type="radio" name="territory" autocomplete="off" value="Local" 
                                                @if(old('territory') == 'Local' || old('territory') == '') checked @endif> Local
                                            </label>
                                            <label class="btn btn-outline-secondary ls0 nott" for="update-information">
                                                <input type="radio" name="territory" autocomplete="off" value="Global" 
                                                @if(old('territory') == 'Global') checked @endif> Global
                                            </label>                                           
                                        </div>
                                         @hasError(['inputName' => 'territory'])@endhasError
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="field_wrapper8 mt-3">

                                    <div class="form-group row">
                                        <label for="text" class="col-sm-4 col-form-label">Contact Person: <span class="field-req">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control @error('contact_person') is-invalid @enderror reg_input" name="contact_person" type="text" value="{{ old('contact_person') }}">
                                            @hasError(['inputName' => 'contact_person'])@endhasError
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-sm-4 col-form-label">Designation: <span class="field-req">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control @error('designation') is-invalid @enderror reg_input" 
                                            name="designation" type="text" 
                                            value="{{ old('designation') }}">
                                            @hasError(['inputName' => 'designation'])@endhasError
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-sm-4 col-form-label">Email Address: <span class="field-req">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="email" 
                                            class="form-control email_ads @error('email') is-invalid @enderror reg_input" id="email_field" 
                                            name="email" placeholder="name@example.com" value="{{ old('email') }}">
                                            @hasError(['inputName' => 'email'])@endhasError
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);" class="add_button8 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                    </div>
                                </div>

                                <hr>
                                
                                <!-- <div class="form-group row">
                                    <label for="upload" class="col-sm-4 col-form-label">Insert product samples: <span class="field-req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary ls0 nott" for="uploadImg">
                                                <input type="radio" name="uploads" id="uploadImg" value="Upload Image" onclick="ShowHideDiv2()" 
                                                @if(old('uploads') == 'Upload Image') checked @endif> Attached Items
                                            </label>
                                            <label class="btn btn-outline-secondary ls0 nott" for="uploadURL">
                                                <input type="radio" name="uploads" id="uploadURL" value="Upload URL" onclick="ShowHideDiv2()"
                                                @if(old('uploads') == 'Upload URL') checked @endif> Insert URL
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="upURL" style="display:none">
                                    <div class="field_wrapper11">
                                        <div class="upload">
                                            <div class="form-group row">
                                                <label for="text" class="col-md-4 col-form-label">Product URL:</label>
                                                <div class="col-md-7 col-9">
                                                    <input type="text" name="product_url1" id="product_url1" class="form-control required url @error('product_url1') is-invalid @enderror" placeholder="https://" >
                                                    @hasError(['inputName' => 'product_url1'])@endhasError
                                                </div>
                                                <div class="col-md-1 col-3 text-right">
                                                    <a href="javascript:void(0);" class="remove_button11 btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></a>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <a href="javascript:void(0);" class="add_button11 btn btn-success mt-2 btn-xs" title="Add field">Add Product <i class="icon-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="upIMG" style="display: none">
                                    <div class="row ">
                                        <div class="col-lg-8 bottommargin">
                                            <label class="small">Upload sample products, brochures, etc.</label><br>
                                            <input id="input-3" name="input2[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" onchange="fildeValidation()" accept="image/jpeg, image/png, application/pdf">
                                            @hasError(['inputName' => 'input2'])@endhasError
                                        </div>
                                        <div class="col-lg-4 bottommargin">
                                            <label class="small">Description</label><br>
                                            <textarea name="prod_description" id="prod_description" class="form-control @error('prod_description') is-invalid @enderror" placeholder="Input product description, prices, sizes, etc." cols="30" rows="12"></textarea>
                                            @hasError(['inputName' => 'prod_description'])@endhasError
                                        </div>
                                    </div>         
                                </div> -->
                                
                                <div class="form-group row">
                                    
                                    <label for="text" class="col-sm-4 col-form-label">LIST SAMPLE PRODUCTS: <span class="field-req">*</span></label>
                                    <div class="col-sm-8">
                                        <label class="small">(Please separate each product in a new line)</label>
                                        <textarea class="form-control @error('product_list') is-invalid @enderror reg_input" rows="5" name="product_list">{{ old('product_list') }}</textarea>
                                        @hasError(['inputName' => 'product_list'])@endhasError
                                    </div>

                                </div>

                                <div class="form-check row">
                                    <div class="col-sm-8 offset-md-4 mt-3 pl-4">
                                        <input class="form-check-input" type="checkbox" id="defaultCheck1" required="required">
                                        <label class="form-check-label" for="defaultCheck1">
                                            I hereby attest to the correctness and accuracy of the information given above. 
                                        </label>
                                    </div>
                                </div>
                                <br>
                                

                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-10 text-center">
                                        <button type="submit" class="btn btn-primary" id="btn-reg">Register</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3">
                            <div class="border rounded p-3">
                                <div class="style-msg alertmsg">
                                    <div class="sb-msg"><i class="icon-warning-sign"></i>By submitting your data, you agree to our <a href="/sp/terms-and-conditions">Terms</a>  and that you have read our <a href="/sp/privacy-policy">Data Use Policy</a>.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>

        </div>

    </section>
    
   
@endsection

@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>

    <script type="text/javascript">
        var _route_email = "{!! route('validate.email') !!}";
        var _token = "{!! csrf_token() !!}";
        var input_valid = true;

        function checkEmailExist(email, evt) {

            $.ajax({
                data: {"email" : email, "_token" : _token},
                type: "POST",
                url: "{!! route('validate.email') !!}",
                success: function(returnData) {

                        _html  = '<span class="invalid-feedback" role="alert" style="display: block;">';
                        _html += '<strong>The email is already taken.</strong></span>';

                    if(returnData.exist) {
                        $(evt).addClass('is-invalid');  
                        if(!$(evt).siblings("span").hasClass('invalid-feedback')) 
                            $(evt).parent().append(_html);                        
                    } else {
                        $(evt).removeClass('is-invalid');  
                        if($(evt).siblings("span").hasClass('invalid-feedback'))
                            $(evt).siblings("span").remove();                        
                    }
                }

            });

        }

        function checkVendorExist(name) {

            $.ajax({
                data: {"name" : name, "_token" : _token},
                type: "POST",
                url: "{!! route('validate.vendor') !!}",
                success: function(returnData) {

                        _html  = '<span class="invalid-feedback" role="alert" style="display: block;">';
                        _html += '<strong>The vendor name is already taken.</strong></span>';

                    if(returnData.exist) {
                        $('#vendor_name_field').addClass('is-invalid');  
                        input_valid = false;
                        if(!$('#vendor_name_field').siblings("span").hasClass('invalid-feedback')) 
                            $('#vendor_name_field').parent().append(_html);                        
                    } else {
                        $('#vendor_name_field').removeClass('is-invalid');  
                        input_valid = true;
                        if($('#vendor_name_field').siblings("span").hasClass('invalid-feedback')) 
                            $('#vendor_name_field').siblings("span").remove();
                    }
                }

            });

        }

    </script>
    <script type="text/javascript" src="{{ asset('js/data/register_data.js') }}"></script>
@endsection


