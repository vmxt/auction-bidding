@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <style type="text/css">
        .field-req {
            color: #ffffff;
        }
        .field-req1 {
            color: red;
        }        
    </style>
@endsection

@section('content')

    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Becoming A Supplier</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('sms.auth.profile.view', \Auth()->user()->id) }}">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Profile</li>                      
            </ol>
        </div>
    </section>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">
                    <div class="form-widget">

                        @php 
                            $b_type = ['contractor', 'manufacturer', 'distributor', 'trader'];
                            if($supplier_details) {
                                $sd_type = in_array($supplier_details->business_type, $b_type) ? $supplier_details->business_type:'other';
                            } else {
                                $sd_type = 'manufacturer';   
                            }
                        @endphp

                        <div class="form-result"></div>

                        <form id="supplier_form" action="{{ route('sms.auth.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="h_officers" id="h_officers">
                            <input type="hidden" name="h_bank_details" id="h_bank_details">
                            <input type="hidden" name="h_cqualities" id="h_cqualities">
                            <input type="hidden" name="h_cenveronmentals" id="h_cenveronmentals">
                            <input type="hidden" name="h_csafety" id="h_csafety">
                            <input type="hidden" name="h_cothers" id="h_cothers">
                            <input type="hidden" name="h_mc" id="h_mc">
                            <input type="hidden" name="h_clty" id="h_clty">
                            <input type="hidden" name="h_ac" id="h_ac">
                            <input type="hidden" name="h_services" id="h_services">
                            <input type="hidden" name="h_genreq" id="h_genreq">
                            <input type="hidden" name="h_controlled_comms" id="h_controlled_comms">
                            <input type="hidden" name="h_fs" id="h_fs">
                            <input type="hidden" name="h_bli" id="h_bli">
                            <input type="hidden" name="market_territory" value="{{$applicant->territory}}">
                            <input type="hidden" name="h_pt" id="h_pt">

                            <input type="hidden" name="h_cles" id="h_cles">
                            <input type="hidden" name="h_certss" id="h_certss">
                            <input type="hidden" name="h_is_one_time" value="1">


                            <div class="form-process"></div>
                            <div class="col-lg-12">
                                <div class="row checkout-form-billing">
                                    <div class="col-12">
                                        <h3>Supplier Information Form <br><span class="small">(For Supplier Accreditation)</span></h3>
                                    </div>
                                    <div class="col-md-6 form-group" style="display:none;">
                                        <label class="bg-dark text-light p-2">Type:</label><br>
                                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary ls0 nott" for="new-application">
                                                <input type="radio" name="new-application" id="new-application" autocomplete="off" @if(is_null($user->supplier_details)) checked @endif > New Application
                                            </label>
                                            <label class="btn btn-outline-secondary ls0 nott" for="update-information">
                                                <input type="radio" name="update-information" id="update-information" autocomplete="off" @if($user->supplier_details) checked @endif> Update Information
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">A. General Information</h4>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2"> Company Name: <span class="field-req">*</span></label>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <input type="text" readonly class="form-control" placeholder="Name" id="name" name="name" value="{{ $applicant->name }}">  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2"> Territory: <span class="field-req">*</span></label>
                                        <div class="row">
                                            <div class="col-md-12 form-group">                                                
                                              <input type="text" readonly class="form-control" value="{{ $applicant->territory }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Address: <span class="field-req">*</span></label>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <select class="form-control @if($user->is_one_time == 0) required @endif" id="country" name="country"></select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="Province" id="province" name="province" value="{{ old('province', $supplier_details ? $supplier_details->province:'') }}">
                                                <select class="form-control" id="local-province" name="local_province"></select>
                                            </div>  
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="City Municipality" id="city" name="city" value="{{ old('city', $supplier_details ? $supplier_details->city:'') }}">
                                                <select class="form-control" id="local-city" name="local_city"></select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="Barangay" id="barangay" name="barangay" value="{{ old('barangay', $supplier_details ? $supplier_details->barangay:'') }}">
                                                <select class="form-control" id="local-barangay" name="local_barangay"></select>
                                            </div>                                            
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="Room/Floor/Unit No./Bldg Name" id="unit" name="unit" value="{{ old('unit', $supplier_details ? $supplier_details->unit:'') }}">                                                
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="House/Lot/Block/Phase No." id="block" name="block" value="{{ old('block', $supplier_details ? $supplier_details->block:'') }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="Street Name" id="street" name="street" value="{{ old('street', $supplier_details ? $supplier_details->street:'') }}">
                                            </div>                                    
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" placeholder="Zip Code" id="zip" name="zip" value="{{ old('zip', $supplier_details ? $supplier_details->zip:'') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2" for="tax-indentification-num"> Tax Identification Number: <span class="field-req">*</span></label><br>
                                        <input type="text" name="tin" id="tin" class="form-control  @error('tin') is-invalid @enderror" value="{{ old('tin', $supplier_details ? $supplier_details->tin:'') }}" placeholder="TIN #">
                                        @hasError(['inputName' => 'tin'])@endhasError
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Business Style: <span class="field-req">*</span></label>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                              <input type="text" class="form-control" id="business-style" name="business_style" value="{{ old('business_style', $supplier_details ? $supplier_details->business_style:'') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="bg-dark text-light p-2" for="business-entity-type">Business Entity Type: <span class="field-req">*</span></label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @if($user->is_one_time == 0) required @endif" checked type="radio" name="vat_registered" 
                                                @if(old('vat_registered', $supplier_details ? $supplier_details->vat_registered:0) == 1) checked @endif id="vat-registered1" value="1">
                                            <label class="form-check-label nott" for="vat-registered1">VAT Registered</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" @if(old('vat_registered', $supplier_details ? $supplier_details->vat_registered:0) == 0) checked @endif name="vat_registered" id="vat-registered2" value="0">
                                            <label class="form-check-label nott" for="vat-registered2">Non-VAT Registered</label>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2" for="date-established">Date Established: <span class="field-req">*</span></label>
                                        <input type="text" class="form-control datepicker @error('date_established') is-invalid @enderror" name="date_established" id="date-established" value="{{ old('date_established', $supplier_details ? $supplier_details->date_established:'') }}" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="0d">
                                        @hasError(['inputName' => 'date_established'])@endhasError
                                    </div>
                                    
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2" for="company-website">Company Website (if any):</label>
                                        <input type="text" name="website" id="company-website" class="form-control @if($user->is_one_time == 0) required @endif url" placeholder="https://" value="{{ old('website', $supplier_details ? $supplier_details->website:'') }}">
                                    </div>
                                    <div class="col-12 form-group">
                                        
                                        <h5 class="bg-secondary text-light p-3">Business line or Industry</h5>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="row">

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="aerospace" id="aerospace" name="business_line[]">
                                                            <label class="form-check-label" for="aerospace">
                                                                aerospace industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="transport" id="transport" name="business_line[]">
                                                            <label class="form-check-label" for="transport">
                                                                transport industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="computer" id="computer" name="business_line[]">
                                                            <label class="form-check-label" for="computer">
                                                                computer industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="telecommunication" id="telecommunication" name="business_line[]">
                                                            <label class="form-check-label" for="telecommunication">
                                                                telecommunication industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="agriculture" id="agriculture" name="business_line[]">
                                                            <label class="form-check-label" for="agriculture">
                                                                agriculture industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="construction" id="construction" name="business_line[]">
                                                            <label class="form-check-label" for="construction">
                                                                construction industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="education" id="education" name="business_line[]">
                                                            <label class="form-check-label" for="education">
                                                                education industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="pharmaceutical" id="pharmaceutical" name="business_line[]">
                                                            <label class="form-check-label" for="pharmaceutical">
                                                                pharmaceutical industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="food" id="food" name="business_line[]">
                                                            <label class="form-check-label" for="food">
                                                                food industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="health care" id="health_care" name="business_line[]">
                                                            <label class="form-check-label" for="health_care">
                                                                health care industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="hospital" id="hospital" name="business_line[]">
                                                            <label class="form-check-label" for="hospital">
                                                                hospital industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="entertainment" id="entertainment" name="business_line[]">
                                                            <label class="form-check-label" for="entertainment">
                                                                entertainment industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="news media" id="news_media" name="business_line[]">
                                                            <label class="form-check-label" for="news_media">
                                                                news media industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="energy" id="energy" name="business_line[]">
                                                            <label class="form-check-label" for="energy">
                                                                energy industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="manufacturing" id="manufacturing" name="business_line[]">
                                                            <label class="form-check-label" for="manufacturing">
                                                                manufacturing industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="music" id="music" name="business_line[]">
                                                            <label class="form-check-label" for="music">
                                                                music industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="mining" id="mining" name="business_line[]">
                                                            <label class="form-check-label" for="mining">
                                                                mining industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="world wide web" id="world_wide_web" name="business_line[]">
                                                            <label class="form-check-label" for="world_wide_web">
                                                                world wide web industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="electronic" id="electronic" name="business_line[]">
                                                            <label class="form-check-label" for="electronic">
                                                                electronic industry
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services bli" type="checkbox" value="others" id="business_line_others" name="business_line[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="business_line_others">
                                                                Others, please specify
                                                            </label>
                                                        </div>

                                                        <div id="business_line_others_field_wrap" style="display:none; margin-top: 5px;">
                                                            <div class="business_line_others_field_wrapper">
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <input type="text" id="business_line_others_otherss" class="business_line_others_othersss form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:void(0);" class="bli_others_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Classification of business: <span class="field-req">*</span></label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @if($user->is_one_time == 0) required @endif" type="radio" checked name="business_type" id="business-type1" value="manufacturer" onclick="ShowHideDiv()" @if(old('business_type', $sd_type)=='manufacturer') checked @endif >
                                            <label class="form-check-label nott" for="business-type1">Manufacturer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="business_type" id="business-type2" value="trader" onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'trader') checked @endif>
                                            <label class="form-check-label nott" for="business-type2">Trader</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="business_type" id="business-type3" value="distributor" onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'distributor') checked @endif>
                                            <label class="form-check-label nott" for="business-type3">Distributor</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="business_type" id="business-type4" value="contractor" onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'contractor') checked @endif>
                                            <label class="form-check-label nott" for="business-type4">Contractor</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="business_type" id="business-type5" value="other" 
                                            onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'other') checked @endif>
                                            <label class="form-check-label nott" for="business-type5">Others, please specify:</label>
                                        </div>
                                        <br/>
                                        <input type="text" name="other_business_type" id="other-business-type" class="form-control @if($user->is_one_time == 0) required @endif mt-2" value="{{ old('other_business_type', $sd_type == 'other' ? $supplier_details->business_type:'') }}" style="display: @if(old('business_type', $sd_type) == 'other') block @else none @endif">
                                    </div>

                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Business organization form: <span class="field-req">*</span></label><br>
                                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                            @php
                                                $org_typpe = [
                                                    'sole proprietorship', 'one person corporation', 'partnership', 'corporation', 'limited liability company',
                                                    'cooperative', 'multi national companies', 'none profit organization', 'francise', 'trust'
                                                ];
                                            @endphp
                                            <select class="form-control" name="organization_type" id="organization_type">
                                                    <option value="">Select Organization Type</option>
                                                @foreach( $org_typpe as $type)
                                                    <option value="{{$type}}" 
                                                    @if(old('organization_type',$supplier_details ? $supplier_details->organization_type:'') == $type) selected @endif>{{ ucwords($type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="bg-dark text-light p-2">Officers: <span class="field-req">*</span>
                                        (at least 1 complete with name and position)</label><br>
                                        <div class="field_wrapper" id="officers-field-wrapper">
                                            <div class="row off_wrap">
                                                <div class="col-md-6 form-group">
                                                  <input type="text" class="form-control" placeholder="Name" id="officer_name" name="officer_name">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                  <input type="text" class="form-control" placeholder="Position" id="officer_position" name="officer_position">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="bg-dark text-light p-2">Contact Details: <span class="field-req">*</span></label><br>
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-4 form-group">
                                                
                                                <label class="bg-info text-light p-2 label-warning">Customer Service</label>
                                            
                                                <div class="form-group">
                                                    <label for="cs_name"> Contact Person (name) </label>
                                                    <input type="text" name="cs_name" id="contact-person-name" class="form-control valid" value="{{ old('cs_name', $supplier_contact_cs ? $supplier_contact_cs->name:'') }}" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_position"> Position </label>
                                                    <input type="text" name="cs_position" id="contact-person-name1" class="form-control valid" value="{{ old('cs_position', $supplier_contact_cs ? $supplier_contact_cs->position:'') }}" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_email"> Email </label>
                                                    <input type="email" name="cs_email" id="contact-person-name2" class="form-control @error('cs_email') is-invalid @enderror" value="{{ old('cs_email', $supplier_contact_cs ? $supplier_contact_cs->email:'') }}" placeholder="">
                                                    @hasError(['inputName' => 'cs_email'])@endhasError
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_telephone"> Telephone Number </label>
                                                    <input type="text" name="cs_telephone" id="contact-person-name3" class="form-control valid" value="{{ old('cs_telephone', $supplier_contact_cs ? $supplier_contact_cs->telephone_no:'') }}" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_mobile"> Mobile Number </label>
                                                    <input type="text" name="cs_mobile" id="contact-person-name5" class="form-control valid" value="{{ old('cs_mobile', $supplier_contact_cs ? $supplier_contact_cs->mobile_no:'') }}" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_fax"> Fax Number </label>
                                                    <input type="text" name="cs_fax" id="contact-person-name4" class="form-control valid" value="{{ old('cs_fax', $supplier_contact_cs ? $supplier_contact_cs->fax_no:'') }}" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_skype"> Skype </label>
                                                    <input type="text" name="cs_skype" id="contact-person-name6" class="form-control valid" value="{{ old('cs_skype', $supplier_contact_cs ? $supplier_contact_cs->skype:'') }}" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cs_others"> Others </label>
                                                    <input type="text" name="cs_others" id="contact-person-name7" class="form-control valid" value="{{ old('cs_others', $supplier_contact_cs ? $supplier_contact_cs->others:'') }}" placeholder="">
                                                </div>                                                

                                            </div>

                                            <div class="col-md-4 form-group">
                                               
                                               <label class="bg-info text-light p-2 label-warning">Sales</label>

                                               <div class="form-group">
                                                    <label for="sales_name"> Contact Person (name) </label>
                                                    <input type="text" name="sales_name" id="contact-person-sale" class="form-control valid" value="{{ old('sales_name', $supplier_contact_sales ? $supplier_contact_sales->name:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_position"> Position </label>
                                                    <input type="text" name="sales_position" id="contact-person-sale1" class="form-control valid" value="{{ old('sales_position', $supplier_contact_sales ? $supplier_contact_sales->position:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_email"> Email </label>
                                                    <input type="email" name="sales_email" id="contact-person-sale2" class="form-control @error('sales_email') is-invalid @enderror" value="{{ old('sales_email', $supplier_contact_sales ? $supplier_contact_sales->email:'') }}" >
                                                    @hasError(['inputName' => 'sales_email'])@endhasError
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_telephone"> Telephone Number </label>
                                                    <input type="text" name="sales_telephone" id="contact-person-sale3" class="form-control valid" value="{{ old('sales_telephone', $supplier_contact_sales ? $supplier_contact_sales->telephone_no:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_mobile"> Mobile Number </label>
                                                    <input type="text" name="sales_mobile" id="contact-person-sale5" class="form-control valid" value="{{ old('sales_mobile', $supplier_contact_sales ? $supplier_contact_sales->mobile_no:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_fax"> Fax Number </label>
                                                    <input type="text" name="sales_fax" id="contact-person-sale4" class="form-control valid" value="{{ old('sales_fax', $supplier_contact_sales ? $supplier_contact_sales->fax_no:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_skype"> Skype </label>
                                                    <input type="text" name="sales_skype" id="contact-person-sale6" class="form-control valid" value="{{ old('sales_skype', $supplier_contact_sales ? $supplier_contact_sales->skype:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="sales_others"> Others </label>
                                                    <input type="text" name="sales_others" id="contact-person-sale7" class="form-control valid" value="{{ old('sales_others', $supplier_contact_sales ? $supplier_contact_sales->others:'') }}" >
                                                </div>

                                                

                                            </div>

                                            <div class="col-md-4 form-group">
                                                
                                                <label class="bg-info text-light p-2 label-warning">Accounting</label>

                                                <div class="form-group">
                                                    <label for="accounting_name"> Contact Person (name) </label>
                                                    <input type="text" name="accounting_name" id="contact-person-accnt" class="form-control valid" value="{{ old('accounting_name', $supplier_contact_accounting ? $supplier_contact_accounting->name:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_position"> Position </label>
                                                    <input type="text" name="accounting_position" id="contact-person-accnt1" class="form-control valid" value="{{ old('accounting_position', $supplier_contact_accounting ? $supplier_contact_accounting->position:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_email"> Email </label>
                                                    <input type="email" name="accounting_email" id="contact-person-accnt2" class="form-control @error('accounting_email') is-invalid @enderror" value="{{ old('accounting_email', $supplier_contact_accounting ? $supplier_contact_accounting->email:'') }}" >
                                                    @hasError(['inputName' => 'accounting_email'])@endhasError
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_telephone"> Telephone Number </label>
                                                    <input type="text" name="accounting_telephone" id="contact-person-accnt3" class="form-control valid" value="{{ old('accounting_telephone', $supplier_contact_accounting ? $supplier_contact_accounting->telephone_no:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_mobile"> Mobile Number </label>
                                                    <input type="text" name="accounting_mobile" id="contact-person-accnt5" class="form-control valid" value="{{ old('accounting_mobile', $supplier_contact_accounting ? $supplier_contact_accounting->mobile_no:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_fax"> Fax Number </label>
                                                    <input type="text" name="accounting_fax" id="contact-person-accnt4" class="form-control valid" value="{{ old('accounting_fax', $supplier_contact_accounting ? $supplier_contact_accounting->fax_no:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_skype"> Skype </label>
                                                    <input type="text" name="accounting_skype" id="contact-person-accnt6" class="form-control valid" value="{{ old('accounting_skype', $supplier_contact_accounting ? $supplier_contact_accounting->skype:'') }}" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="accounting_others"> Others </label>
                                                    <input type="text" name="accounting_others" id="contact-person-accnt7" class="form-control valid" value="{{ old('accounting_others', $supplier_contact_accounting ? $supplier_contact_accounting->others:'') }}" >
                                                </div>

                                            </div>

                                        </div>
                                        
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Bank Details: <span class="field-req">*</span></label><br>
                                        <div class="field_wrapper20">

                                            <div class="row bank_wrap">
                                                <div class="col-sm-6">
                                                    <label for="bank_option"> Payment Option Name: </label>
                                                    <select name="bank_option" class="form-control" id="bank_option">

                                                        @foreach( Setting::availableBanks() as $key => $bank )
                                                            <option value=""> Select Bank </option>
                                                            <optgroup label="{{$key}}">
                                                                @foreach($bank as $b)
                                                                    <option value="{{strtolower($b)}}">{{ ucfirst($b) }}</option>
                                                                @endforeach
                                                            </optgroup>  

                                                        @endforeach

                                                    </select>                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="account_name"> Account Name: </label>
                                                    <input type="text" id="account_name" name="account_name" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <a href="javascript:void(0);" class="add_button20 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">B. Goods and Services <span style="color: #ffffff;">*</span></h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="chemicals lab equipment and supplies" id="chemicals_lab_equipment_and_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="chemicals_lab_equipment_and_supplies">
                                                                chemicals lab equipment and supplies
                                                            </label>
                                                        </div>
                                                        <div id="chemicals_lab_equipment_and_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                
                                                                    <input class="form-check-input form-services chemicals_lab_equipment_and_supplies_selectable" type="checkbox" value="reagents" id="reagents" name="cles[]"> 
                                                                    <label class="form-check-label" for="reagents"><small>reagents </small></label> <br>

                                                                    <input class="form-check-input form-services chemicals_lab_equipment_and_supplies_selectable" type="checkbox" value="lab machines and equipment" id="lab_machines_and_equipment" name="cles[]"> 
                                                                    <label class="form-check-label" for="lab_machines_and_equipment"><small>lab machines and equipment </small></label> <br>

                                                                    <input class="form-check-input form-services chemicals_lab_equipment_and_supplies_selectable" type="checkbox" value="cyanide" id="cyanide" name="cles[]"> 
                                                                    <label class="form-check-label" for="cyanide"><small>cyanide </small></label> <br>

                                                                    <input class="form-check-input form-services chemicals_lab_equipment_and_supplies_selectable" type="checkbox" value="oil and lubes" id="oil_and_lubes" name="cles[]"> 
                                                                    <label class="form-check-label" for="oil_and_lubes"><small>oil and lubes </small></label> <br>

                                                                    <input class="form-check-input form-services chemicals_lab_equipment_and_supplies_selectable" type="checkbox" value="fuel" id="fuel" name="cles[]"> 
                                                                    <label class="form-check-label" for="fuel"><small>fuel </small></label> <br>
                                                                    
                                                                    <input class="form-check-input form-services chemicals_lab_equipment_and_supplies_selectable" type="checkbox" value="others" id="chemicals_lab_equipment_and_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="chemicals_lab_equipment_and_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="chemicals_lab_equipment_and_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="chemicals_lab_equipment_and_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="chemicals_lab_equipment_and_supplies_otherss_1" class="chemicals_lab_equipment_and_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="electrical and instrumentation supplies" id="electrical_and_instrumentation_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="electrical_and_instrumentation_supplies">
                                                                electrical and instrumentation supplies
                                                            </label>
                                                        </div>
                                                        <div id="electrical_and_instrumentation_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services electrical_and_instrumentation_supplies_selectable" type="checkbox" value="lightings and accessories" id="lightings_and_accessories" name="eis[]"> 
                                                                    <label class="form-check-label" for="lightings_and_accessories"> <small> lightings and accessories</small> </label> <br>

                                                                    <input class="form-check-input form-services electrical_and_instrumentation_supplies_selectable" type="checkbox" value="instrumentation" id="instrumentation" name="eis[]"> 
                                                                    <label class="form-check-label" for="instrumentation"> <small> instrumentation</small> </label> <br>

                                                                    <input class="form-check-input form-services electrical_and_instrumentation_supplies_selectable" type="checkbox" value="electrical tools and equipment" id="electrical_tools_and_equipment" name="eis[]"> 
                                                                    <label class="form-check-label" for="electrical_tools_and_equipment"> <small> electrical tools and equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services electrical_and_instrumentation_supplies_selectable" type="checkbox" value="power cables and wires" id="power_cables_and_wires" name="eis[]"> 
                                                                    <label class="form-check-label" for="power_cables_and_wires"> <small> power cables and wires</small> </label> <br>

                                                                    <input class="form-check-input form-services electrical_and_instrumentation_supplies_selectable" type="checkbox" value="others" id="electrical_and_instrumentation_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="electrical_and_instrumentation_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="electrical_and_instrumentation_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="electrical_and_instrumentation_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="electrical_and_instrumentation_supplies_otherss_1"  class="electrical_and_instrumentation_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button1 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="explosives and accessories" id="explosives_and_accessories" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="explosives_and_accessories">
                                                                explosives and accessories
                                                            </label>
                                                        </div>

                                                        <div id="explosives_and_accessories_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services explosives_and_accessories_selectable" type="checkbox" value="explosives" id="explosives" name="eaa[]"> 
                                                                    <label class="form-check-label" for="explosives"> <small> explosives</small> </label> <br>

                                                                    <input class="form-check-input form-services explosives_and_accessories_selectable" type="checkbox" value="explosive accessories" id="explosive_and_accessories" name="eaa[]"> 
                                                                    <label class="form-check-label" for="explosive_and_accessories"><small>explosive and accessories</small> </label> <br>

                                                                    <input class="form-check-input form-services explosives_and_accessories_selectable" type="checkbox" value="others" id="explosives_and_accessories_others" name="eaa[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="explosives_and_accessories_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="explosives_and_accessories_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="explosives_and_accessories_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="explosives_and_accessories_otherss_1"  class="explosives_and_accessories_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button2 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="food household appliance housekeeping and general supplies" id="food_household_appliance_housekeeping_and_general_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="food_household_appliance_housekeeping_and_general_supplies">
                                                                food household appliance housekeeping and general supplies                                                                
                                                            </label>
                                                        </div>
                                                        <div id="food_household_appliance_housekeeping_and_general_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services food_household_appliance_housekeeping_and_general_supplies_selectable" type="checkbox" value="food and beverages" id="food_and_beverages" name="fhahgs[]"> 
                                                                    <label class="form-check-label" for="food_and_beverages"> <small>food and beverages</small> </label> <br>

                                                                    <input class="form-check-input form-services food_household_appliance_housekeeping_and_general_supplies_selectable" type="checkbox" value="household appliances" id="household_appliances" name="fhahgs[]"> 
                                                                    <label class="form-check-label" for="household_appliances"> <small>household appliances</small> </label> <br>

                                                                    <input class="form-check-input form-services food_household_appliance_housekeeping_and_general_supplies_selectable" type="checkbox" value="kitchen and laundry supplies" id="kitchen_and_laundry_supplies" name="fhahgs[]"> 
                                                                    <label class="form-check-label" for="kitchen_and_laundry_supplies"> <small>kitchen and laundry supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services food_household_appliance_housekeeping_and_general_supplies_selectable" type="checkbox" value="housekeeping essentials and supplies" id="housekeeping_essentials_and_supplies" name="fhahgs[]"> <label class="form-check-label" for="housekeeping_essentials_and_supplies"> <small>housekeeping essentials and supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services food_household_appliance_housekeeping_and_general_supplies_selectable" type="checkbox" value="others" id="food_household_appliance_housekeeping_and_general_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="food_household_appliance_housekeeping_and_general_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="food_household_appliance_housekeeping_and_general_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="food_household_appliance_housekeeping_and_general_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="food_household_appliance_housekeeping_and_general_supplies_otherss_1"  class="food_household_appliance_housekeeping_and_general_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button3 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="hardware and construction supplies" id="hardware_and_construction_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="hardware_and_construction_supplies">
                                                                hardware and construction supplies                                                              
                                                            </label>
                                                        </div>
                                                        <div id="hardware_and_construction_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services hardware_and_construction_supplies_selectable" type="checkbox" value="handware supplies" id="handware_supplies" name="hcs[]"> 
                                                                    <label class="form-check-label" for="handware_supplies"> <small>handware supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services hardware_and_construction_supplies_selectable" type="checkbox" value="aggregates and culvert" id="aggregates_and_culvert" name="hcs[]"> 
                                                                    <label class="form-check-label" for="aggregates_and_culvert"> <small>aggregates and culvert</small> </label> <br>

                                                                    <input class="form-check-input form-services hardware_and_construction_supplies_selectable" type="checkbox" value="others" id="hardware_and_construction_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="hardware_and_construction_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="hardware_and_construction_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="hardware_and_construction_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="hardware_and_construction_supplies_otherss_1"  class="hardware_and_construction_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button4 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="information and communication technology" id="information_and_communication_technology" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="information_and_communication_technology">
                                                                information and communication technology                                                                
                                                            </label>
                                                        </div>
                                                        <div id="information_and_communication_technology_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services information_and_communication_technology_selectable" type="checkbox" value="servers and parts" id="servers_and_parts" name="ict[]"> 
                                                                    <label class="form-check-label" for="servers_and_parts"> <small>servers and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services information_and_communication_technology_selectable" type="checkbox" value="computers and parts" id="computers_and_parts" name="ict[]"> 
                                                                    <label class="form-check-label" for="computers_and_parts"> <small>computers and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services information_and_communication_technology_selectable" type="checkbox" value="printers and parts" id="printers_and_parts" name="ict[]"> 
                                                                    <label class="form-check-label" for="printers_and_parts"> <small>printers and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services information_and_communication_technology_selectable" type="checkbox" value="cctv and accessories" id="cctv_and_accessories" name="ict[]"> 
                                                                    <label class="form-check-label" for="cctv_and_accessories"> <small>cctv and accessories</small> </label> <br>

                                                                    <input class="form-check-input form-services information_and_communication_technology_selectable" type="checkbox" value="softwares and licenses" id="softwares_and_licenses" name="ict[]"> <label class="form-check-label" for="softwares_and_licenses"> <small>softwares and licenses</small> </label> <br>

                                                                    <input class="form-check-input form-services information_and_communication_technology_selectable" type="checkbox" value="others" id="information_and_communication_technology_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="information_and_communication_technology_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="information_and_communication_technology_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="information_and_communication_technology_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="information_and_communication_technology_otherss_1"  class="information_and_communication_technology_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button5 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="mechanical machineries equipment and supplies" id="mechanical_machineries_equipment_and_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="mechanical_machineries_equipment_and_supplies">
                                                                mechanical machineries equipment and supplies
                                                            </label>
                                                        </div>
                                                        <div id="mechanical_machineries_equipment_and_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="transport and mobile equipment and replacement parts" id="transport_and_mobile_equipment_and_replacement_parts" name="mmes[]"> 
                                                                    <label class="form-check-label" for="transport_and_mobile_equipment_and_replacement_parts"> <small>transport and mobile equipment and replacement parts</small> </label> <br>

                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="heavy equipment and replacement parts" id="heavy_equipment_and_replacement_parts" name="mmes[]"> 
                                                                    <label class="form-check-label" for="heavy_equipment_and_replacement_parts"> <small>heavy equipment and replacement parts</small> </label> <br>

                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="automotive machines and parts" id="automotive_machines_and_parts" name="mmes[]"> 
                                                                    <label class="form-check-label" for="automotive_machines_and_parts"> <small>automotive machines and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="lifting machines and parts" id="lifting_machines_and_parts" name="mmes[]"> 
                                                                    <label class="form-check-label" for="lifting_machines_and_parts"> <small>lifting machines and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="rock drilling machines and parts" id="rock_drilling_machines_and_parts" name="mmes[]"> 
                                                                    <label class="form-check-label" for="rock_drilling_machines_and_parts"> <small>rock drilling machines and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="locomotive and parts" id="locomotive_and_parts" name="mmes[]"> <label class="form-check-label" for="locomotive_and_parts"> <small>locomotive and parts</small> </label> <br>

                                                                    <input class="form-check-input form-services mechanical_machineries_equipment_and_supplies_selectable" type="checkbox" value="others" id="mechanical_machineries_equipment_and_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="mechanical_machineries_equipment_and_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="mechanical_machineries_equipment_and_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="mechanical_machineries_equipment_and_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="mechanical_machineries_equipment_and_supplies_otherss_1"  class="mechanical_machineries_equipment_and_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button6 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="medical equipment and supplies" id="medical_equipment_and_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="medical_equipment_and_supplies">
                                                                medical equipment and supplies
                                                            </label>
                                                        </div>
                                                        <div id="medical_equipment_and_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services medical_equipment_and_supplies_selectable" type="checkbox" value="medicine and pharmaceutical supplies" id="medicine_and_pharmaceutical_supplies" name="mes[]"> 
                                                                    <label class="form-check-label" for="medicine_and_pharmaceutical_supplies"> <small>medicine and pharmaceutical supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services medical_equipment_and_supplies_selectable" type="checkbox" value="medical equipment" id="medical_equipment" name="mes[]"> <label class="form-check-label" for="medical_equipment"> <small>medical equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services medical_equipment_and_supplies_selectable" type="checkbox" value="others" id="medical_equipment_and_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="medical_equipment_and_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="medical_equipment_and_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="medical_equipment_and_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="medical_equipment_and_supplies_otherss_1"  class="medical_equipment_and_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button7 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="ore milling and processing supplies" id="ore_milling_and_processing_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="ore_milling_and_processing_supplies">
                                                                ore milling and processing supplies
                                                            </label>
                                                        </div>
                                                        <div id="ore_milling_and_processing_supplies_form" style="display:none">
                                                            <div class="form-group form-check">                            
                                                                <div class="col-md-12">                                                                
                                                                    <input class="form-check-input form-services ore_milling_and_processing_supplies_selectable" type="checkbox" value="grinding steel ball" id="grinding_steel_ball" name="omps[]"> 
                                                                    <label class="form-check-label" for="grinding_steel_ball"> <small>grinding steel ball</small> </label> <br>

                                                                    <input class="form-check-input form-services ore_milling_and_processing_supplies_selectable" type="checkbox" value="activated carbon" id="activated_carbon" name="omps[]"> 
                                                                    <label class="form-check-label" for="activated_carbon"> <small>activated carbon</small> </label> <br>

                                                                    <input class="form-check-input form-services ore_milling_and_processing_supplies_selectable" type="checkbox" value="hydrated lime" id="hydrated_lime" name="omps[]"> 
                                                                    <label class="form-check-label" for="hydrated_lime"> <small>hydrated lime</small> </label> <br>

                                                                    <input class="form-check-input form-services ore_milling_and_processing_supplies_selectable" type="checkbox" value="others" id="ore_milling_and_processing_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="ore_milling_and_processing_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="ore_milling_and_processing_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="ore_milling_and_processing_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="ore_milling_and_processing_supplies_otherss_1"  class="ore_milling_and_processing_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button8 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="mining supplies" id="mining_supplies" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="mining_supplies">
                                                                mining supplies
                                                            </label>
                                                        </div>
                                                        <div id="mining_supplies_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services mining_supplies_selectable" type="checkbox" value="ventilations equipment and supplies" id="ventilations_equipment_and_supplies" name="mes[]"> 
                                                                    <label class="form-check-label" for="ventilations_equipment_and_supplies"> <small>ventilations equipment and supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services mining_supplies_selectable" type="checkbox" value="underground supplort supplies" id="underground_supplort_supplies" name="mes[]"> 
                                                                    <label class="form-check-label" for="underground_supplort_supplies"> <small>underground supplort supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services mining_supplies_selectable" type="checkbox" value="rails supplies" id="rails_supplies" name="mes[]"> 
                                                                    <label class="form-check-label" for="rails_supplies"> <small>rails supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services mining_supplies_selectable" type="checkbox" value="others" id="mining_supplies_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="mining_supplies_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="mining_supplies_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="mining_supplies_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="mining_supplies_otherss_1"  class="mining_supplies_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button9 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="office equipment furniture and fixtures" id="office_equipment_furniture_and_fixtures" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="office_equipment_furniture_and_fixtures">
                                                                office equipment furniture and fixtures
                                                            </label>
                                                        </div>
                                                        <div id="office_equipment_furniture_and_fixtures_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services office_equipment_furniture_and_fixtures_selectable" type="checkbox" value="office furnitures and fixtures" id="office_furnitures_and_fixtures" name="oeff[]"> 
                                                                    <label class="form-check-label" for="office_furnitures_and_fixtures"> <small>office furnitures and fixtures</small> </label> <br>

                                                                    <input class="form-check-input form-services office_equipment_furniture_and_fixtures_selectable" type="checkbox" value="office appliances and equipment" id="office_appliances_and_equipment" name="oeff[]"> 
                                                                    <label class="form-check-label" for="office_appliances_and_equipment"> <small>office appliances and equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services office_equipment_furniture_and_fixtures_selectable" type="checkbox" value="stationary and office supplies" id="stationary_and_office_supplies" name="oeff[]"> 
                                                                    <label class="form-check-label" for="stationary_and_office_supplies"> <small>stationary and office supplies</small> </label> <br>

                                                                    <input class="form-check-input form-services office_equipment_furniture_and_fixtures_selectable" type="checkbox" value="others" id="office_equipment_furniture_and_fixtures_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="office_equipment_furniture_and_fixtures_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="office_equipment_furniture_and_fixtures_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="office_equipment_furniture_and_fixtures_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="office_equipment_furniture_and_fixtures_otherss_1"  class="office_equipment_furniture_and_fixtures_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button10 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="safety equipment and apparel" id="safety_equipment_and_apparel" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="safety_equipment_and_apparel">
                                                               safety equipment and apparel
                                                            </label>
                                                        </div>
                                                        <div id="safety_equipment_and_apparel_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services safety_equipment_and_apparel_selectable" type="checkbox" value="personal protective equipment" id="personal_protective_equipment" name="sea[]"> 
                                                                    <label class="form-check-label" for="personal_protective_equipment"> <small>personal protective equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services safety_equipment_and_apparel_selectable" type="checkbox" value="rescue tools and equipment" id="rescue_tools_and_equipment" name="sea[]"> 
                                                                    <label class="form-check-label" for="rescue_tools_and_equipment"> <small>rescue tools and equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services safety_equipment_and_apparel_selectable" type="checkbox" value="protictive clothing and accessories" id="protictive_clothing_and_accessories" name="sea[]"> 
                                                                    <label class="form-check-label" for="protictive_clothing_and_accessories"> <small>protictive clothing and accessories</small> </label> <br>

                                                                    <input class="form-check-input form-services safety_equipment_and_apparel_selectable" type="checkbox" value="others" id="safety_equipment_and_apparel_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="safety_equipment_and_apparel_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="safety_equipment_and_apparel_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="safety_equipment_and_apparel_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="safety_equipment_and_apparel_otherss_1"  class="safety_equipment_and_apparel_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button11 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="tools and equipment" id="tools_and_equipment" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="tools_and_equipment">
                                                                tools and equipment
                                                            </label>
                                                        </div>
                                                        <div id="tools_and_equipment_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services tools_and_equipment_selectable" type="checkbox" value="testing equipment" id="testing_equipment" name="te[]"> 
                                                                    <label class="form-check-label" for="testing_equipment"> <small>testing equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services tools_and_equipment_selectable" type="checkbox" value="measuring tools" id="measuring_tools" name="te[]"> 
                                                                    <label class="form-check-label" for="measuring_tools"> <small>measuring tools</small> </label> <br>

                                                                    <input class="form-check-input form-services tools_and_equipment_selectable" type="checkbox" value="repair tools and equipment" id="repair_tools_and_equipment" name="te[]"> 
                                                                    <label class="form-check-label" for="repair_tools_and_equipment"> <small>repair tools and equipment</small> </label> <br>

                                                                    <input class="form-check-input form-services tools_and_equipment_selectable" type="checkbox" value="others" id="tools_and_equipment_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="tools_and_equipment_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="tools_and_equipment_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="tools_and_equipment_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-xs-12 form-group">
                                                                                    <input type="text" id="tools_and_equipment_otherss_1"  class="tools_and_equipment_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button12 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="utilities and services" id="utilities_and_services" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="utilities_and_services">
                                                                utilities and services
                                                            </label>
                                                        </div>
                                                        <div id="utilities_and_services_form" style="display:none">
                                                            <div class="form-group form-check">
                                                                <div class="col-md-12">
                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="light and water" id="light_and_water" name="mes[]"> 
                                                                    <label class="form-check-label" for="light_and_water"> <small>light and water</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="septic tank siphoning" id="septic_tank_siphoning" name="mes[]"> 
                                                                    <label class="form-check-label" for="septic_tank_siphoning"> <small>septic tank siphoning</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="landscaping and beautification" id="landscaping_and_beautification" name="mes[]"> 
                                                                    <label class="form-check-label" for="landscaping_and_beautification"> <small>landscaping and beautification</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="tailoring" id="tailoring" name="mes[]"> 
                                                                    <label class="form-check-label" for="tailoring"> <small>tailoring</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="printing and publication" id="printing_and_publication" name="mes[]"> 
                                                                    <label class="form-check-label" for="printing_and_publication"> <small>printing and publication</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="promotion and advertisement" id="promotion_and_advertisement" name="mes[]"> 
                                                                    <label class="form-check-label" for="promotion_and_advertisement"> <small>promotion and advertisement</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="event organizing and entertainment" id="event_organizing_and_entertainment" name="mes[]"> 
                                                                    <label class="form-check-label" for="event_organizing_and_entertainment"> <small>event organizing and entertainment</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="audit expert and consultancy" id="audit_expert_and_consultancy" name="mes[]"> 
                                                                    <label class="form-check-label" for="audit_expert_and_consultancy"> <small>audit expert and consultancy</small> </label> <br>

                                                                    <input class="form-check-input form-services utilities_and_services_selectable" type="checkbox" value="others" id="utilities_and_services_others" name="cles[]" onclick="myFunction()"> 
                                                                    <label class="form-check-label" for="utilities_and_services_others"><small>others, pls specify: </small></label> <br>

                                                                    <div id="utilities_and_services_other_wrap" style="display:none; margin-top: 5px;">
                                                                        <div class="utilities_and_services_field_wrapper">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-x12 form-group">
                                                                                    <input type="text" id="utilities_and_services_otherss_1"  class="utilities_and_services_otherss form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0);" class="gas_add_button13 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services ga_services" type="checkbox" value="others" id="others-goods" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="others-goods">
                                                                Others, Please Specify:
                                                            </label>
                                                        </div>
                                                        <div id="others-goods-form" style="display:none">
                                                            <div class="others_field_wrapper">
                                                                <div class="form-group">
                                                                    <input type="text" id="others_license_name_1" class="others_license_name_otherss form-control mb-2">
                                                                </div>     
                                                            </div>
                                                            <a href="javascript:void(0);" class="gas_add_button14 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a> 
                                                        </div>
                                                    </div>    

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4 class="bg-secondary text-light p-3">C. Do you have any access to any form of credit? <span class="field-req" style="color: #ffffff;">*</span></h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                                    <label class="btn btn-outline-secondary ls0 nott" for="chkYes">
                                                        <input type="radio" name="chk" id="chkYes" autocomplete="off" value="yes" onclick="ShowHideDiv()"> Yes
                                                    </label>
                                                    <label class="btn btn-outline-secondary ls0 nott" for="chkNo">
                                                        <input type="radio" name="chk" id="chkNo" autocomplete="off" value="no" onclick="ShowHideDiv()"> 
                                                        None
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dvtext">
                                            <div class="field_wrapper2 mt-3">
                                                <div class="row ac_wrap">
                                                    <div class="col-md-4 form-group">
                                                      <input type="text" class="form-control" placeholder="Institution" name="ac_institution" 
                                                        id="ac_institution">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                      <input type="text" class="form-control" placeholder="Address" name="ac_address" 
                                                        id="ac_address">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                      <input type="text" class="form-control" placeholder="Telephone" name="ac_telephone"
                                                        id="ac_telephone">
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="add_button2 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">D1. General Requirement. ( must have for philippine business ) 
                                            <span class="field-req" style="color: #ffffff;">*</span></h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="dti" id="dti" name="gen_req[]" onclick="d_dti()">
                                                    <label class="form-check-label" for="dti">
                                                        deparment of trade & industry (dti) registration (for sole proprietorship)
                                                    </label>

                                                    <div id="dti_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="dti_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="dti_attachment_holder">
                                                                    <label for="dti_validity">Attachment 
                                                                        <span class="field-req1">*</span>
                                                                    </label>
                                                                    <input type="file" class="sis_attachment" name="dti_attachment" 
                                                                        id="dti_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                                <div class="col-8 form-group">
                                                                    <label for="dti_validity">Validity Period 
                                                                        <span class="field-req1">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control datepicker" name="dti_validity" id="dti_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sec" id="sec" name="gen_req[]" onclick="d_sec()">
                                                    <label class="form-check-label" for="sec">
                                                        securities and exchange commission (sec) registration (for partnership or corporate)
                                                    </label>

                                                    <div id="sec_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="sec_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="sec_attachment_holder">
                                                                    <label for="sec_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="sec_attachment" id="sec_attachment">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="bir" id="bir" name="gen_req[]" onclick="d_bir()">
                                                    <label class="form-check-label" for="bir">
                                                        bureau of internal revenue (bir)(form 2303) 
                                                    </label>

                                                    <div id="bir_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="bir_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="bir_attachment_holder">
                                                                    <label for="bir_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="bir_attachment" id="bir_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sss" id="sss" name="gen_req[]" onclick="d_sss()">
                                                    <label class="form-check-label" for="sss">
                                                        sss registration
                                                    </label>

                                                    <div id="sss_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="sss_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="sss_attachment_holder">
                                                                    <label for="sss_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="sss_attachment" id="sss_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="philhealth" id="philhealth" name="gen_req[]" onclick="d_philhealth()">
                                                    <label class="form-check-label" for="philhealth">
                                                        philhealth registration
                                                    </label>

                                                    <div id="philhealth_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="philhealth_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="philhealth_attachment_holder">
                                                                    <label for="philhealth_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="philhealth_attachment" id="philhealth_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="hdmf registration" id="hdmf_registration" name="gen_req[]" onclick="d_hdmf_registration()">
                                                    <label class="form-check-label" for="hdmf_registration">
                                                        hdmf registration
                                                    </label>

                                                    <div id="hdmf_registration_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="hdmf_registration_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="hdmf_registration_attachment_holder">
                                                                    <label for="hdmf_registration_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="hdmf_registration_attachment" id="hdmf_registration_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="mayors permit" id="mayors_permit" name="gen_req[]" onclick="d_mayors_permit()">
                                                    <label class="form-check-label" for="mayors_permit">
                                                        mayors permit
                                                    </label>

                                                    <div id="mayors_permit_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="mayors_permit_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="mayors_permit_attachment_holder">
                                                                    <label for="mayors_permit_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="mayors_permit_attachment" id="mayors_permit_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                                <div class="col-8 form-group">
                                                                    <label for="mayors_permit_validity">Validity Period <span class="field-req1">*</span></label>
                                                                    <input type="text" class="form-control datepicker" name="mayors_permit_validity" id="mayors_permit_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">D1.1 Philippine Registered Business. ( Additional Requirements )</h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sample sales invoice" id="sample_sales_invoice" name="gen_req[]" onclick="d_sample_si()">
                                                    <label class="form-check-label" for="sample_sales_invoice">
                                                        sample sales/cash/charge invoice (with bir atp# if primary business is goods)
                                                    </label>

                                                    <div id="sample_sales_invoice_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="sample_sales_invoice_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="sample_sales_invoice_attachment_holder">
                                                                    <label for="sample_sales_invoice_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="sample_sales_invoice_attachment" id="sample_sales_invoice_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                                <div class="col-8 form-group">
                                                                    <label for="sample_sales_invoice_validity">ATP Validity Period <span class="field-req1">*</span></label>
                                                                    <input type="text" class="form-control datepicker" name="sample_sales_invoice_validity" id="sample_sales_invoice_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div> 

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sample official receipt" id="sample_official_receipt" name="gen_req[]" onclick="d_sample_or()">
                                                    <label class="form-check-label" for="sample_official_receipt">
                                                        sample official receipt (with bir atp# if primary business is services)
                                                    </label>

                                                    <div id="sample_official_receipt_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="sample_official_receipt_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="sample_official_receipt_attachment_holder">
                                                                    <label for="sample_official_receipt_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="sample_official_receipt_attachment" id="sample_official_receipt_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                                <div class="col-8 form-group">
                                                                    <label for="sample_official_receipt_validity">ATP Validity Period <span class="field-req1">*</span></label>
                                                                    <input type="text" class="form-control datepicker" name="sample_official_receipt_validity" id="sample_official_receipt_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sample delivery receipt" id="sample_delivery_receipt" name="gen_req[]" onclick="d_sample_delivery_receipt()">
                                                    <label class="form-check-label" for="sample_delivery_receipt">
                                                        sample delivery receipt 
                                                    </label>

                                                    <div id="sample_delivery_receipt_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="sample_delivery_receipt_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="sample_delivery_receipt_attachment_holder">
                                                                    <label for="sample_delivery_receipt_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="sample_delivery_receipt_attachment" id="sample_delivery_receipt_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sample collection receipt" id="sample_collection_receipt" name="gen_req[]" onclick="d_sample_collection_receipt()">
                                                    <label class="form-check-label" for="sample_collection_receipt">
                                                        sample collection receipt
                                                    </label>

                                                    <div id="sample_collection_receipt_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="sample_collection_receipt_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="sample_collection_receipt_attachment_holder">
                                                                    <label for="sample_collection_receipt_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="sample_collection_receipt_attachment" id="sample_collection_receipt_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sample charge invoice" id="ph_sample_charge_invoice" name="gen_req[]" onclick="d_ph_sample_charge_invoice()">
                                                    <label class="form-check-label" for="ph_sample_charge_invoice">
                                                        sample charge/commercial/billing invoice
                                                    </label>

                                                    <div id="ph_sample_charge_invoice_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="ph_sample_charge_invoice_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="ph_sample_charge_invoice_attachment_holder">
                                                                    <label for="ph_sample_charge_invoice_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="ph_sample_charge_invoice_attachment" id="ph_sample_charge_invoice_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="license to operate" id="license_to_operate" name="gen_req[]">
                                                    <label class="form-check-label" for="license_to_operate">
                                                        license to operate ( if applicable to your business)
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="company profile" id="ph_company_profile" name="gen_req[]" onclick="d_ph_company_profile()">
                                                    <label class="form-check-label" for="ph_company_profile">
                                                        company profile
                                                    </label>

                                                    <div id="ph_company_profile_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="ph_company_profile_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="ph_company_profile_attachment_holder">
                                                                    <label for="ph_company_profile_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="ph_company_profile_attachment" id="ph_company_profile_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="general information sheet" id="ph_general_information_sheet" name="gen_req[]" onclick="d_general_information_sheet_ph()">
                                                    <label class="form-check-label" for="ph_general_information_sheet">
                                                        general information sheet
                                                    </label>

                                                    <div id="ph_general_information_sheet_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="ph_general_information_sheet_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="ph_general_information_sheet_attachment_holder">
                                                                    <label for="ph_general_information_sheet_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="ph_general_information_sheet_attachment" id="ph_general_information_sheet_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">D2 Foreign Registered Business.</h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="business registration documents" id="business_registration_documents" name="gen_req[]" onclick="d_business_registration_documents()">
                                                    <label class="form-check-label" for="business_registration_documents">
                                                        business registration documents
                                                    </label>

                                                    <div id="business_registration_documents_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="business_registration_documents_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="business_registration_documents_attachment_holder">
                                                                    <label for="business_registration_documents_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="business_registration_documents_attachment" id="business_registration_documents_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="general information sheet" id="foreign_general_information_sheet" name="gen_req[]" onclick="d_general_information_sheet()">
                                                    <label class="form-check-label" for="foreign_general_information_sheet">
                                                        general information sheet
                                                    </label>

                                                    <div id="foreign_general_information_sheet_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="foreign_general_information_sheet_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="foreign_general_information_sheet_attachment_holder">
                                                                    <label for="foreign_general_information_sheet_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="foreign_general_information_sheet_attachment" id="foreign_general_information_sheet_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sample charge invoice" id="foreign_sample_charge_invoice" name="gen_req[]" onclick="d_foreign_sample_charge_invoice()">
                                                    <label class="form-check-label" for="foreign_sample_charge_invoice">
                                                        sample charge/commercial/billing invoice
                                                    </label>

                                                    <div id="foreign_sample_charge_invoice_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="foreign_sample_charge_invoice_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="foreign_sample_charge_invoice_attachment_holder">
                                                                    <label for="foreign_sample_charge_invoice_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="foreign_sample_charge_invoice_attachment" id="foreign_sample_charge_invoice_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="company profile" id="foreign_company_profile" name="gen_req[]" onclick="d_foreign_company_profile()">
                                                    <label class="form-check-label" for="foreign_company_profile">
                                                        company profile
                                                    </label>

                                                    <div id="foreign_company_profile_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="foreign_company_profile_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" 
                                                                    id="foreign_company_profile_attachment_holder">
                                                                    <label for="foreign_company_profile_validity">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="sis_attachment" name="foreign_company_profile_attachment" id="foreign_company_profile_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">E. Certifications (Example: ISO 14001: 2015)<br><small>Please check if you have any of the following, specify certification including certifying body and certification number.</small></h4>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input cerrts" type="checkbox" value="quality" id="qlty-standards" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="qlty-standards">Quality Standards</label>
                                                </div>
                                                <div id="qlty-standards-form" style="display:none">
                                                    <div class="qs_field_wrapper">
                                                        <div class="row quality_certs">
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="quality_cert_number" placeholder="Cert No."  class="form-control">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" class="form-control datepicker" id="quality_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="quality_cert_body" placeholder="Cert Body"  class="form-control">
                                                            </div>                                                            
                                                        </div>                                                        
                                                    </div>

                                                    <a href="javascript:void(0);" class="qs_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>

                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input cerrts" type="checkbox" value="safety" id="sfty-chck" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="sfty-chck">Safety Checks/Standards</label>
                                                </div>
                                                <div id="sfty-chck-form" style="display:none">
                                                    <div class="scs_field_wrapper">
                                                        <div class="row safety_certs">
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="safety_cert_number" placeholder="Cert No."  class="form-control">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" class="form-control datepicker" id="safety_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="safety_cert_body" placeholder="Cert Body"  class="form-control">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <a href="javascript:void(0);" class="scs_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input cerrts" type="checkbox" value="environmental" id="nvrment-stdrds" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="nvrment-stdrds">Environmental Standards</label>
                                                </div>
                                                <div id="nvrment-stdrds-form" style="display:none">
                                                    <div class="es_field_wrapper">
                                                        <div class="row environmental_certs">
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="environmental_cert_number" placeholder="Cert No."  class="form-control">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" class="form-control datepicker" id="environmental_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="environmental_cert_body" placeholder="Cert Body"  class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="es_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input cerrts" type="checkbox" value="others" id="other-cert" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="other-cert">Other certifications, please specify:</label>
                                                </div>
                                                <div id="other-cert-form" style="display:none">
                                                    <div class="ocs_field_wrapper">
                                                        <div class="row ocs_certs">
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="others_cert_number" placeholder="Cert No."  class="form-control">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" class="form-control datepicker" id="others_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                                                            </div>
                                                            <div class="col-4 form-group">
                                                                <input type="text" id="others_cert_body" placeholder="Cert Body"  class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ocs_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <h4 class="bg-secondary text-light p-3">F. For Timber, Explosives, Chemicals and Other Controlled Commodity Suppliers<br><small>Please check if you have any of the following permits/licenses and clearances:</small></h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="ecc certificates" id="utilitys" name="other_certs[]" onclick="cert_cce()">
                                                    <label class="form-check-label" for="utilitys">ECC Certifications</label>

                                                    <div id="ecc_certificates_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="ecc_certificates_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="ecc_certificates_attachment_holder">
                                                                    <label for="ecc_certificates_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="controlled_commss" name="ecc_certificates_attachment" id="ecc_certificates_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="pnp permits" id="rprs-serv" name="other_certs[]" onclick="cert_pdea()">
                                                    <label class="form-check-label" for="rprs-serv">PNP Permits</label>

                                                    <div id="pnp_permits_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="pnp_permits_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="pnp_permits_attachment_holder">
                                                                    <label for="pnp_permits_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="controlled_commss" name="pnp_permits_attachment" id="pnp_permits_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="pdea permits" id="cons-works" name="other_certs[]" onclick="cert_consultancy_and_firms()">
                                                    <label class="form-check-label" for="cons-works">PDEA Permits</label>

                                                    <div id="pdea_permits_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="pdea_permits_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="pdea_permits_attachment_holder">
                                                                    <label for="pdea_permits_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="controlled_commss" name="pdea_permits_attachment" id="pdea_permits_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="import permit" id="fabric" name="other_certs[]" onclick="cert_pnp()">
                                                    <label class="form-check-label" for="fabric">Import Permit</label>

                                                    <div id="import_permit_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="import_permit_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="import_permit_attachment_holder">
                                                                    <label for="import_permit_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="controlled_commss" name="import_permit_attachment" id="import_permit_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="consultancy and firms" id="cons-firms" name="other_certs[]" onclick="cert_import()">
                                                    <label class="form-check-label" for="cons-firms">Consultancy And Firms</label>

                                                    <div id="consultancy_and_firms_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="consultancy_and_firms_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="consultancy_and_firms_attachment_holder">
                                                                    <label for="consultancy_and_firms_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="controlled_commss" name="consultancy_and_firms_attachment" id="consultancy_and_firms_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="bfad registration or fda" id="other-timb" name="other_certs[]" onclick="cert_bfad()">
                                                    <label class="form-check-label" for="other-timb">BFAD Registration/FDA</label>

                                                    <div id="bfad_registration_or_fda_wrap" style="display: none; margin-top: 10px;">
                                                        <div class="bfad_registration_or_fda_field_wrapper">
                                                            <div class="row">

                                                                <div class="col-8 form-group" id="bfad_registration_or_fda_attachment_holder">
                                                                    <label for="bfad_registration_or_fda_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                    <input type="file" class="controlled_commss" name="bfad_registration_or_fda_attachment" id="bfad_registration_or_fda_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4 class="bg-secondary text-light p-3">G. Current and Past Customers (List at least three)</h4>
                                        <div class="field_wrapper7">
                                            <label class="bg-dark text-light p-2">Major Customer: <span class="field-req">*</span></label><br>
                                            <div class="row mc_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="cpc_institution" 
                                                    id="cpc_institution">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="cpc_address"
                                                    id="cpc_address">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control" placeholder="Contact Number" name="cpc_telephone" id="cpc_telephone">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control" placeholder="Email Address" name="cpc_email"
                                                    id="cpc_email">
                                                </div>
                                            </div>
                                            <div class="row mc_wrap">                                                
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_institution" placeholder="Institution" name="cpc_institution1" id="cpc_institution1">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_address" placeholder="Address" name="cpc_address1" 
                                                    id="cpc_address1">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_number" placeholder="Contact Number" name="cpc_telephone1" id="cpc_telephone1">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control mc_email" placeholder="Email Address" name="cpc_email1" id="cpc_email1">
                                                </div>
                                            </div>
                                            <div class="row mc_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_institution" placeholder="Institution" name="cpc_institution2" id="cpc_institution2">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_address" placeholder="Address" name="cpc_address2"
                                                    id="cpc_address2">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_number" placeholder="Contact Number" name="cpc_telephone2"
                                                    id="cpc_telephone2">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control mc_email" placeholder="Email Address" name="cpc_email2" id="cpc_email2">
                                                </div>
                                            </div>
                                            <div class="row mc_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_institution" placeholder="Institution" name="cpc_institution3"
                                                    id="cpc_institution3">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_address" placeholder="Address" name="cpc_address3"
                                                    id="cpc_address3">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_number" placeholder="Contact Number" name="cpc_telephone3"
                                                    id="cpc_telephone3">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control mc_email" placeholder="Email Address" name="cpc_email3" id="cpc_email3">
                                                </div>
                                            </div>
                                            <div class="row mc_wrap"> 
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_institution" placeholder="Institution" name="cpc_telephone4"
                                                    id="cpc_institution4">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_address" placeholder="Address" name="cpc_address4" 
                                                    id="cpc_address4">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control mc_number" placeholder="Contact Number" name="cpc_telephone4" 
                                                    id="cpc_telephone4">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control mc_email" placeholder="Email Address" name="cpc_email4" id="cpc_email4">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="add_button7 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                        
                                        <div class="field_wrapper8 mt-3">
                                            <label class="bg-dark text-light p-2">Customer of Last Three Years: <span class="field-req">*</span></label><br>
                                            <div class="row clty_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="clty_institution"
                                                    id="clty_institution">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="clty_address" 
                                                    id="clty_address">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control" placeholder="Contact Number" name="clty_telephone"id="clty_telephone">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control" placeholder="Email Address" name="clty_email" id="clty_email">
                                                </div>
                                            </div>
                                            <div class="row clty_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_inst" placeholder="Institution" name="clty_institution1" id="clty_institution1">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_addr" placeholder="Address" name="clty_address1" id="clty_address1">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_cnum" placeholder="Contact Number" name="clty_telephone1" id="clty_telephone1">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control clty_eaddr" placeholder="Email Address" name="clty_email1" id="clty_email1">
                                                </div>
                                            </div>
                                            <div class="row clty_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_inst" placeholder="Institution" name="clty_institution2"
                                                    id="clty_institution2">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_addr" placeholder="Address" name="clty_address2"
                                                    id="clty_address2">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_cnum" placeholder="Contact Number" name="clty_telephone2"
                                                    id="clty_telephone2">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control clty_eaddr" placeholder="Email Address" name="clty_email2" id="clty_email2">
                                                </div>
                                            </div>
                                            <div class="row clty_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_inst" placeholder="Institution" name="clty_institution3"
                                                    id="clty_institution3">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_addr" placeholder="Address" name="clty_address3" 
                                                    id="clty_address3">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_cnum" placeholder="Contact Number" name="clty_telephone3"
                                                    id="clty_telephone3">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control clty_eaddr" placeholder="Email Address" name="clty_email3" id="clty_email3">
                                                </div>
                                            </div>
                                            <div class="row clty_wrap">
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_inst" placeholder="Institution" name="clty_institution4" 
                                                    id="clty_institution4">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_addr" placeholder="Address" name="clty_address4"
                                                    id="clty_address4">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="text" class="form-control clty_cnum" placeholder="Contact Number" name="clty_telephone4"
                                                    id="clty_telephone4">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                  <input type="email" class="form-control clty_eaddr" placeholder="Email Address" name="clty_email4" id="clty_email4">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="add_button8 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">H. Financial Status<br><small>Please provide any of the following latest audited Financial Statement.</small></h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input form-fs" type="checkbox" value="income statement" id="income_statement" name="fs[]" onclick="fs_income_statement()">
                                                        <label class="form-check-label" for="income_statement">
                                                            Income Statement
                                                        </label>

                                                        <div id="income_statement_wrap" style="display: none; margin-top: 10px;">
                                                            <div class="income_statement_field_wrapper">
                                                                <div class="row">

                                                                    <div class="col-8 form-group" id="income_statement_attachment_holder">
                                                                        <label for="income_statement_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                        <input type="file" class="fs_toggles" name="income_statement_attachment" id="income_statement_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-12 form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input form-fs" type="checkbox" value="balance sheet" id="balance_sheet" name="fs[]" onclick="fs_balance_sheet()">
                                                        <label class="form-check-label" for="balance_sheet">
                                                            Balance Sheet
                                                        </label>

                                                        <div id="balance_sheet_wrap" style="display: none; margin-top: 10px;">
                                                            <div class="balance_sheet_field_wrapper">
                                                                <div class="row">

                                                                    <div class="col-8 form-group" id="balance_sheet_attachment_holder">
                                                                        <label for="balance_sheet_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                        <input type="file" class="fs_toggles" name="balance_sheet_attachment" id="balance_sheet_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input form-fs" type="checkbox" value="statement of cash flow" id="statement_of_cash_flow" name="fs[]" onclick="fs_cash_flow()">
                                                        <label class="form-check-label" for="statement_of_cash_flow">
                                                            Statement of Cash Flow
                                                        </label>

                                                        <div id="statement_of_cash_flow_wrap" style="display: none; margin-top: 10px;">
                                                            <div class="statement_of_cash_flow_field_wrapper">
                                                                <div class="row">

                                                                    <div class="col-8 form-group" id="statement_of_cash_flow_attachment_holder">
                                                                        <label for="statement_of_cash_flow_validity" style="display: block;">Attachment <span class="field-req1">*</span></label>
                                                                        <input type="file" class="fs_toggles" name="statement_of_cash_flow_attachment" id="statement_of_cash_flow_attachment" accept="image/jpeg, image/png, application/pdf">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">I. Payment Terms</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input form-pt" type="checkbox" value="strictly cash on delivery in all transactions" id="strictly_cash_on_delivery_in_all_transactions" name="pt[]">
                                                        <label class="form-check-label" for="strictly_cash_on_delivery_in_all_transactions">
                                                            Strictly cash on delivery in all transactions
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input form-pt" type="checkbox" value="credit terms after delivery" id="credit_terms_after_delivery" name="pt[]">
                                                        <label class="form-check-label" for="credit_terms_after_delivery">
                                                            Credit terms after delivery
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input form-pt" type="checkbox" value="mixed advance payment and credit term" id="mixed_advance_payment_and_credit_term" name="pt[]">
                                                        <label class="form-check-label" for="mixed_advance_payment_and_credit_term">
                                                            Mixed advance payment and credit term
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">J. Attachments</h4>
                                        
                                        <div class="row ">
                                            <div class="col-lg-12">
                                                <label class="small">Upload docs bir, official receipt, etc. (The maximum upload file size is 4 MB.) </label><br>
                                                <input id="input-3" name="input2[]" type="file" multiple accept="image/jpeg, image/png, application/pdf">
                                                @hasError(['inputName' => 'input2'])@endhasError
                                            </div>
                                        </div>

                                        <hr>
                                        <h4 class="bg-secondary text-light p-3">J. Current Attach Files </h4>
                                        <hr>

                                        <div class="row" id="attachment-prev-inner">

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <div class="form-group left">
                                <button type="button" id="supplier_form_btn1" class="btn btn-primary">Apply as Regular Supplier</button>                                                                        
                                    <button type="button" id="supplier_form_btn" class="btn btn-primary" style="display: none;">Update Form</button>                                    
                                </div>
                            </div>
                        </form>

                    </div>

                

            </div>

        </div>

    </section>


    <div class="modal effect-scale" id="prompt-remove-logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this attachment ?</p>
                    <input type="hidden" name="attachment_from" id="attachment-from">
                    <input type="hidden" name="attachment_remove_key" id="attachment-remove-key">
                    <input type="hidden" name="attachment_remove" id="attachment-remove">
                </div>                    

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger btn-remove-attachment">Yes, remove attachment</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="prompt-confirmation-to-apply" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to apply as regular supplier ? once you click confirm you will no longer considered as one time supplier and will comply to the necessary requirements for regular supplier. </p>
                </div>                    

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success btn-yes-confirm">Yes, I Confirm</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
   
@endsection

@section('pagejs')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/file-upload-validation.js') }}"></script>
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script> 
    <script type="text/javascript">
        var js_supplier_officers = {!! old('h_officers', $supplier_officers) !!};
        var js_supplier_services = {!! old('h_cles', $supplier_servicess) !!};
        var js_supplier_ac = {!! old('h_ac', $supplier_credits) !!};
        var js_supplier_genreq = {!! old('h_genreq', $supplier_requirements) !!};
        var js_supplier_cqualities = {!! old('h_cqualities', $supplier_cqualities) !!};
        var js_supplier_cenveronmentals = {!! old('h_cenveronmentals', $supplier_cenveronmentals) !!};
        var js_supplier_csafety = {!! old('h_csafety', $supplier_csafety) !!};
        var js_supplier_cothers = {!! old('h_cothers', $supplier_cothers) !!};
        var js_supplier_controllered_comms = {!! old('h_controlled_comms', $supplier_controlled_commodity) !!};
        var js_supplier_mc = {!! old('h_mc', $supplier_mc) !!};
        var js_supplier_lty = {!! old('h_clty', $supplier_lty) !!};
        var js_supplier_fs = {!! old('h_fs', $supplier_financial_stats) !!};
        var js_supplier_bli = {!! old('h_bli', $supplier_bli) !!};
        var js_supplier_details = {!! $supplier_details == '' ? "[]" : $supplier_details !!};
        var js_supplier_pt = {!! old('h_pt', $supplier_pt) !!};
        var js_supplier_banks = {!! $supplier_banks !!};
        var isValid = true;
        var storage_url = "{!! asset('storage/images/supplier/profile') !!}"+"{!! Auth::id() !!}"+"/supplier-details/attachment/";
        var gen_req = {};
        var req = [];
        var has_invalid_image=false;
        
        if(typeof js_supplier_officers === 'string') { JSON.parse(js_supplier_officers); }
        if(typeof js_supplier_ac === 'string') { JSON.parse(js_supplier_ac); }
        if(typeof js_supplier_genreq === 'string') { JSON.parse(js_supplier_genreq); }
        if(typeof js_supplier_cqualities === 'string') { JSON.parse(js_supplier_cqualities); }
        if(typeof js_supplier_cenveronmentals === 'string') { JSON.parse(js_supplier_cenveronmentals); }
        if(typeof js_supplier_csafety === 'string') { JSON.parse(js_supplier_csafety); }
        if(typeof js_supplier_cothers === 'string') { JSON.parse(js_supplier_cothers); }
        if(typeof js_supplier_controllered_comms === 'string') { JSON.parse(js_supplier_controller_comms); }
        if(typeof js_supplier_mc === 'string') { JSON.parse(js_supplier_mc); }
        if(typeof js_supplier_lty === 'string') { JSON.parse(js_supplier_lty); }
        if(typeof js_supplier_fs === 'string') { JSON.parse(js_supplier_fs); }
        if(typeof js_supplier_bli === 'string') { JSON.parse(js_supplier_bli); }


        $(document).ready(function() {

            if(js_supplier_details) {

                var exploded_img = js_supplier_details.attachments  != null ? js_supplier_details.attachments.split(',') : null;


                let html_attachment = '';
                if(exploded_img != null) {
                    html_attachment += '<div class="col-lg-12"><table class="table table-bordered table-striped" width="100%">';
                    for(i = 0; i < exploded_img.length; i++) {
                        let a_img = storage_url+exploded_img[i];
                        console.log(a_img);
                        html_attachment += '<tr><td>';
                        html_attachment += '<a href="'+a_img+'" id="img_temp'+i+'" target="_blank">'+exploded_img[i]+ '</a>';
                        html_attachment += '<a href="javascript:void(0);" data-tdkey="'+i+'" data-from="gen_attachment" class="remove-logo" style="margin-left:15px;">X</a>';
                        html_attachment += '</td></tr>'
                    }
                    html_attachment += '</table></div>';
                    $('#attachment-prev-inner').html(html_attachment);
                    $('#attachment-prev').show();

                }            
            }

        });

        $(function() {

            showHideAddOption();

            function compare( a, b ) {
                if ( a.provDesc < b.provDesc ){
                    return -1;
                }
                if ( a.provDesc > b.provDesc ){
                    return 1;
                }
                return 0;
            }

            function toTitleCase(str) {
                return str.replace(/\w\S*/g, function(txt){
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
            }

            function showHideAddOption(){
                if($('#country').val() == 'Philippines') {
                    $('#local-province').show();
                    $('#local-city').show();
                    $('#local-barangay').show();

                    $('#province').hide();
                    $('#city').hide();
                    $('#barangay').hide();
                } else {
                    $('#local-province').hide();
                    $('#local-city').hide();
                    $('#local-barangay').hide();

                    $('#province').show();
                    $('#city').show();
                    $('#barangay').show();
                }
            }

            $.ajax({
                type: 'GET',
                url: '{{asset("data/countriesWithCode.json")}}',
                data: { get_param: 'value' },
                dataType: 'json',
                success: function (data) {
                    $.each(data, function(key, val) {
                        let selected = val.name == '{{ old('country', $supplier_details ? $supplier_details->country : "Philippines" ) }}' ? 'selected' : '';
                        $('#country').append(`<option value="${val.name}" data-code="${val.code}" ${selected}>${val.name}</option>`);
                    });
                    $('#country').change();
                }
            });

            $('#country').change(function() {
                showHideAddOption();
                $('#local-province').find('option').not(':first').remove();                
                $('#local-city').find('option').not(':first').remove();
                $('#local-barangay').find('option').not(':first').remove();
                
                if ($('#country').val() == 'Philippines') {
                    $.ajax({
                        type: 'GET',
                        url: '{{asset('data/philippines/json/refprovince.json')}}',
                        data: {get_param: 'value'},
                        dataType: 'json',
                        success: function (data) {
                            data.RECORDS.sort(compare);
                            $.each(data.RECORDS, function (key, val) {
                                let province = toTitleCase(val.provDesc.toLowerCase());
                                let selected = (province == '{{ old('province', $supplier_details ? $supplier_details->province : "") }}') ? 'selected' : '';
                                $('#local-province').append(`<option value="${province}" data-code="${val.provCode}" ${selected}>`+province+`</option>`);
                                if (selected == 'selected') {
                                    $('#local-province').change();
                                }
                            });
                        }
                    });
                }
            });

            $('#local-province').change(function() {
                $('#local-city').find('option').not(':first').remove();
                $('#local-barangay').find('option').not(':first').remove();

                $.ajax({
                    type: 'GET',
                    url: '{{asset('data/philippines/json/refcitymun.json')}}',
                    data: { get_param: 'value' },
                    dataType: 'json',
                    success: function (data) {

                        $.each(data, function(index, element) {

                            $.each(element, function(key, val) {
                                let city = toTitleCase(val.citymunDesc.toLowerCase());
                                let selected = (city == '{{ old('city', $supplier_details ? $supplier_details->city : "") }}') ? 'selected' : '';
                                if(val.provCode == $('option:selected', '#local-province').attr('data-code'))
                                    $('#local-city').append(`<option value="${city}" data-code="${val.citymunCode}" ${selected}>`+city+`</option>`);

                                if (selected == 'selected') {
                                    $('#local-city').change();
                                }
                            });
                        });
                    }
                });
            });

            $('#local-city').change(function() {
                $('#local-barangay').find('option').not(':first').remove();
                $.ajax({
                    type: 'GET',
                    url: '{{asset('data/philippines/json/refbrgy.json')}}',
                    data: { get_param: 'value' },
                    dataType: 'json',
                    success: function (data) {

                        $.each(data, function(index, element) {

                            $.each(element, function(key, val) {
                                let barangay = toTitleCase(val.brgyDesc.toLowerCase());
                                let selected = (barangay == '{{ old('barangay', $supplier_details ? $supplier_details->barangay:"") }}') ? 'selected' : '';
                                if(val.citymunCode == $('option:selected', '#local-city').attr('data-code'))
                                    $('#local-barangay').append(`<option value="${barangay}" data-code="${val.brgyCode}" ${selected}>`+barangay+`</option>`);

                            });
                        });
                    }
                });
            });

        });

        function upload_image(file, evt)
        {
            $('#supplier_form_btn').addClass('disabled').attr('disabled', 'disabled');

            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("banner", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "{{ route('uploaded-files') }}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(returnData) {
                    if(returnData.status == 'failed') {
                        has_invalid_image = true;
                        $('#'+evt.currentTarget.id).val('');
                    }

                    $('#supplier_form_btn').removeClass('disabled').attr('disabled', false);

                },
                failed: function() {
                    alert('FAILED NGA!');
                },
                async:false
            });
        }

        $(document).on('click', '.btn-remove-attachment', function() {
            
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("from", $('#attachment-from').val());
            data.append("img", $('#attachment-remove').val());
            data.append("key", $('#attachment-remove-key').val());

            let _that = $(this);
            
            $.ajax({
                data: data,
                type: "POST",
                url: "{!! route('sms.remove-attachment') !!}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(returnData) {

                    if( $('#attachment-from').val() == 'gen_attachment' ) {

                        $('#img_temp'+$('#attachment-remove-key').val()).parent().remove();

                        $('#prompt-remove-logo').modal('hide');

                    } else {

                        let affected_req = $('#attachment-remove-key').val();

                        html  = '<label for="'+affected_req+'_validity" style="display:block;">Attachment <span class="field-req1">*</span></label>';
                        html += '<input type="file" class="sis_attachment" name="'+affected_req+'_attachment"'; 
                        html += 'id="'+affected_req+'_attachment" accept="image/jpeg, image/png, application/pdf">';

                        $('#'+affected_req+'_attachment_holder').empty().append(html);

                        $('#prompt-remove-logo').modal('hide');

                    }

                },
                failed: function() {
                    alert('FAILED NGA!');
                },
                async:false
            });

        });

        $(document).on('click', '#supplier_form_btn1', function(e){
            e.preventDefault();
            if({!! auth()->user()->supplier_details->apply_as_permanent !!} == 0) {
                $('#prompt-confirmation-to-apply').modal('show');
            } else {
                $('#supplier_form_btn').click();
            }
        });

        $(document).on('click', '.btn-yes-confirm', function() {
            $('#supplier_form_btn').click();
        });

    </script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/data/sis_file_validation.js') }}"></script>
    
@endsection


