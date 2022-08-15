<div class="col-12">

    <div class="row" id="general_information_cont">

        @php 
            $b_type = ['contractor', 'manufacturer', 'distributor', 'trader'];
            if($data) {
                $sd_type = in_array($data->business_type, $b_type) ? $data->business_type:'other';
            } else {
                $sd_type = 'manufacturer';   
            }
        @endphp

        <div class="col-12">
            <h4 class="bg-secondary text-light p-3">A. General Information</h4>
        </div>

        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2"> Company Name: <span class="field-req">*</span></label>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" readonly class="form-control gen_input" placeholder="Name" id="company_name" name="company_name" value="{{ $data->company_name }}" data-parent="general_information" data-field="company_name">  
                </div>
            </div>
        </div>

        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2">Address: <span class="field-req">*</span></label>
            <div class="row">
                <div class="col-md-6 form-group">
                    <select class="form-control gen_input" id="country" name="country"
                        data-parent="general_information" data-field="country">
                        @foreach($countries as $country) 
                            <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="Province" id="province" name="province" value="{{ old('province', $data ? $data->province:'') }}" data-parent="general_information" data-field="province">
                    <select class="form-control gen_input" id="local-province" name="local_province"
                        data-parent="general_information" data-field="local_province"></select>
                </div>  
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="City Municipality" id="city" name="city" value="{{ old('city', $data ? $data->city:'') }}" data-parent="general_information" data-field="city">
                    <select class="form-control gen_input" id="local-city" name="local_city"
                        data-parent="general_information" data-field="local_city"></select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="Barangay" id="barangay" name="barangay" value="{{ old('barangay', $data ? $data->barangay:'') }}" data-parent="general_information" data-field="barangay">
                    <select class="form-control gen_input" id="local-barangay" name="local_barangay"
                        data-parent="general_information" data-field="local_barangay"></select>
                </div>                                            
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="Room/Floor/Unit No./Bldg Name" id="unit" name="unit" value="{{ old('unit', $data ? $data->unit:'') }}" data-parent="general_information" data-field="unit">                                                
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="House/Lot/Block/Phase No." id="block" name="block" value="{{ old('block', $data ? $data->block:'') }}" data-parent="general_information" data-field="block">
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="Street Name" id="street" name="street" value="{{ old('street', $data ? $data->street:'') }}" data-parent="general_information" data-field="street">
                </div>                                    
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control gen_input" placeholder="Zip Code" id="zip" name="zip" value="{{ old('zip', $data ? $data->zip:'') }}" data-parent="general_information" data-field="zip">
                </div>
            </div>
        </div>
        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2" for="tax-indentification-num"> Tax Identification Number: <span class="field-req">*</span></label><br>
            <input type="text" name="tin" id="tin" class="form-control gen_input  @error('tin') is-invalid @enderror" value="{{ old('tin', $data ? $data->tin:'') }}" placeholder="TIN #" data-parent="general_information" data-field="tin">
            @hasError(['inputName' => 'tin'])@endhasError
        </div>
        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2">Business Style: <span class="field-req">*</span></label>
            <div class="row">
                <div class="col-md-12 form-group">
                  <input type="text" class="form-control gen_input" id="business-style" name="business_style" value="{{ old('business_style', $data ? $data->business_style:'') }}" data-parent="general_information" data-field="business_style">
                </div>
            </div>
        </div>
        <div class="col-md-6 form-group">
            <label class="bg-dark text-light p-2" for="business-entity-type">Business Entity Type: <span class="field-req">*</span></label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input vats" checked type="radio" name="vat_registered" 
                    @if(old('vat_registered', $data ? $data->vat_registered:0) == 1) checked @endif id="vat-registered1" value="1" data-parent="general_information" data-field="vat_registered">
                <label class="form-check-label nott" for="vat-registered1">VAT Registered</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input vats" type="radio" @if(old('vat_registered', $data ? $data->vat_registered:0) == 0) checked @endif name="vat_registered" id="vat-registered2" value="0" data-parent="general_information" data-field="vat_registered">
                <label class="form-check-label nott" for="vat-registered2">Non-VAT Registered</label>
            </div>
        </div>
        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2" for="date-established">Date Established: <span class="field-req">*</span></label>
            <input type="text" class="form-control datepicker @error('date_established') is-invalid @enderror gen_input" name="date_established" id="date-established" value="{{ old('date_established', $data ? $data->date_established:'') }}" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="0d" data-parent="general_information" data-field="date_established">
            @hasError(['inputName' => 'date_established'])@endhasError
        </div>
        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2" for="company-website">Company Website (if any):</label>
            <input type="text" name="website" id="company-website" class="form-control url gen_input" placeholder="https://" value="{{ old('website', $data ? $data->website:'') }}" data-parent="general_information" data-field="website">
        </div>

        <div class="col-12 form-group">
            <label class="bg-dark text-light p-2">Classification of business: <span class="field-req">*</span></label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input b_type" type="radio" checked name="business_type" id="business-type1" value="manufacturer" onclick="ShowHideDiv()" @if(old('business_type', $sd_type)=='manufacturer') checked @endif data-parent="general_information" data-field="business_type">
                <label class="form-check-label nott" for="business-type1">Manufacturer</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input b_type" type="radio" name="business_type" id="business-type2" value="trader" onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'trader') checked @endif data-parent="general_information" data-field="business_type">
                <label class="form-check-label nott" for="business-type2">Trader</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input b_type" type="radio" name="business_type" id="business-type3" value="distributor" onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'distributor') checked @endif data-parent="general_information" data-field="business_type">
                <label class="form-check-label nott" for="business-type3">Distributor</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input b_type" type="radio" name="business_type" id="business-type4" value="contractor" onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'contractor') checked @endif data-parent="general_information" data-field="business_type">
                <label class="form-check-label nott" for="business-type4">Contractor</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input gen_input b_type" type="radio" name="business_type" id="business-type5" value="other" 
                onclick="ShowHideDiv()" @if(old('business_type', $sd_type) == 'other') checked @endif data-parent="general_information" data-field="business_type">
                <label class="form-check-label nott" for="business-type5">Others, please specify:</label>
            </div>
            <br/>
            <input type="text" name="other_business_type" id="other-business-type" class="form-control gen_input mt-2" value="{{ old('other_business_type', $sd_type == 'other' ? $data->business_type:'') }}" style="display: @if(old('business_type', $sd_type) == 'other') block @else none @endif" data-parent="general_information" data-field="business_type">
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
                <select class="form-control gen_input" name="organization_type" id="organization_type" data-parent="general_information" 
                    data-field="organization_type">
                    @foreach( $org_typpe as $type)
                        <option value="{{$type}}" 
                        @if(old('organization_type',$data ? $data->organization_type:'') == $type) selected @endif>{{ ucwords($type) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

</div>


    <script type="text/javascript">

        var js_general_information = {!! $data !!};
        sections.general_information = js_general_information;
        
        $(function() {

            $('.datepicker').datepicker({
                autoclose: true
            }); 

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
                        let selected = val.name == '{{ old('country', $data ? $data->country : "Philippines" ) }}' ? 'selected' : '';
                        $('#country').append(`<option value="${val.name}" data-code="${val.code}" ${selected}>${val.name}</option>`);
                    });
                    $('#country').change();
                    $('#organization_type').change();
                }
            });

            $(document).on('change','#country', function() {
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
                                let selected = (province == '{{ old('province', $data ? $data->province : "") }}') ? 'selected' : '';
                                $('#local-province').append(`<option value="${province}" data-code="${val.provCode}" ${selected}>`+province+`</option>`);
                                if (selected == 'selected') {
                                    $('#local-province').change();
                                }
                            });
                        }
                    });
                }
            });

            $(document).on('change', '#local-province', function() {
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
                                let selected = (city == '{{ old('city', $data ? $data->city : "") }}') ? 'selected' : '';
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

            $(document).on('change', '#local-city', function() {
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
                                let selected = (barangay == '{{ old('barangay', $data ? $data->barangay:"") }}') ? 'selected' : '';
                                if(val.citymunCode == $('option:selected', '#local-city').attr('data-code'))
                                    $('#local-barangay').append(`<option value="${barangay}" data-code="${val.brgyCode}" ${selected}>`+barangay+`</option>`);

                            });
                        });
                    }
                });
            }); 

            // $(document).on('change', '.gen_input', function() {

            //     let _section_container  = $(this).data('parent');
            //     let _section_input      = $(this).data('field');
            //     let _curr_value         = $(this).val();

            //     if( sections[_section_container][_section_input] != _curr_value)
            //         _sections[_section_container][_section_input] = _curr_value;

            // });

            $(document).on('change', '#organization_type', function() {
                
                if($('#organization_type').val() == 'sole proprietorship') {
                    $('#sec').prop('disabled','disabled');
                    $('#sec').prop('checked', false);
                    $('#dti').prop('disabled', false);
                } else {
                    $('#dti').prop('disabled','disabled');
                    $('#dti').prop('checked', false);
                    $('#sec').prop('disabled', false);
                }

            });

            $(document).on('change', '#country', function () {
                if($('#country').val() == 'Philippines') {
                    $('#foreign_company_profile').prop('disabled', 'disabled').prop('checked', false);
                    $('#foreign_sample_charge_invoice').prop('disabled', 'disabled').prop('checked', false);
                    $('#business_registration_documents').prop('disabled', 'disabled').prop('checked', false);
                    $('#foreign_general_information_sheet').prop('disabled', 'disabled').prop('checked', false);

                    $('#sample_sales_invoice').prop('disabled', false);
                    $('#sample_official_receipt').prop('disabled', false);
                    $('#sample_delivery_receipt').prop('disabled', false);
                    $('#sample_collection_receipt').prop('disabled', false);
                    $('#ph_sample_charge_invoice').prop('disabled', false);
                    $('#ph_company_profile').prop('disabled', false);
                    $('#license_to_operate').prop('disabled', false);
                    $('#ph_general_information_sheet').prop('disabled', false);

                    if($('#org_type').val() != 'sole proprietorship') {
                        $('#sec').prop('disabled', false);
                    } else {
                        $('#dti').prop('disabled', false);
                    }

                    $('#bir').prop('disabled', false);
                    $('#sss').prop('disabled', false);
                    $('#philhealth').prop('disabled', false);
                    $('#hdmf_registration').prop('disabled', false);
                    $('#mayors_permit').prop('disabled', false);
                } else {
                    $('#sample_sales_invoice').prop('disabled', 'disabled').prop('checked', false);
                    $('#sample_official_receipt').prop('disabled', 'disabled').prop('checked', false);
                    $('#sample_delivery_receipt').prop('disabled', 'disabled').prop('checked', false);
                    $('#sample_collection_receipt').prop('disabled', 'disabled').prop('checked', false);
                    $('#ph_sample_charge_invoice').prop('disabled', 'disabled').prop('checked', false);
                    $('#ph_company_profile').prop('disabled', 'disabled').prop('checked', false);
                    $('#license_to_operate').prop('disabled', 'disabled').prop('checked', false);
                    $('#ph_general_information_sheet').prop('disabled', 'disabled').prop('checked', false);

                    $('#dti').prop('disabled', 'disabled').prop('checked', false);
                    $('#sec').prop('disabled', 'disabled').prop('checked', false);
                    $('#bir').prop('disabled', 'disabled').prop('checked', false);
                    $('#sss').prop('disabled', 'disabled').prop('checked', false);
                    $('#philhealth').prop('disabled', 'disabled').prop('checked', false);
                    $('#hdmf_registration').prop('disabled', 'disabled').prop('checked', false);
                    $('#mayors_permit').prop('disabled', 'disabled').prop('checked', false);

                    $('#foreign_company_profile').prop('disabled', false);
                    $('#foreign_sample_charge_invoice').prop('disabled', false);
                    $('#business_registration_documents').prop('disabled', false);
                    $('#foreign_general_information_sheet').prop('disabled', false);
                }
            });

        });

        function ShowHideDiv() {             
            // A. General Information - business type form
            var chkYes1 = document.getElementById("business-type5");
            var dvtext1 = document.getElementById("other-business-type");
            dvtext1.style.display = chkYes1.checked ? "block" : "none";
        }

        function getGeneralInformation() {
            _sections.general_information = {};
            var _general_information = [];

            $('.gen_input').each(function() {

                let _section_container  = $(this).data('parent');
                let _section_input      = $(this).data('field');
                let _curr_value         = $(this).val();

                if( $('#country').val() == 'Philippines' && 
                    (_section_input == 'local_province' || _section_input == 'local_city' || _section_input == 'local_barangay') ) {

                    _section_input = _section_input.replaceAll("local_","");

                    if( sections[_section_container][_section_input] != _curr_value.trim())                       
                        _sections[_section_container][_section_input] = _curr_value;


                } else {

                    if( _section_input == 'business_type' ){
                        _curr_value = $('.b_type:checked').val();
                    } else if ( _section_input == 'vat_registered' ) {
                        _curr_value = $('.vats:checked').val();
                    } 

                    if( sections[_section_container][_section_input] != _curr_value) {
                        _sections[_section_container][_section_input] = _curr_value;                        
                    }
                }

            });

        }

    </script>
