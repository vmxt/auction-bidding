@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@endsection

@section('content')

    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Profile Update Request</h1>
            <span>Philsaga Mining Corporation</span>
            @if(Auth::user()->role_id == env('APPROVER_ID'))
                <ol class="breadcrumb">             
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Approver Portal</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $supplier_details ? $supplier_details->company_name : '' }}</li>                      
                </ol>
            @elseif(Auth::user()->role_id == env('EVALUATOR_ID'))
                <ol class="breadcrumb">             
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('evaluator.dashboard') }}">Evaluator Portal</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $supplier_details ? $supplier_details->company_name : '' }}</li>                      
                </ol>
            @else
                <ol class="breadcrumb">             
                    <li class="breadcrumb-item"><a href="{{ route('sms.auth.profile.view', \Auth()->user()->id) }}">My Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Update Request</li>                      
                </ol>
            @endif
        </div>
    </section>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                @php 

                    $sections = collect(['general information', 'business lines', 'officers', 'contact details', 'bank details', 
                    'goods and services', 'access credits', 'general requirements', 'certifications', 'controlled commodities' , 
                    'customers', 'financial status', 'paypment terms', 'attachments'
                    ])->chunk(4);

                @endphp  
    
                <div class="bs-stepper">
                
                    <div class="bs-stepper-header" role="tablist">

                        <div class="step" data-target="#select_section">
                            <button type="button" class="step-trigger" role="tab" aria-controls="select_section" id="select-section-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Select Sections</span>
                            </button>
                        </div>

                        <div class="line"></div>

                        <div class="step" data-target="#form_content">
                            <button type="button" class="step-trigger" role="tab" aria-controls="form_content" id="form-content-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Form</span>
                            </button>
                        </div>

                        <div class="line"></div>

                        <div class="step" data-target="#form_review">
                            <button type="button" class="step-trigger" role="tab" aria-controls="form_review" id="form-review-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Review</span>
                            </button>
                        </div>

                    </div>

                    <div class="bs-stepper-content">

                        <div id="select_section" class="content" role="tabpanel" aria-labelledby="select-section-trigger"> 

                            <h3 class="text-center"> Sections to Update </h3>
                            <br>
                            <div class="row">
                                @foreach( $sections as $section )

                                    <div class="col-3">
                                        
                                        @foreach( $section as $sec )
                                            <div class="form-group">
                                                
                                                <label for="{{ $sec }}">
                                                    <input type="checkbox" id="{{ $sec }}" class="sections" value="{{ $sec }}"> {{ $sec }}
                                                </label>

                                            </div>
                                        @endforeach
                                        
                                    </div>

                                @endforeach
                            </div>

                            <div class="col-12 ">
                                
                                <button onclick="firstStep()" class="btn btn-primary float-right"> Next </button>
                                
                            </div>

                            <div class="clear-fix"></div>

                        </div>

                        <div id="form_content" class="content" role="tabpanel" aria-labelledby="form-content-trigger">
                            
                            <div id="sis_content">
                                
                            </div>

                            <div class="nav_btn mt-5">
                                
                                <button class="btn btn-primary" onclick="$('#sis_content').empty(); stepper.previous(); count=0;"> Back </button>

                                <button class="btn btn-primary float-right" id="next_review"> Next </button>

                            </div>

                        </div>

                        <div id="form_review" class="content" role="tabpanel" aria-labelledby="form-review-trigger">
                            
                            <div id="update_review">
                                   
                                <h5 class="text-center"> Update Review </h5>

                                <div class="col-12">
                                    <div class="row"  id="update-holder">
                                      

                                    </div>
                                </div>

                            </div>

                            <div class="nav_btn mt-5">
                                
                                <button class="btn btn-primary" onclick="stepper.previous(); count=0; $('#update-holder').empty(); _sections = {};"> Back </button>

                                <button class="btn btn-primary float-right"> Submit </button>

                            </div>

                        </div>

                    </div>

                </div>



            </div>

        </div>

    </section>
    

@endsection

@section('pagejs')
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script type="text/javascript">

        var stepper = new Stepper(document.querySelector('.bs-stepper'));   
        var data = [];
        var sections = [];
        var _sections = [];
        var count = 0;
        var storage_url = "{!! asset('storage/images/supplier/profile') !!}"+"{!! Auth::id() !!}"+"/supplier-details/attachment/";

        function firstStep() {

            $('.sections').each(function() {

                if(this.checked) {                    

                    let _section = $(this).val().replaceAll(" ", "_").toLowerCase();           

                    $.ajax({
                        data: { 'section' : _section, '_token' : "{!! csrf_token() !!}" } ,
                        type: "POST",
                        url: "{{ route('request-update-sections') }}",
                        success: function(returnData) {
                            
                            count++;

                            data.push(_section);

                            $('#sis_content').append("<br>"+returnData);

                            if(count == 1) stepper.next();

                        },
                        async:false
                    });

                }

            });            
            

        }

        $(document).on('click', '#next_review', function () {

            secondStep();

        });


        function secondStep() {

            $.each(data, function( key, val) {

                switch(val) {

                    case "general_information":
                        getGeneralInformation();
                        break;

                    case "business_lines":
                        newBusiness_lines();
                        break;

                    case "officers":
                        getUpdatedOfficers();
                        break;

                    case "contact_details":
                        getContactDetails();
                        break;

                    case "bank_details":
                        getBankDetails();
                        break;

                    case "goods_and_services":
                        getGoodsAndServices();
                        break;

                    case "access_credits":
                        getAccessCredits();
                        break;

                    case "general_requirements":
                        getGeneralRequirements();
                        break;

                    case "certifications":
                        getCertifications();
                        break;

                    case "controlled_commodities":
                        getControlledComms();
                        break;

                    case "customers":
                        getCustomers();
                        break;

                    case "financial_status":
                        getFinancialStatus();
                        break;

                    case "paypment_terms":
                        getPaymentTerms();
                        break;

                }

            });

            var html = '';

            $.each(Object.keys(_sections), function(k,v) {

                var html = '';
                var count = 1;

                html += '<div class="col-md-12">';

                html += '<h5 class="bg-dark text-light p-2">'+ v.replaceAll("_", " ") +'</h5>';

                html += '<div class="table-responsive">';

                if( v != 'contact_details' && v != 'certifications' && v != 'customers' && v != 'general_information' ) {

                    html += '<table class="table table-bordered table-striped">';
                    html += '<tbody>';

                    $.each(_sections[v], function(k1,v1){
                        html += '<tr>';
                        for (const [key, value] of Object.entries(v1)) {
                            if(key != 'id'){
                                html += '<td><strong>'+ key +'</strong></td>';
                            }
                        }                    
                        html += '</tr>';

                        html += '<tr>';
                        for (const [key, value] of Object.entries(v1)) {
                            if(key != 'id'){
                                html += '<td>'+ value +'</td>';
                            }
                        }                    
                        html += '</tr>';
                    });
                } else if ( v == 'general_information' ) {

                    html += '<table class="table table-bordered table-striped">';

                    html += '<thead><tr>';
                    
                    for (const [key, value] of Object.entries(_sections[v])) {

                        if(Object.keys(value).length !== 0){
                            
                            html += '<td>'+ key +'</td>';
                            
                        }
                    }
                    
                    html += '</tr></thead>';

                    html += '<tbody><tr>';
                    
                    for (const [key, value] of Object.entries(_sections[v])) {

                        if(Object.keys(value).length !== 0){
                            
                            html += '<td>'+ value +'</td>';
                            
                        }
                    }
                    
                    html += '</tr></tbody>';

                } else if( v == 'contact_details' ) {

                    html += '<table class="table table-bordered table-striped">';
                    html += '<tbody>';

                    for (const [key, value] of Object.entries(_sections[v])) {

                        if(Object.keys(value).length !== 0){
                            html += '<tr><td colspan='+Object.keys(value).length+'>'+key+'</td></tr>';
                            html += '<tr>';
                            for (const [key1, value1] of Object.entries(value)) {
                                html += '<td>'+ key1 +'</td>';
                            }
                            html += '</tr>';
                            for (const [key1, value1] of Object.entries(value)) {
                                html += '<td>'+ value1 +'</td>';
                            }
                            html += '</tr>';
                        }

                    }

                } else if ( v == 'certifications' ) {
                    html += '<table class="table table-bordered table-striped">';
                    html += '<tbody>';
                    html += '<tr><td></td><td>Certification Number</td><td>Valid Until</td><td>Certifying Body</td><td>Action</td></tr>';
                    for (const [key, value] of Object.entries(_sections[v])) {

                        if(value.length !== 0){

                            $.each(value, function(k,v){
                                html += '<tr><td colspan="5">'+key+'</td></tr>';                                
                                html += '</tr><td></td>';
                                for (const [key1, value1] of Object.entries(v)) {
                                    if(key1 != 'id'){
                                        html += '<td>'+ value1 +'</td>';
                                    }
                                }
                                html += '</tr>';
                            });

                        }

                    }

                } else if( v == 'customers' ) {
                    html += '<table class="table table-bordered table-striped">';
                    html += '<thead><tr><td>Institution</td><td>Address</td><td>Contact Number</td><td>Email Address</td><td>Action</td></tr></thead>';
                    html += '<tbody>';
                    for (const [key, value] of Object.entries(_sections[v])) {

                        if(value.length !== 0){
                        html += '<tr><td colspan="5">'+key+'</td></tr>';                                
                            $.each(value, function(k,v){

                                html += '</tr>';
                                for (const [key1, value1] of Object.entries(v)) {
                                    if(key1 != 'id'){
                                        html += '<td>'+ value1 +'</td>';
                                    }
                                }
                                html += '</tr>';
                            });

                        }

                    }
                    html += '</tbody>';

                } 

                html += '</table>';

                html += '</div></div>';

                $('#update-holder').append(html);
            

            });

            

            stepper.next();

        }

    </script>

@endsection


