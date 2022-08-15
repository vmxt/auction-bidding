<div class="col-12">
    <h4 class="bg-secondary text-light p-3">General Requirement. ( must have for philippine business ) 
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
    <h4 class="bg-secondary text-light p-3">Philippine Registered Business. ( Additional Requirements )</h4>
    
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
    <h4 class="bg-secondary text-light p-3">For Foreign Registered Business.</h4>
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

<script type="text/javascript">
    
    var js_supplier_genreq = {!! $data !!};
    sections.general_requirements = js_supplier_genreq;
    _sections.general_requirements = {};
    var js_supplier_details = {!! $supplier_details !!};
    var gen_req = [];

    function d_dti() {
        var checkBoxd1 = document.getElementById("dti");
        var textd1 = document.getElementById("dti_wrap");
        if (checkBoxd1.checked == true){
            textd1.style.display = "block";
        } else {
            textd1.style.display = "none";
        }
    }

    function d_sec() {
        var checkBoxd5 = document.getElementById("sec");
        var textd5 = document.getElementById("sec_wrap");
        if (checkBoxd5.checked == true){
            textd5.style.display = "block";
        } else {
            textd5.style.display = "none";
        }
    }

    function d_bir() {
        var checkBoxd5 = document.getElementById("bir");
        var textd5 = document.getElementById("bir_wrap");
        if (checkBoxd5.checked == true){
            textd5.style.display = "block";
        } else {
            textd5.style.display = "none";
        }
    }

    function d_sss() {
        var checkBoxd5 = document.getElementById("sss");
        var textd5 = document.getElementById("sss_wrap");
        if (checkBoxd5.checked == true){
            textd5.style.display = "block";
        } else {
            textd5.style.display = "none";
        }
    }

    function d_hdmf_registration() {
        var checkBoxd5 = document.getElementById("hdmf_registration");
        var textd5 = document.getElementById("hdmf_registration_wrap");
        if (checkBoxd5.checked == true){
            textd5.style.display = "block";
        } else {
            textd5.style.display = "none";
        }
    }

    function d_philhealth() {
        var checkBoxd5 = document.getElementById("philhealth");
        var textd5 = document.getElementById("philhealth_wrap");
        if (checkBoxd5.checked == true){
            textd5.style.display = "block";
        } else {
            textd5.style.display = "none";
        }
    }

    function d_mayors_permit() {
        var checkBoxd2 = document.getElementById("mayors_permit");
        var textd2 = document.getElementById("mayors_permit_wrap");
        if (checkBoxd2.checked == true){
            textd2.style.display = "block";
        } else {
            textd2.style.display = "none";
        }
    }

    function d_sample_si() {
        var checkBoxd3 = document.getElementById("sample_sales_invoice");
        var textd3 = document.getElementById("sample_sales_invoice_wrap");
        if (checkBoxd3.checked == true){
            textd3.style.display = "block";
        } else {
            textd3.style.display = "none";
        }
    }

    function d_sample_or() {
        var checkBoxd4 = document.getElementById("sample_official_receipt");
        var textd4 = document.getElementById("sample_official_receipt_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_sample_delivery_receipt() {
        var checkBoxd4 = document.getElementById("sample_delivery_receipt");
        var textd4 = document.getElementById("sample_delivery_receipt_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_sample_collection_receipt() {
        var checkBoxd4 = document.getElementById("sample_collection_receipt");
        var textd4 = document.getElementById("sample_collection_receipt_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_ph_company_profile() {
        var checkBoxd4 = document.getElementById("ph_company_profile");
        var textd4 = document.getElementById("ph_company_profile_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_ph_sample_charge_invoice() {
        var checkBoxd4 = document.getElementById("ph_sample_charge_invoice");
        var textd4 = document.getElementById("ph_sample_charge_invoice_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_business_registration_documents() {
        var checkBoxd4 = document.getElementById("business_registration_documents");
        var textd4 = document.getElementById("business_registration_documents_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_general_information_sheet() {
        var checkBoxd4 = document.getElementById("foreign_general_information_sheet");
        var textd4 = document.getElementById("foreign_general_information_sheet_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_general_information_sheet_ph() {
        var checkBoxd4 = document.getElementById("ph_general_information_sheet");
        var textd4 = document.getElementById("ph_general_information_sheet_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_foreign_sample_charge_invoice() {
        var checkBoxd4 = document.getElementById("foreign_sample_charge_invoice");
        var textd4 = document.getElementById("foreign_sample_charge_invoice_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function d_foreign_company_profile() {
        var checkBoxd4 = document.getElementById("foreign_company_profile");
        var textd4 = document.getElementById("foreign_company_profile_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    if(js_supplier_genreq.length>0) {

        let cntry = js_supplier_details.country ?  js_supplier_details.country : 'Philippines';
        
        if(cntry == 'Philippines') {
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


        $.each(js_supplier_genreq, function(key, val){

            let _req = val.name.replaceAll(" ","_").toLowerCase();
            let _attachment_name = null;
            let _data = {
                name : null , 
                attachment: null ,
                validity: null
            };

            if(val.validity != null) {
                var _date = new Date(val.validity);
                _date = _date.getMonth() +'/'+ _date.getDate() +'/'+ _date.getFullYear();
                $('#'+_req+'_validity').val(_date);
            }
            
            _data.name = _req;
            _data.validity = val.validity;

            if(val.attachment) {

                if( cntry == 'Philippines' &&  ( _req == 'sample_charge_invoice' || _req == 'company_profile'
                    || _req == 'general_information_sheet' ) ) {

                    _req = 'ph_'+_req;               

                } else {

                    if(cntry != 'Philippines' &&  ( _req == 'sample_charge_invoice' || _req == 'company_profile' 
                        || _req == 'general_information_sheet' ) ) {

                        _req = 'foreign_'+_req;    

                    }

                }

                $('#'+_req+"_attachment_holder").empty();

                _attachment_name = val.attachment.split('/').reverse();

                var html  = '<label for="'+_req+'_validity">Attachment'; 
                    html += '<span class="field-req1">*</span></label>';
                    html += '<p><a href="'+storage_url+val.attachment+'" target="_blank" id="'+_req+'_img_exist">'+_attachment_name[0]+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    html += '<a href="javascript:void(0);" class="remove-logo" data-tdkey="'+_req+'" data-from="gen_req">x</a></p>';

                $('#'+_req+"_attachment_holder").append(html);

                _data.attachment = _attachment_name[0];
                
            }

            $('#'+_req).prop('checked', 'checked');
            $('#'+_req+"_wrap").css('display', 'block');        

            gen_req[_req] = _data;

        });

    }

    function getGeneralRequirements() {

        let supp_genreq = [];
        let _for_update = [];
        let cntry = js_supplier_details.country ?  js_supplier_details.country : 'Philippines';

        $('.form-genreq').each(function(key, val){
            if(this.checked) {
                let _req_n = val.value.replaceAll(" ", "_").toLowerCase();

                if(cntry == 'Philippines' || cntry == 'PH'){
                    
                    if( _req_n == 'company_profile' || _req_n == 'sample_charge_invoice' 
                        || _req_n == 'general_information_sheet' ) {
                        _req_n = 'ph_'+_req_n;
                    } 

                } else {

                    if( _req_n == 'company_profile' || _req_n == 'sample_charge_invoice'
                        || _req_n == 'general_information_sheet' ) {
                        _req_n = 'foreign_'+_req_n;
                    }

                }

                if( _req_n != 'license_to_operate' ) {

                    if( $('#'+_req_n+"_attachment").val() == '' ) {

                        $('body, html').animate({
                            scrollTop: $('#'+_req_n+"_attachment").offset().top - 250
                        }, 600);

                        attachment_added = false;

                        alert(val.value + " attachment is required");

                        return false;

                    } else {
                        attachment_added = true;
                    }

                }

                if( $('#'+_req_n+'_validity').length > 0 && $('#'+_req_n+'_validity').val() == '') {

                    $('body, html').animate({
                        scrollTop: $('#'+_req_n+"_validity").offset().top - 250
                    }, 600);

                    validity_added = false;

                    alert(val.value + " validity period is required");

                    return false;

                } else {
                    validity_added = true;
                }

                supp_genreq.push({
                    'name': val.value , 
                    'validity':  $('#'+_req_n+'_validity').length > 0 ? $('#'+_req_n+'_validity').val() : null ,
                    'img_exist': $('#'+_req_n+'_img_exist').length > 0 ? $('#'+_req_n+'_img_exist').text() : null
                });
            }                 
        });

        $.each(js_supplier_genreq, function(k,v) {

            let _match = false;

            $.each(supp_genreq, function(k1, v1) {
                
                if( v.name == v1.name ) {
                    _match = true;
                    return;
                }

            });

            if(!_match) {
                // update
                    _for_update.push({
                    'name'          : v.name ,
                    'attachment'    : v.img_exist ,
                    'validity'      : v.validity ,
                    'action'        : 'remove'
                });

            }

        });
        
        // $.each(supp_genreq, function(k,v) {

        //     let _match = false;

        //     $.each(js_supplier_genreq, function(k1, v1) {

        //         if( v.name == v1.name ) {
        //             _match = true;
        //             return;
        //         }

        //     });

        //     if(!_match) {
        //         // update
        //             _for_update.push({
        //             'name'          : v.name ,
        //             'attachment'    : v.img_exist ,
        //             'validity'      : v.validity ,
        //             'action'        : 'new'
        //         });

        //     }

        // });

        $.each(supp_genreq, function(k,v) {

            let _match = false;

            $.each(js_supplier_genreq, function(k1, v1) {

                let _dat = null;
                if( v.validity != null ) {
                    _dat = new Date(v1.validity);
                    _dat = _dat.getMonth() +'/'+ _dat.getDate() +'/'+ _dat.getFullYear();
                }

                if( v.name == v1.name ){ 
                    _match = true;                    
                    if ( v.attachment != v1.img_exist || _dat != v.validity ) {

                        // update
                        _for_update.push({
                            'name'          : v1.name ,
                            'attachment'    : v1.img_exist ,
                            'validity'      : v1.validity ,
                            'action'        : 'update'
                        });

                    }
                }

            });    

            if(!_match) {
                // update
                    _for_update.push({
                    'name'          : v.name ,
                    'attachment'    : v.img_exist ,
                    'validity'      : v.validity ,
                    'action'        : 'new'
                });

            }        

        });

        _sections.general_requirements = _for_update;

    }

    $(document).on('change', '.sis_attachment', function(evt){
        if(!validate_files(evt, upload_image)) {
            $(this).val('');
        }
    });

    function validate_files(evt, callback) {
        
        errorMessages = '';
        counterOnLoad = 0;

        let files = evt.target.files;
        let maxFileSize = 4;

        for(let i = 0; i < files.length; i++) {

            let file = files[i];
            let fileType = file.type;
            let image_size = file.size/1024/1024; // 4MB
            let validTypes = ['image/jpg','image/jpeg','image/png','application/pdf'];
            
            if (validTypes.length > 0 && $.inArray(fileType, validTypes) < 0) {
                
                errorMessages += file.name + ' invalid file type.';
                alert(errorMessages);

                return false;
            }

            if (image_size > maxFileSize) {

                errorMessages += file.name + ' exceeded the maximum file size.';
                alert(errorMessages);

                return false;
            }

            counterOnLoad = 1;
            callback(file, evt);
            
        }

        return true;

    }

    function upload_image(file, evt) {

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

</script>