@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
@endsection

@section('content')

    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Becoming A Supplier</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="/">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Update Profile</a></li>                      
            </ol>
        </div>
    </section>

    <section>
        <div class="container clearfix">
            <div class="row">
                <div class="my-3 p-3 bg-white rounded shadow-sm">
    
                    <h6 class="border-bottom pb-2 mb-0">Messages ({{ count($messages) }})</h6>

                    @if(count($messages))
                        @foreach( $messages as $message )
                            <div class="d-flex text-muted pt-3">
                              <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

                              <p class="pb-3 mb-0 small lh-sm border-bottom" style="margin-left: 5px;">
                                <strong class="d-block text-gray-dark">@username</strong>
                                    {{ $message->message }}
                              </p>
                            </div>
                        @endforeach
                    @endif
                    
                    <small class="d-block text-end mt-3">
                      <a href="#">View All Messages</a>
                    </small>
                </div>  
            </div>
        </div>
    </section>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                @if(Session::has('success'))

                  
                    <div class="alert alert-success" role="alert">
                        Success. Your profile has been updated!
                    </div>
                @endif

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
                            <input type="hidden" name="h_bank_details_swift" id="h_bank_details_swift">
                            <input type="hidden" name="h_bank_details_iban" id="h_bank_details_iban">
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
                                        <label class="bg-dark text-light p-2">Name:</label>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                              <input type="text" readonly class="form-control" placeholder="Name" id="name" name="name" value="{{ $applicant->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Address:</label>
                                        <div class="row">
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
                                              <input type="text" class="form-control" placeholder="Subdivision" id="subdivision" name="subdivision" value="{{ old('subdivision', $supplier_details ? $supplier_details->subdivision:'') }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                              <input type="text" class="form-control" placeholder="City Municipality" id="city" name="city" value="{{ old('city', $supplier_details ? $supplier_details->city:'') }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                              <input type="text" class="form-control" placeholder="Province" id="province" name="province" value="{{ old('province', $supplier_details ? $supplier_details->province:'') }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                              <select class="form-control required" id="country" name="country">
                                                <option value="AX">&#197;land Islands</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="PW">Belau</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="VG">British Virgin Islands</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo (Brazzaville)</option>
                                                <option value="CD">Congo (Kinshasa)</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">Cura&Ccedil;ao</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="CI">Ivory Coast</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao S.A.R., China</option>
                                                <option value="MK">Macedonia</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="KP">North Korea</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PS">Palestinian Territory</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH" selected='selected'>Philippines</option>
                                                <option value="PN">Pitcairn</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="QA">Qatar</option>
                                                <option value="IE">Republic of Ireland</option>
                                                <option value="RE">Reunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="ST">S&atilde;o Tom&eacute; and Pr&iacute;ncipe</option>
                                                <option value="BL">Saint Barth&eacute;lemy</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="SX">Saint Martin (Dutch part)</option>
                                                <option value="MF">Saint Martin (French part)</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="SM">San Marino</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="GS">South Georgia/Sandwich Islands</option>
                                                <option value="KR">South Korea</option>
                                                <option value="SS">South Sudan</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom (UK)</option>
                                                <option value="US">United States (US)</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="WS">Western Samoa</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                              <input type="text" class="form-control" placeholder="Zip Code" id="zip" name="zip" value="{{ old('zip', $supplier_details ? $supplier_details->zip:'') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2" for="tax-indentification-num"> Tax Identification Number:</label><br>
                                        <input type="text" name="tin" id="tin" class="form-control" value="{{ old('tin', $supplier_details ? $supplier_details->tin:'') }}" placeholder="TIN #">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input required" checked type="radio" name="vat_registered" 
                                                @if(old('vat_registered', $supplier_details ? $supplier_details->vat_registered:0) == 1) checked @endif id="vat-registered1" value="1">
                                            <label class="form-check-label nott" for="vat-registered1">VAT Registered</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" @if(old('vat_registered', $supplier_details ? $supplier_details->vat_registered:0) == 0) checked @endif name="vat_registered" id="vat-registered2" value="0">
                                            <label class="form-check-label nott" for="vat-registered2">Non-VAT Registered</label>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2" for="date-established">Date Established:</label>
                                        <input type="text" class="form-control datepicker required" name="date_established" id="date-established" value="{{ old('date_established', $supplier_details ? $supplier_details->date_established:'') }}" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="0d">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2" for="company-website">Company Website (if any):</label>
                                        <input type="text" name="company_website" id="company-website" class="form-control required url" placeholder="https://" value="{{ old('company_website', $supplier_details ? $supplier_details->website:'') }}">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Business Type:</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input required" type="radio" checked name="business_type" id="business-type1" value="manufacturer" onclick="ShowHideDiv()" @if(old('business_type', $sd_type)=='manufacturer') checked @endif >
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
                                        <input type="text" name="other_business_type" id="other-business-type" class="form-control required mt-2" value="{{ old('other_business_type', $sd_type == 'other' ? $supplier_details->business_type:'') }}" style="display: @if(old('business_type', $sd_type) == 'other') block @else none @endif">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Type of Organization:</label><br>
                                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary ls0 nott">
                                                <input type="radio" name="org_type" id="single-proprietorship" value="single proprietorship" @if(old('org_type', $supplier_details ? $supplier_details->organization_type:'single proprietorship') == 'single proprietorship') checked @endif> Single Proprietorship
                                            </label>
                                            <label class="btn btn-outline-secondary ls0 nott">
                                                <input type="radio" name="org_type" id="partnership" value="partnership" @if(old('org_type', $supplier_details ? $supplier_details->organization_type:'single proprietorship') == 'partnership') checked @endif> Partnership
                                            </label>
                                            <label class="btn btn-outline-secondary ls0 nott">
                                                <input type="radio" name="org_type" id="corporation" value="corporation" @if(old('org_type', $supplier_details ? $supplier_details->organization_type:'single proprietorship') == 'corporation') checked @endif> Corporation
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="bg-dark text-light p-2">Officers:</label><br>
                                        <div class="field_wrapper" id="officers-field-wrapper">
                                            <div class="row">
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
                                        <label class="bg-dark text-light p-2">Contact Details:</label><br>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-12 form-group m-0">
                                                <label>&nbsp;</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="bg-info text-light p-2 label-warning">Customer Service</label>
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                               <label class="bg-info text-light p-2 label-warning">Sales</label>
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <label class="bg-info text-light p-2 label-warning">Accounting</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-12 form-group m-0">
                                                <label>Contact Person (Name):</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_name" id="contact-person-name" class="form-control valid" value="{{ old('cs_name', $supplier_contact_cs ? $supplier_contact_cs->name:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_name" id="contact-person-sale" class="form-control valid" value="{{ old('sales_name', $supplier_contact_sales ? $supplier_contact_sales->name:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_name" id="contact-person-accnt" class="form-control valid" value="{{ old('accounting_name', $supplier_contact_accounting ? $supplier_contact_accounting->name:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Position:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_position" id="contact-person-name1" class="form-control valid" value="{{ old('cs_position', $supplier_contact_cs ? $supplier_contact_cs->position:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_position" id="contact-person-sale1" class="form-control valid" value="{{ old('sales_position', $supplier_contact_sales ? $supplier_contact_sales->position:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_position" id="contact-person-accnt1" class="form-control valid" value="{{ old('accounting_position', $supplier_contact_accounting ? $supplier_contact_accounting->position:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Email Address:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_email" id="contact-person-name2" class="form-control valid" value="{{ old('cs_email', $supplier_contact_cs ? $supplier_contact_cs->email:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_email" id="contact-person-sale2" class="form-control valid" value="{{ old('sales_email', $supplier_contact_sales ? $supplier_contact_sales->email:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_email" id="contact-person-accnt2" class="form-control valid" value="{{ old('accounting_email', $supplier_contact_accounting ? $supplier_contact_accounting->email:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Telephone Number:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_telephone" id="contact-person-name3" class="form-control valid" value="{{ old('cs_telephone', $supplier_contact_cs ? $supplier_contact_cs->telephone_no:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_telephone" id="contact-person-sale3" class="form-control valid" value="{{ old('sales_telephone', $supplier_contact_sales ? $supplier_contact_sales->telephone_no:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_telephone" id="contact-person-accnt3" class="form-control valid" value="{{ old('accounting_telephone', $supplier_contact_accounting ? $supplier_contact_accounting->telephone_no:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Fax Number:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_fax" id="contact-person-name4" class="form-control valid" value="{{ old('cs_fax', $supplier_contact_cs ? $supplier_contact_cs->fax_no:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_fax" id="contact-person-sale4" class="form-control valid" value="{{ old('sales_fax', $supplier_contact_sales ? $supplier_contact_sales->fax_no:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_fax" id="contact-person-accnt4" class="form-control valid" value="{{ old('accounting_fax', $supplier_contact_accounting ? $supplier_contact_accounting->fax_no:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Mobile Number:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_mobile" id="contact-person-name5" class="form-control valid" value="{{ old('cs_mobile', $supplier_contact_cs ? $supplier_contact_cs->mobile_no:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_mobile" id="contact-person-sale5" class="form-control valid" value="{{ old('sales_mobile', $supplier_contact_sales ? $supplier_contact_sales->mobile_no:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_mobile" id="contact-person-accnt5" class="form-control valid" value="{{ old('accounting_mobile', $supplier_contact_accounting ? $supplier_contact_accounting->mobile_no:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Skype Account:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_skype" id="contact-person-name6" class="form-control valid" value="{{ old('cs_skype', $supplier_contact_cs ? $supplier_contact_cs->skype:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_skype" id="contact-person-sale6" class="form-control valid" value="{{ old('sales_skype', $supplier_contact_sales ? $supplier_contact_sales->skype:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_skype" id="contact-person-accnt6" class="form-control valid" value="{{ old('accounting_skype', $supplier_contact_accounting ? $supplier_contact_accounting->skype:'') }}" >
                                            </div>
                                            <div class="col-lg-2 col-md-12 m-0 form-group">
                                                <label>Others, please specify:</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" name="cs_others" id="contact-person-name7" class="form-control valid" value="{{ old('cs_others', $supplier_contact_cs ? $supplier_contact_cs->others:'') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="sales_others" id="contact-person-sale7" class="form-control valid" value="{{ old('sales_others', $supplier_contact_sales ? $supplier_contact_sales->others:'') }}" >
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group">
                                                <input type="text" name="accounting_others" id="contact-person-accnt7" class="form-control valid" value="{{ old('accounting_others', $supplier_contact_accounting ? $supplier_contact_accounting->others:'') }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="bg-dark text-light p-2">Bank Details:</label><br>
                                        <div class="field_wrapper1">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="bank-details-name">Bank Name:</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" name="swift_bank_details_name" id="swift_bank_details_name" class="form-control valid">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="bank-details-accnt">Account Name:</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" name="swift_bank_details_accnt" id="swift_bank_details_accnt" class="form-control valid">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="bank-details-swift">Swift Code:</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" name="swift_bank_details_swift" id="swift_bank_details_swift" class="form-control valid">
                                                </div>
                                                <div class="col-12">&nbsp;</div>
                                                <div class="col-md-2">
                                                    <label for="bank-details-name2">Bank Name:</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" name="iban_bank_details_name" id="iban_bank_details_name" class="form-control valid">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="bank-details-accnt2">Account Name:</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" name="iban_bank_details_accnt" id="iban_bank_details_accnt" class="form-control valid">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="bank-details-iban">IBAN Code:</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" name="iban_bank_details_iban" id="iban_bank_details_iban" class="form-control valid">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="add_button1 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">B. Goods and Services</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="explosives and accessories" id="explosives_and_accessories" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="explosives_and_accessories">
                                                                Explosives And Accessories
                                                            </label>
                                                        </div>
                                                        <div id="explosives_and_accessories_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="explosives_and_accessories_license" id="explosives_and_accessories_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="explosives_and_accessories_img" name="explosives_and_accessories_img" class="required" data-show-preview="false" />
                                                                
                                                                <div id="explosives_and_accessories_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="explosives_and_accessories_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="chemicals" id="chemicals" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="chemicals">
                                                                Chemicals, Lab Equipment and Supplies
                                                                <br>
                                                                <small>(Example: Laboratory Chemicals, Reagents, Exploration Additives, Lubes & Oil, Paints)</small>
                                                            </label>
                                                        </div>
                                                        <div id="chemicals_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="chemicals_license" id="chemicals_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="chemicals_license_img" name="chemicals_img" class="required" data-show-preview="false" />

                                                                <div id="chemicals_license_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="chemicals_license_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="machinery and equipment" id="machinery_and_equipment" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="machinery_and_equipment">
                                                                Machinery And Equipment
                                                                <br>
                                                                <small>(Example: Pumps, Machines, Heavy Equipment, Vehicle, Power Tools)</small>
                                                            </label>
                                                        </div>
                                                        <div id="machinery_and_equipment_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="machinery_and_equipment_license" id="machinery_and_equipment_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="machinery_and_equipment_img" name="machinery_and_equipment_img" class="required" data-show-preview="false" />

                                                                <div id="machinery_and_equipment_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="machinery_and_equipment_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="electrical" id="electrical" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="electrical">
                                                                Electrical
                                                            </label>
                                                        </div>
                                                        <div id="electrical_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="electrical_license" id="electrical_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="electrical_img" name="electrical_img" class="required" data-show-preview="false" />

                                                                <div id="electrical_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="electrical_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="electronic and instrumentation" id="electronic_and_instrumentation" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="electronic_and_instrumentation">
                                                                Electronic And Instrumentation Materials
                                                            </label>
                                                        </div>
                                                        <div id="electronic_and_instrumentation_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="electronic_and_instrumentation_license" id="electronic_and_instrumentation_license" class="form-control required valid mb-2" value="" placeholder="License Number">
                                                                <input type="file" id="electronic_and_instrumentation_img" name="electronic_and_instrumentation_img" class="required" data-show-preview="false" />

                                                                <div id="electronic_and_instrumentation_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="electronic_and_instrumentation_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="information and communication technology" id="information_and_communication_technology" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="information_and_communication_technology">
                                                                Information And Communication Technology
                                                                <br>
                                                                <small>(Hardware and Software)</small>
                                                            </label>
                                                        </div>
                                                        <div id="information_and_communication_technology_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="information_and_communication_technology_license" id="information_and_communication_technology_license" class="form-control required valid mb-2"
                                                                placeholder="License Number">
                                                                <input type="file" id="information_and_communication_technology_img" name="information_and_communication_technology_img" class="required" data-show-preview="false" />

                                                                <div id="information_and_communication_technology_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="information_and_communication_technology_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="ppe and safety apparels" id="ppe_and_safety_apparels" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="ppe_and_safety_apparels">
                                                                Ppe And Safety Apparels
                                                            </label>
                                                        </div>
                                                        <div id="ppe_and_safety_apparels_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="ppe_and_safety_apparels_license" id="ppe_and_safety_apparels_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="ppe_and_safety_apparels_img" name="ppe_and_safety_apparels_img" class="required" data-show-preview="false" />

                                                                <div id="ppe_and_safety_apparels_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="ppe_and_safety_apparels_img_display" height="100" width="300" alt="Company Logo">
                                                                    
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
                                                            <input class="form-check-input form-services" type="checkbox" value="medical" id="medical" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="medical">
                                                                Medical
                                                            </label>
                                                        </div>
                                                        <div id="medical_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="medical_license" id="medical_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="medical_img" name="medical_img" class="required" data-show-preview="false" />

                                                                <div id="medical_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="medical_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="utilities" id="utilities" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="utilities">
                                                                Utilities
                                                            </label>
                                                        </div>
                                                        <div id="utilities_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="utilities_license" id="utilities_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="utilities_img" name="utilities_img" class="required" data-show-preview="false" />

                                                                <div id="utilities_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="utilities_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="repairs and maintenance services" id="repairs_and_maintenance_services" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="repairs_and_maintenance_services">
                                                                Repairs And Maintenance Services
                                                            </label>
                                                        </div>
                                                        <div id="repairs_and_maintenance_services_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="repairs_and_maintenance_services_license" id="repairs_and_maintenance_services_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="repairs_and_maintenance_services_img" name="repairs_and_maintenance_services_img" class="required" data-show-preview="false" />

                                                                <div id="repairs_and_maintenance_services_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="repairs_and_maintenance_services_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="construction and installation works" id="construction_and_installation_works" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="construction_and_installation_works">
                                                                Construction And Installation Works
                                                            </label>
                                                        </div>
                                                        <div id="construction_and_installation_works_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="construction_and_installation_works_license" id="construction_and_installation_works_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="construction_and_installation_works_img" name="construction_and_installation_works_img" class="required" data-show-preview="false" />

                                                                <div id="construction_and_installation_works_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="construction_and_installation_works_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="fabrication and machining" id="fabrication_and_machining" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="fabrication_and_machining">
                                                                Fabrication And Machining
                                                            </label>
                                                        </div>
                                                        <div id="fabrication_and_machining_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="fabrication_and_machining_license" id="fabrication_and_machining_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="fabrication_and_machining_img" name="fabrication_and_machining_img" class="required" data-show-preview="false" />

                                                                <div id="fabrication_and_machining_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="fabrication_and_machining_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="consultancy and firms" id="consultancy_and_firms" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="consultancy_and_firms">
                                                                Consultancy And Firms
                                                            </label>
                                                        </div>
                                                        <div id="consultancy_and_firms_form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="consultancy_and_firms_license" id="consultancy_and_firms_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="consultancy_and_firms_img" name="consultancy_and_firms_img" class="required" data-show-preview="false" />

                                                                <div id="consultancy_and_firms_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="consultancy_and_firms_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input form-services" type="checkbox" value="others" id="others-goods" name="supplier_services[]" onclick="myFunction()">
                                                            <label class="form-check-label" for="others-goods">
                                                                Others, Please Specify:
                                                            </label>
                                                        </div>
                                                        <div id="others-goods-form" style="display:none">
                                                            <div class="form-group">
                                                                <input type="text" name="others_license_name" id="others_license_name" class="form-control required mb-2">
                                                                <input type="text" name="others_license" id="others_license" class="form-control required valid mb-2" placeholder="License Number">
                                                                <input type="file" id="others_license_img" name="others_license_img" class="required" data-show-preview="false" />

                                                                <div id="others_license_img_div" style="margin-top: 5px;">

                                                                    <img src="" id="others_license_img_display" height="100" width="300" alt="Company Logo">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4 class="bg-secondary text-light p-3">C. Do you have any access to any form of credit? </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                                    <label class="btn btn-outline-secondary ls0 nott" for="chkYes">
                                                        <input type="radio" name="chk" id="chkYes" autocomplete="off" value="yes" @if($supplier_credits) checked @endif onclick="ShowHideDiv()"> Yes
                                                    </label>
                                                    <label class="btn btn-outline-secondary ls0 nott" for="chkNo">
                                                        <input type="radio" name="chk" id="chkNo" autocomplete="off" value="no" @if(is_null($supplier_credits)) checked @endif onclick="ShowHideDiv()"> 
                                                        None
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: none" id="dvtext">
                                            <div class="field_wrapper2 mt-3">
                                                <div class="row">
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
                                        <h4 class="bg-secondary text-light p-3">D. General Requirement (must have)<br><small>Please check if you have any of the following and attached to this form.</small></h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="dti sec" id="dti-sec-reg" name="gen_req[]" >
                                                    <label class="form-check-label" for="dti-sec-reg">
                                                        DTI/SEC Registration
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="business permit" id="bsnss-permit" name="gen_req[]">
                                                    <label class="form-check-label" for="bsnss-permit">
                                                        Business Permit
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="license to operate" id="lcns-operate" name="gen_req[]">
                                                    <label class="form-check-label" for="lcns-operate">
                                                        License To Operate
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="bir" id="bit-cor-atp" name="gen_req[]">
                                                    <label class="form-check-label" for="bit-cor-atp">
                                                        BIR COR and ATP
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="sales" id="sales-charge-comm-bill" name="gen_req[]">
                                                    <label class="form-check-label" for="sales-charge-comm-bill">
                                                        Sales/Charge/Commercial/Billing
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-genreq" type="checkbox" value="official receipt" id="coll-off-rcpt" name="gen_req[]">
                                                    <label class="form-check-label" for="coll-off-rcpt">
                                                        Collection/Official Receipt
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="bg-secondary text-light p-3">E. Certifications (Example: ISO 14001: 2015)<br><small>Please check if you have any of the following, specify certification including certifying body and certification number.</small></h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="quality" id="qlty-standards" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="qlty-standards">Quality Standards</label>
                                                </div>
                                                <div id="qlty-standards-form" style="display:none">
                                                    <div class="field_wrapper3">
                                                        <div class="row">
                                                            <div class="col-12 form-group">
                                                                <input type="text" name="cert_quality" id="cert_quality"  class="form-control required" value="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="add_button3 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="safety" id="sfty-chck" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="sfty-chck">Safety Checks/Standards</label>
                                                </div>
                                                <div id="sfty-chck-form" style="display:none">
                                                    <div class="field_wrapper4">
                                                        <div class="row">
                                                            <div class="col-12 form-group">
                                                                <input type="text" id="cert_safety" name="cert_safety" class="form-control required" value="">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <a href="javascript:void(0);" class="add_button4 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="environmental" id="nvrment-stdrds" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="nvrment-stdrds">Environmental Standards</label>
                                                </div>
                                                <div id="nvrment-stdrds-form" style="display:none">
                                                    <div class="field_wrapper5">
                                                        <div class="row">
                                                            <div class="col-12 form-group">
                                                                <input type="text" id="cert_environmental" name="cert_environmental" class="form-control required" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="add_button5 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="others" id="other-cert" name="certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="other-cert">Other certifications, please specify:</label>
                                                </div>
                                                <div id="other-cert-form" style="display:none">
                                                    <div class="field_wrapper6">
                                                        <div class="row">
                                                            <div class="col-12 form-group">
                                                                <input type="text" name="cert_others" id="cert_others" class="form-control required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="add_button6 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <h4 class="bg-secondary text-light p-3">F. For Timber, Explosives, Chemicals and Other Controlled Commodity Suppliers<br><small>Please check if you have any of the following permits/licences and clearances:</small></h4>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="utility" id="utilitys" name="other_certs[]">
                                                    <label class="form-check-label" for="utilitys">Utilities</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="repairs and maintenance" id="rprs-serv" name="other_certs[]">
                                                    <label class="form-check-label" for="rprs-serv">Repairs And Maintenance Services</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="construction and installation" id="cons-works" name="other_certs[]">
                                                    <label class="form-check-label" for="cons-works">Construction & Installation Works</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="fabrication and machining" id="fabric" name="other_certs[]">
                                                    <label class="form-check-label" for="fabric">Fabrication And Machining</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="consultancy and firms" id="cons-firms" name="other_certs[]">
                                                    <label class="form-check-label" for="cons-firms">Consultancy And Firms</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input form-controlled" type="checkbox" value="others" id="other-timb" name="other_certs[]" onclick="myFunction()">
                                                    <label class="form-check-label" for="other-timb">Others, Please Specify:</label>
                                                </div>
                                                <div id="other-timb-form" style="display:none">
                                                    <input type="text" name="other_cert_others" id="other_cert_others" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4 class="bg-secondary text-light p-3">G. Current and Past Customers (List at least five)</h4>
                                        <div class="field_wrapper7">
                                            <label class="bg-dark text-light p-2">Major Customer:</label><br>
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="cpc_institution" 
                                                    id="cpc_institution">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="cpc_address"
                                                    id="cpc_address">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="cpc_telephone"
                                                    id="cpc_telephone">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="cpc_institution1"
                                                    id="cpc_institution1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="cpc_address1" 
                                                    id="cpc_address1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="cpc_telephone1"
                                                    id="cpc_telephone1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="cpc_institution2"
                                                    id="cpc_institution2">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="cpc_address2"
                                                    id="cpc_address2">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="cpc_telephone2"
                                                    id="cpc_telephone2">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="cpc_institution3"
                                                    id="cpc_institution3">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="cpc_address3"
                                                    id="cpc_address3">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="cpc_telephone3"
                                                    id="cpc_telephone3">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="cpc_telephone4"
                                                    id="cpc_institution4">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="cpc_address4" 
                                                    id="cpc_address4">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="cpc_telephone4" 
                                                    id="cpc_telephone4">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="add_button7 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
                                        
                                        <div class="field_wrapper8 mt-3">
                                            <label class="bg-dark text-light p-2">Customer of Last Three Years:</label><br>
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="clty_institution"
                                                    id="clty_institution">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="clty_address" 
                                                    id="clty_address">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="clty_telephone" 
                                                    id="clty_telephone">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="clty_institution1"
                                                    id="clty_institution1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="clty_address1"
                                                    id="clty_address1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="clty_telephone1"
                                                    id="clty_telephone1">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="clty_institution2"
                                                    id="clty_institution2">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="clty_address2"
                                                    id="clty_address2">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="clty_telephone2"
                                                    id="clty_telephone2">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="clty_institution3"
                                                    id="clty_institution3">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="clty_address3" 
                                                    id="clty_address3">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="clty_telephone3"
                                                    id="clty_telephone3">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Institution" name="clty_institution4" 
                                                    id="clty_institution4">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Address" name="clty_address4"
                                                    id="clty_address4">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                  <input type="text" class="form-control" placeholder="Telephone" name="clty_telephone4"
                                                    id="clty_telephone4">
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
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input form-fs" type="checkbox" value="construction and installation works" id="cons-ins-works" name="fs[]">
                                                        <label class="form-check-label" for="cons-ins-works">
                                                            Construction And Installation Works
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input form-fs" type="checkbox" value="fabrication and machining" id="fab-machnng" name="fs[]">
                                                        <label class="form-check-label" for="fab-machnng">
                                                            Fabrication And Machining
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input form-fs" type="checkbox" value="consultancy and firms" id="cons-and-firms" name="fs[]">
                                                        <label class="form-check-label" for="cons-and-firms">
                                                            Consultancy And Firms
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <div class="form-group left">
                                    <button type="button" id="supplier_form_btn" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>
                        </form>

                    </div>

                

            </div>

        </div>

    </section>
    
   
@endsection

@section('pagejs')
    <script type="text/javascript">

        var js_supplier_officers = {!! old('h_officers', $supplier_officers ? $supplier_officers:[]) !!};
        var js_supplier_bank_d_swift = {!! old('h_bank_details_swift', $supplier_bank_d_swift) !!};
        var js_supplier_bank_d_iban = {!! old('h_bank_details_iban', $supplier_bank_d_iban) !!};
        var js_supplier_services = {!! old('h_services', $supplier_servicess) !!};
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

        if(typeof js_supplier_officers === 'string') { JSON.parse(js_supplier_officers); }
        if(typeof js_supplier_bank_d_swift === 'string') { JSON.parse(js_supplier_bank_d_swift); }
        if(typeof js_supplier_bank_d_iban === 'string') { JSON.parse(js_supplier_bank_d_iban); }
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
        

        jQuery(document).ready( function(){
            
            $('.datepicker').datepicker({
                autoclose: true
            }); 
            
            // Company Logo
            $("#explosives_and_accessories_img").change(function() {
                readLogo(this, 'explosives_and_accessories_img_display');
            });
            $("#chemicals_license_img").change(function() {
                readLogo(this, 'chemicals_license_img_display');
            });
            $("#machinery_and_equipment_img").change(function() {
                readLogo(this, 'machinery_and_equipment_img_display');
            });
            $("#electrical_img").change(function() {
                readLogo(this, 'electrical_img_display');
            });
            $("#electronic_and_instrumentation_img").change(function() {
                readLogo(this, 'electronic_and_instrumentation_img_display');
            });
            $("#information_and_communication_technology_img").change(function() {
                readLogo(this, 'information_and_communication_technology_img_display');
            });
            $("#ppe_and_safety_apparels_img").change(function() {
                readLogo(this, 'ppe_and_safety_apparels_img_display');
            });
            $("#medical_img").change(function() {
                readLogo(this, 'medical_img_display');
            });
            $("#repairs_and_maintenance_services_img").change(function() {
                readLogo(this, 'repairs_and_maintenance_services_img_display');
            });
            $("#construction_and_installation_works_img").change(function() {
                readLogo(this, 'construction_and_installation_works_img_display');
            });
            $("#fabrication_and_machining_img").change(function() {
                readLogo(this, 'fabrication_and_machining_img_display');
            });
            $("#consultancy_and_firms_img").change(function() {
                readLogo(this, 'consultancy_and_firms_img_display');
            });
            $("#others_license_img").change(function() {
                readLogo(this, 'others_license_img_display');
            });
            $("#utilities_img").change(function() {
                readLogo(this, 'utilities_img_display');
            });


            function readLogo(input, target) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    console.log(target);
                    reader.onload = function(e) {
                        console.log(target);
                        $('#'+target).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);

                }
            }

            // assign data on multiple fields

            if(js_supplier_officers.length>0) {
                
                $.each(js_supplier_officers, function(key, val){
                    if(key == 0){
                        $('#officer_name').val(val.name);
                        $('#officer_position').val(val.position);
                    } else {
                        let officer_html = '<div class="row"><div class="col-md-5 form-group"><input type="text" id="officer_name'+key+'" class="form-control" placeholder="Name" name="officer_name'+key+'" value="'+val.name+'">';
                        officer_html += '</div><div class="col-10 col-md-6 form-group">';
                        officer_html += '<input type="text" id="officer_position'+key+'" class="form-control" placeholder="Position" name="officer_position'+key+'" value="'+val.position+'"></div>';
                        officer_html += '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></a></div></div>';
                        $('#officers-field-wrapper').append(officer_html);
                    }
                    
                });

            }

            if(js_supplier_bank_d_swift.length>0) {
                $.each(js_supplier_bank_d_swift, function(key, val){
                    if(key == 0){
                        $('#swift_bank_details_name').val(val.bank_name);
                        $('#swift_bank_details_accnt').val(val.account_name);
                        $('#swift_bank_details_swift').val(val.code);
                    }else{
                        let bank_html = '<div class="row pb-0"><div class="col-12"><hr></div><div class="col-md-2"><label>Bank Name:</label></div>';
                            bank_html+= '<div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="swift_bank_details_name'+key+'" id="swift_bank_details_name'+key+'" class="form-control required valid" value="'+val.bank_name+'">';
                            bank_html+= '</div>';
                            bank_html+= '<div class="col-md-2"><label>Account Name:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="swift_bank_details_accnt'+key+'" id="swift_bank_details_accnt'+key+'" class="form-control required valid" value="'+val.account_name+'"></div>';
                            bank_html+= '<div class="col-md-2"><label>Swift Code:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="swift_bank_details_swift'+key+'" id="swift_bank_details_swift'+key+'" class="form-control required valid" value="'+val.code+'"></div>';
                            bank_html+= '<div class="col-12">&nbsp;</div><div class="col-md-2"><label>Bank Name:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="iban_bank_details_name'+key+'" id="iban_bank_details_name'+key+'" class="form-control required valid"></div>';
                            bank_html+= '<div class="col-md-2"><label>Account Name:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="iban_bank_details_accnt'+key+'" id="iban_bank_details_accnt'+key+'" class="form-control required valid"></div>';
                            bank_html+= '<div class="col-md-2"><label>IBAN Code:</label></div>';
                            bank_html+= '<div class="col-9"><input type="text" name="iban_bank_details_iban'+key+'" id="iban_bank_details_iban'+key+'" class="form-control required valid"></div>';
                            bank_html+= '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button1 btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></div></a></div>'; 

                        $('.field_wrapper1').append(bank_html);
                    }
                });
            }


            if(js_supplier_bank_d_iban.length>0) {
                $.each(js_supplier_bank_d_iban, function(key, val){
                    if(key == 0){
                        $('#iban_bank_details_name').val(val.bank_name);
                        $('#iban_bank_details_accnt').val(val.account_name);
                        $('#iban_bank_details_iban').val(val.code);
                    } else {

                        if($('#iban_bank_details_name'+key).length) {
                            $('#iban_bank_details_name'+key).val(val.bank_name);
                            $('#iban_bank_details_accnt'+key).val(val.account_name);
                            $('#iban_bank_details_iban'+key).val(val.code);
                        } else {
                        let bank_html = '<div class="row pb-0"><div class="col-12"><hr></div><div class="col-md-2"><label>Bank Name:</label></div>';
                            bank_html+= '<div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="swift_bank_details_name'+key+'" id="swift_bank_details_name'+key+'" class="form-control required valid">';
                            bank_html+= '</div>';
                            bank_html+= '<div class="col-md-2"><label>Account Name:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="swift_bank_details_accnt'+key+'" id="swift_bank_details_accnt'+key+'" class="form-control required valid"></div>';
                            bank_html+= '<div class="col-md-2"><label>Swift Code:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="swift_bank_details_swift'+key+'" id="swift_bank_details_swift'+key+'" class="form-control required valid"></div>';
                            bank_html+= '<div class="col-12">&nbsp;</div><div class="col-md-2"><label>Bank Name:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="iban_bank_details_name'+key+'" id="iban_bank_details_name'+key+'" class="form-control required valid" value="'+val.bank_name+'"></div>';
                            bank_html+= '<div class="col-md-2"><label>Account Name:</label></div><div class="col-md-10 form-group">';
                            bank_html+= '<input type="text" name="iban_bank_details_accnt'+key+'" id="iban_bank_details_accnt'+key+'" class="form-control required valid" value="'+val.account_name+'"></div>';
                            bank_html+= '<div class="col-md-2"><label>IBAN Code:</label></div>';
                            bank_html+= '<div class="col-9"><input type="text" name="iban_bank_details_iban'+key+'" id="iban_bank_details_iban'+key+'" class="form-control required valid" value="'+val.code+'"></div>';
                            bank_html+= '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button1 btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></div></a></div>'; 

                        $('.field_wrapper1').append(bank_html);
                        }

                    }
                });
            }

            if(js_supplier_services.length>0){
                $.each(js_supplier_services, function(key, val) {
                    let service_name = val.cat.replaceAll(" ","_").toLowerCase();                    
                    $('#'+service_name).click();
                    $('#'+service_name+'_license').val(val.license);
                    $('#'+service_name+'_img_display').attr('src',val.attachment);
                    if( service_name == 'others') {
                        $('#'+service_name+'-goods').click();
                        $('#'+service_name+'_license_name').val(val.name);
                    }
                });
            }

            if(js_supplier_ac.length>0){
                $('#chkYes').click();

                $.each(js_supplier_ac, function(key, val){
                    if(key == 0){
                        $('#ac_institution').val(val.institution);
                        $('#ac_address').val(val.address);
                        $('#ac_telephone').val(val.phone);
                    }else{
                        var ac_html  = '<div class="row"><div class="col-md-4 form-group">';
                            ac_html += '<input type="text" class="form-control" placeholder="Institution" id="ac_institution'+key+'" name="ac_institution'+key+'" value="'+val.institution+'"></div>';
                            ac_html += '<div class="col-md-4 form-group">';
                            ac_html += '<input type="text" class="form-control" placeholder="Address" id="ac_address'+key+'" name="ac_address'+key+'" value="'+val.address+'"></div>';
                            ac_html += '<div class="col-10 col-md-3 form-group">';
                            ac_html += '<input type="text" class="form-control" placeholder="Telephone" id="ac_telephone'+key+'" name="ac_telephone'+key+'" value="'+val.phone+'"></div>';
                            ac_html += '<div class="col-1 p-0 form-group"><a href="javascript:void(0);" class="remove_button2 btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                        
                        $('.field_wrapper2').append(ac_html); //Add field html
                    }
                });
            }

            if(js_supplier_genreq.length>0) {

                $.each(js_supplier_genreq, function(key, val){

                    switch(val.name) {

                        case 'dti sec':
                            $('#dti-sec-reg').prop('checked', 'checked');
                            break;
                        case 'license to operate':
                            $('#lcns-operate').prop('checked','checked');
                            break;
                        case 'sales':
                            $('#sales-charge-comm-bill').prop('checked', 'checked');
                            break;
                        case 'business permit':
                            $('#bsnss-permit').prop('checked', 'checked');
                            break;
                        case 'bir':
                            $('#bit-cor-atp').prop('checked', 'checked');
                            break;
                        case 'official receipt':
                            $('#coll-off-rcpt').prop('checked', 'checked');
                            break;

                    }

                });

            }

            if(js_supplier_cqualities.length>0) {
                $('#qlty-standards').click();
                $.each(js_supplier_cqualities, function(key, val){
                    
                    if(key == 0){
                        $('#cert_quality').val(val.details);
                    } else {
                        var cqualities_html  = '<div class="row"><div class="col-md-10 col-10 form-group">';
                            cqualities_html += '<input type="text" id="cert_quality'+key+'" name="cert_quality'+key+'" class="form-control required" value="'+val.details+'" ></div>';
                            cqualities_html += '<div class="col-1 p-0 form-group">';
                            cqualities_html += '<a href="javascript:void(0);" class="remove_button3 btn btn-danger" title="Add field">';
                            cqualities_html += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                       
                        $('.field_wrapper3').append(cqualities_html); //Add field html
                    }

                });

            }

            if(js_supplier_cenveronmentals.length>0) {
                $('#nvrment-stdrds').click();
                $.each(js_supplier_cenveronmentals, function(key, val){
                    
                    if(key == 0){
                        $('#cert_environmental').val(val.details);
                    } else {
                        cenveronmentals_html
                        var cenveronmentals_html  = '<div class="row"><div class="col-md-10 col-10 form-group">';
                            cenveronmentals_html += '<input type="text" id="cert_environmental'+key+'" name="cert_environmental'+key+'" class="form-control required" value="'+val.details+'" ></div>';
                            cenveronmentals_html += '<div class="col-1 p-0 form-group">';
                            cenveronmentals_html += '<a href="javascript:void(0);" class="remove_button5 btn btn-danger" title="Add field">';
                            cenveronmentals_html += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                       
                        $('.field_wrapper5').append(cenveronmentals_html); //Add field html
                    }

                });

            }

            if(js_supplier_csafety.length>0) {
                $('#sfty-chck').click();
                $.each(js_supplier_csafety, function(key, val){
                    
                    if(key == 0){
                        $('#cert_safety').val(val.details);
                    } else {
                        var csafety_html  = '<div class="row"><div class="col-md-10 col-10 form-group">';
                            csafety_html += '<input type="text" id="cert_safety'+key+'" name="cert_safety'+key+'" class="form-control required" value="'+val.details+'" ></div>';
                            csafety_html += '<div class="col-1 p-0 form-group">';
                            csafety_html += '<a href="javascript:void(0);" class="remove_button4 btn btn-danger" title="Add field">';
                            csafety_html += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                       
                        $('.field_wrapper4').append(csafety_html); //Add field html
                    }

                });

            }

            if(js_supplier_cothers.length>0) {
                $('#other-cert').click();
                $.each(js_supplier_cothers, function(key, val){
                    
                    if(key == 0){
                        $('#cert_others').val(val.details);
                    } else {
                        var cothers_html  = '<div class="row"><div class="col-md-10 col-10 form-group">';
                            cothers_html += '<input type="text" id="cert_others'+key+'" name="cert_others'+key+'" class="form-control required" value="'+val.details+'" ></div>';
                            cothers_html += '<div class="col-1 p-0 form-group">';
                            cothers_html += '<a href="javascript:void(0);" class="remove_button6 btn btn-danger" title="Add field">';
                            cothers_html += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                       
                        $('.field_wrapper6').append(cothers_html); //Add field html
                    }

                });

            }

            if(js_supplier_controllered_comms.length>0){
                $.each(js_supplier_controllered_comms, function(key, val){
                    let controlled_comm = val.name.toLowerCase();    
                    console.log(controlled_comm);  
                    console.log(val.cat);
                    console.log("==========");
                    switch(controlled_comm) {
                        case 'utility':
                            $('#utilitys').prop('checked','checked');
                            break;
                        case 'construction and installation':
                            $('#cons-works').prop('checked','checked');
                            break;
                        case 'fabrication and machining':
                            $('#fabric').prop('checked', 'checked');
                            break;
                        case 'consultancy and firms':
                            $('#cons-firms').prop('checked', 'checked');
                            break;
                        case 'repairs and maintenance':
                            $('#rprs-serv').prop('checked','checked');
                            break;
                        default:
                            $('#other-timb').click();
                            $('#other_cert_others').val(val.name);
                            break;
                    }

                });
            }

            if(js_supplier_mc.length>0) {

                $.each(js_supplier_mc, function(key, val) {

                    if(key == 0) {
                        $('#cpc_institution').val(val.name);
                        $('#cpc_address').val(val.address);
                        $('#cpc_telephone').val(val.phone);
                    } else if( key < 5 ) {
                        $('#cpc_institution'+key).val(val.name);
                        $('#cpc_address'+key).val(val.address);
                        $('#cpc_telephone'+key).val(val.phone);
                    } else {
                        var mc_html  = '<div class="row"><div class="col-md-4 form-group">';
                            mc_html += '<input type="text" class="form-control" placeholder="Institution" id="cpc_institution'+key+'" name="cpc_institution'+key+'" value="'+val.name+'"></div>';
                            mc_html += '<div class="col-md-4 form-group"><input type="text" class="form-control" placeholder="Address" id="cpc_address'+key+'" name="cpc_address'+key+'" value="'+val.address+'"></div>';
                            mc_html += '<div class="col-10 col-md-3 form-group"><input type="text" class="form-control" placeholder="Telephone" id="cpc_telephone'+key+'" name="cpc_telephone'+key+'" value="'+val.phone+'">';
                            mc_html += '</div><div class="col-1 p-0 form-group">';
                            mc_html += '<a href="javascript:void(0);" class="remove_button7 btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                        
                        $('.field_wrapper7').append(mc_html); //Add field html
                    }

                });
            }


            if(js_supplier_lty.length>0) {

                $.each(js_supplier_lty, function(key, val) {

                    if(key == 0) {
                        $('#clty_institution').val(val.name);
                        $('#clty_address').val(val.address);
                        $('#clty_telephone').val(val.phone);
                    } else if( key < 5 ) {
                        $('#clty_institution'+key).val(val.name);
                        $('#clty_address'+key).val(val.address);
                        $('#clty_telephone'+key).val(val.phone);
                    } else {
                        var lty_html  = '<div class="row"><div class="col-md-4 form-group">';
                            lty_html += '<input type="text" class="form-control" placeholder="Institution" id="clty_institution'+key+'" name="clty_institution'+key+'" value="'+val.name+'"></div>';
                            lty_html += '<div class="col-md-4 form-group"><input type="text" class="form-control" placeholder="Address" id="clty_address'+key+'" name="clty_address'+key+'" value="'+val.address+'"></div>';
                            lty_html += '<div class="col-10 col-md-3 form-group"><input type="text" class="form-control" placeholder="Telephone" id="clty_telephone'+key+'" name="clty_telephone'+key+'" value="'+val.phone+'">';
                            lty_html += '</div><div class="col-1 p-0 form-group"><a href="javascript:void(0);" class="remove_button8 btn btn-danger" title="Add field">';
                            lty_html += '<i class="icon-minus-circle"></i></a></div></div>';
                            $('.field_wrapper8').append(lty_html); //Add field html 
                    }

                });

            }

            if( js_supplier_fs.length>0) {
                $.each(js_supplier_fs, function(key, val){

                    switch(val.name) {
                        case 'construction and installation works':
                            $('#cons-ins-works').prop('checked', 'checked');
                            break;
                        case 'fabrication and machining':
                            $('#fab-machnng').prop('checked', 'checked');
                            break;
                        case 'consultancy and firms':
                            $('#cons-and-firms').prop('checked','checked');
                            break;
                    }

                });
            }


            $('#supplier_form_btn').click(function(e){

                e.preventDefault();

                let supp_officers = [];
                let supp_bank_d_swift = [];
                let supp_bank_d_iban = [];
                let supp_ac = [];
                let supp_qualities = [];
                let supp_environmental = [];
                let supp_safety = [];
                let supp_others = [];
                let supp_mc = [];
                let supp_clty = [];    
                let supp_services = [];     
                let supp_genreq = [];
                let supp_controlled_comms = [];
                let supp_fs = [];

                // check all supplier officers inputed
                $('[id*=officer_name]:visible').each(function(i, officer){
                    if(i == 0 ){
                        supp_officers.push({
                            name     : $("#officer_name").val() ,
                            position : $("#officer_position").val()
                        });
                    } else {
                        supp_officers.push({
                            name     : $("#officer_name"+i).val() ,
                            position : $("#officer_position"+i).val()
                        });
                    }
                });

                //check all supplier bank details
                $('[id*=swift_bank_details_name]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_bank_d_swift.push({
                            bank_name     : $("#swift_bank_details_name").val() ,
                            account_name  : $("#swift_bank_details_accnt").val() ,
                            code     : $('#swift_bank_details_swift').val()
                        });
                    } else {
                        supp_bank_d_swift.push({
                            bank_name     : $("#swift_bank_details_name"+i).val() ,
                            account_name  : $("#swift_bank_details_accnt"+i).val() ,
                            code     : $('#swift_bank_details_swift'+i).val()
                        });
                    }
                });

                $('[id*=iban_bank_details_name]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_bank_d_iban.push({
                            bank_name     : $("#iban_bank_details_name").val() ,
                            account_name  : $("#iban_bank_details_accnt").val() ,
                            code     : $('#iban_bank_details_iban').val()
                        });
                    } else {
                        supp_bank_d_iban.push({
                            bank_name     : $("#iban_bank_details_name"+i).val() ,
                            account_name  : $("#iban_bank_details_accnt"+i).val() ,
                            code     : $('#iban_bank_details_iban'+i).val()
                        });
                    }
                });

                // check all access credits 
                $('[id*=ac_institution]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_ac.push({
                            institution     : $("#ac_institution").val() ,
                            address  : $("#ac_address").val() ,
                            phone: $('#ac_telephone').val()
                        });
                    } else {
                        supp_ac.push({
                            institution     : $("#ac_institution"+i).val() ,
                            address  : $("#ac_address"+i).val() ,
                            phone: $('#ac_telephone'+i).val()
                        });
                    }
                });

                // check all quality standards
                $('[id*=cert_quality]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_qualities.push({
                            'details' : $("#cert_quality").val()
                        });
                    } else {
                        supp_qualities.push({
                            'details' : $("#cert_quality"+i).val() 
                        });
                    }
                });

                // check all environment standards
                $('[id*=cert_environmental]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_environmental.push({
                            'details' : $("#cert_environmental").val()
                        });
                    } else {
                        supp_environmental.push({
                            'details' : $("#cert_environmental"+i).val() 
                        });
                    }
                });

                // check all safety standards
                $('[id*=cert_safety]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_safety.push({
                            'details' : $("#cert_safety").val()
                        });
                    } else {
                        supp_safety.push({
                            'details' : $("#cert_safety"+i).val() 
                        });
                    }
                });

                // check all other standards
                $('[id*=cert_others]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_others.push({
                            'details' : $("#cert_others").val()
                        });
                    } else {
                        supp_others.push({
                            'details' : $("#cert_others"+i).val() 
                        });
                    }
                });


                // check all current and past customers
                $('[id*=cpc_institution]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_mc.push({
                            name     : $("#cpc_institution").val() ,
                            address  : $("#cpc_address").val() ,
                            phone: $("#cpc_telephone").val()
                        });
                    } else {
                        supp_mc.push({
                            name     : $("#cpc_institution"+i).val() ,
                            address  : $("#cpc_address"+i).val() ,
                            phone: $("#cpc_telephone"+i).val()
                        });
                    }
                });


                // check all current and past customers
                $('[id*=clty_institution]:visible').each(function(i, bankDetails){
                    if(i == 0 ){
                        supp_clty.push({
                            name     : $("#clty_institution").val() ,
                            address  : $("#clty_address").val() , 
                            phone: $("#clty_telephone").val()
                        });
                    } else {
                        supp_clty.push({
                            name     : $("#clty_institution"+i).val() ,
                            address  : $("#clty_address"+i).val() , 
                            phone: $("#clty_telephone"+i).val()
                        });
                    }
                });

                $('.form-services').each(function(key, val){
                    let service_name = $(this).val().replaceAll(' ', '_').toLowerCase();
                    if(this.checked) {
                        supp_services.push({
                            cat: $(this).val() ,
                            name: $(this).val() == 'others' ? $('#'+$(this).val()+"_license_name").val() : $(this).val() ,
                            license: $('#'+service_name+'_license').val()
                        });
                    }                 
                });

                $('.form-genreq').each(function(key, val){
                    
                    if(this.checked) {
                        supp_genreq.push({
                            name: $(this).val()
                        });
                    }                 
                });


                $('.form-controlled').each(function(key, val){

                    if(this.checked) {

                        supp_controlled_comms.push({
                            'cat' : $(this).val() ,
                            'name'  : $(this).val() == 'others' ? $('#other_cert_others').val() : $(this).val()
                        });

                    }

                });

                $('.form-fs').each(function(key, val){
                    if(this.checked) {

                        supp_fs.push({
                            'name'  : $(this).val()
                        });

                    }
                });

                // set data to input type hidden
                $('#h_officers').val(JSON.stringify(supp_officers));
                $('#h_bank_details_swift').val(JSON.stringify(supp_bank_d_swift));
                $('#h_bank_details_iban').val(JSON.stringify(supp_bank_d_iban));
                $('#h_ac').val(JSON.stringify(supp_ac));
                $('#h_cqualities').val(JSON.stringify(supp_qualities));
                $('#h_cenveronmentals').val(JSON.stringify(supp_environmental));
                $('#h_csafety').val(JSON.stringify(supp_safety));
                $('#h_cothers').val(JSON.stringify(supp_others));
                $('#h_mc').val(JSON.stringify(supp_mc));
                $('#h_clty').val(JSON.stringify(supp_clty));
                $('#h_services').val(JSON.stringify(supp_services));
                $('#h_genreq').val(JSON.stringify(supp_genreq));
                $('#h_controlled_comms').val(JSON.stringify(supp_controlled_comms));
                $('#h_fs').val(JSON.stringify(supp_fs));
                // return false;
                $('#supplier_form').submit();

            });

        })
    </script>

@endsection


