

// Multiple Select
$("#bank_options").select2({
    placeholder: "Select Available Options" ,
});


$(document).on('click', '.remove-logo', function(event) {

    $('#attachment-remove').val($(event.target).siblings('a').text());
    $('#attachment-remove-key').val($(this).data('tdkey'));
    $('#attachment-from').val($(this).data('from'));
    $('#prompt-remove-logo').modal('show');

});

function readLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img_temp').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        $('#image_div').show();
        $('.remove-logo').hide();
    }
}

(function(){

    if($('#org_type').val() == 'sole proprietorship') {
        $('#sec').prop('disabled','disabled');
        $('#sec').prop('checked', false);
        $('#dti').prop('disabled', false);
    } else {
        $('#dti').prop('disabled','disabled');
        $('#dti').prop('checked', false);
        $('#sec').prop('disabled', false);
    }


    if($('#country').val() == 'Philippines') {
        $('#foreign_company_profile').prop('disabled', 'disabled');
        $('#business_registration_documents').prop('disabled', 'disabled');
        $('#foreign_general_information_sheet').prop('disabled', 'disabled');

        $('#sample_sales_invoice').prop('disabled', false);
        $('#sample_official_receipt').prop('disabled', false);
        $('#sample_delivery_receipt').prop('disabled', false);
        $('#sample_collection_receipt').prop('disabled', false);
        $('#sample_charge_invoice').prop('disabled', false);
        $('#ph_company_profile').prop('disabled', false);
        $('#ph_general_information_sheet').prop('disabled', false);

    } else {
        $('#sample_sales_invoice').prop('disabled', 'disabled');
        $('#sample_official_receipt').prop('disabled', 'disabled');
        $('#sample_delivery_receipt').prop('disabled', 'disabled');
        $('#sample_collection_receipt').prop('disabled', 'disabled');
        $('#sample_charge_invoice').prop('disabled', 'disabled');
        $('#ph_company_profile').prop('disabled', 'disabled');
        $('#ph_general_information_sheet').prop('disabled', 'disabled');

        $('#foreign_company_profile').prop('disabled', false);
        $('#business_registration_documents').prop('disabled', false);
        $('#foreign_general_information_sheet').prop('disabled', false);
    }

    $(document).on("focusin",".datepicker", function () {
       $(this).datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            onClose: function () { $(this).valid(); }
        });
    });

})();

jQuery(document).ready( function(){
    
    $('.datepicker').datepicker({
        autoclose: true
    }); 
    
    $('#org_type').change(function() {

        if($('#org_type').val() == 'sole proprietorship') {
            $('#sec').prop('disabled','disabled');
            $('#sec').prop('checked', false);
            $('#dti').prop('disabled', false);
        } else {
            $('#dti').prop('disabled','disabled');
            $('#dti').prop('checked', false);
            $('#sec').prop('disabled', false);
        }

    });

    $('#country').change(function(){
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

    // assign data on multiple fields
    if(js_supplier_officers.length>0) {
        
        $.each(js_supplier_officers, function(key, val){
            if(key == 0){
                $('#officer_name').val(val.name);
                $('#officer_position').val(val.position);
            } else {
                let officer_html  = '<div class="row off_wrap"><div class="col-md-6 form-group"><input type="text" id="officer_name'+key+'" class="form-control off_name" placeholder="Name" name="officer_name'+key+'" value="'+val.name+'">';
                    officer_html += '</div><div class="col-10 col-md-5 form-group">';
                    officer_html += '<input type="text" id="officer_position'+key+'" class="form-control off_pos" placeholder="Position" name="officer_position'+key+'" value="'+val.position+'"></div>';
                    officer_html += '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>';
                $('#officers-field-wrapper').append(officer_html);
            }
            
        });

    }

    if(js_supplier_banks.length>0){

        var wrapper20 = $('.field_wrapper20');

        $.each(js_supplier_banks, function(key, val){

            if(key > 0 ) {

                var fieldHTML20  = '<div class="row bank_wrap"><div class="col-sm-6">';
                    fieldHTML20 += '<label for="bank_option'+key+'"> Payment Option Name: </label>';
                    fieldHTML20 += '<select name="bank_option'+key+'" class="form-control bank_opt" id="bank_option'+key+'">';
                    fieldHTML20 += '</select></div>';
                    fieldHTML20 += '<div class="col-sm-5"><label for="account_name'+key+'"> Account Name: </label>';
                    fieldHTML20 += '<input type="text" id="account_name'+key+'" name="account_name'+key+'" class="form-control bank_name"></div>';
                    fieldHTML20 += '<div class="col-1 p-0"><label for="action'+key+'" class="d-block" style="color:#fff;"> a </label>';
                    fieldHTML20 += '<a href="javascript:void(0);" class="remove_button20 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></div></a></div>';
                    fieldHTML20 += '</div>';
                $(wrapper20).append(fieldHTML20); //Add field html
                $('#bank_option'+key).append($('#bank_option > optgroup').clone());  

                $('#bank_option'+key+' > optgroup').each(function(){
                    $(this).find('option').map(function(){
                        if(this.value == val.bank_name) {
                            $('#bank_option'+key).val(this.value);
                        }
                    });
                });

                $('#account_name'+key).val(val.account_name);

            } else {

                $('#bank_option > optgroup').each(function(){
                    $(this).find('option').map(function(){
                        if(this.value == val.bank_name) {
                            $('#bank_option').val(this.value);
                        }
                    });
                });
                $('#account_name').val(val.account_name);
            }

        });
    }

    if(js_supplier_services.length>0){
        var prev_cat = null;
        var curr_cat = null;
        var ctr      = 0;
        $.each(js_supplier_services, function(key, val) {
            
            let service_cat = val.cat.replaceAll(" ","_").toLowerCase();  
            let service_name = val.name.replaceAll(" ","_").toLowerCase();
            let service_other_name = val.other_name == null ? null : val.other_name.replaceAll(" ", "_").toLowerCase();
            curr_cat = service_cat;

            if( $('#'+service_cat).prop("checked") == true ) {
                $('#'+service_name).prop('checked','checked');
            } else {
                $('#'+service_cat).click();
                $('#'+service_name).prop('checked','checked');                        
            }

            if(service_cat != 'others' && service_name == 'others' && service_other_name != null) {

                if( $('#'+service_cat+'_others').prop("checked") != true ) $('#'+service_cat+"_others").click();



                if(curr_cat == prev_cat && prev_cat != null) {
                    ctr++;
                    if(ctr>1){
                        var html_append  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                            html_append += '<input type="text" value="'+service_other_name.replaceAll("_", " ")+'" class="'+curr_cat+'_otherss form-control"></div>';
                            html_append += '<div class="col-1 p-0 form-group">';
                            html_append += '<a href="javascript:void(0);" class="'+curr_cat+'_remove_button btn btn-danger" title="Remove field">';
                            html_append += '<i class="icon-minus-circle"></i></a></div></div>';

                        $('.'+curr_cat+'_field_wrapper').append(html_append);
                    } else {
                        $('#'+curr_cat+'_otherss_1').val(service_other_name.replaceAll("_", " ")); 
                    }
                

                } else {
                    ctr = 1;
                    $('#'+curr_cat+'_otherss_1').val(service_other_name.replaceAll("_", " ")); 
                }

            } else {
                return;
            }

            if(service_cat == 'others' && service_name == 'others' && service_other_name != null) {

                if( $('#'+service_cat+'-goods').prop("checked") == true ) {
                    $('#'+service_name).prop('checked','checked');
                } else {
                    $('#'+service_cat+'-goods').click();
                    $('#'+service_name).prop('checked','checked');                        
                }

                if(curr_cat == prev_cat) {
                    ctr++;

                    if(ctr>1) {
                        var html_append  = '<div class="row"><div class="col-md-10 col-10 form-group">';
                            html_append += '<input type="text" value="'+service_other_name.replaceAll("_", " ")+'" class="'+curr_cat+'_license_name_otherss form-control"></div>';
                            html_append += '<div class="col-1 p-0 form-group">';
                            html_append += '<a href="javascript:void(0);" class="'+curr_cat+'_remove_button btn btn-danger" title="Remove field">';
                            html_append += '<i class="icon-minus-circle"></i></a></div></div>';

                        $('.'+curr_cat+'_field_wrapper').append(html_append);
                    }
                } else {
                    ctr = 1;
                    $('#'+curr_cat+'_license_name_1').val(service_other_name.replaceAll("_", " "));
                }
            } else {
                return;
            }
            prev_cat = curr_cat;
        });
    }

    if(js_supplier_bli.length>0){
        var bli_ctr = 0;
        $.each(js_supplier_bli, function(key, val) {

            let service_type = val.type.replaceAll(" ","_").toLowerCase();  
            let service_name = val.name.replaceAll(" ","_").toLowerCase();

            if(val.type == 'others') {
                if($('#business_line_others'+':checked').length == 0) $('#business_line_others').click();

                if(bli_ctr == 0) {
                    $('#business_line_others_otherss').val(val.name);
                } else {
                    var bli_fieldHTML  = '<div class="row" style="margin-top:15px;">';
                        bli_fieldHTML += '<div class="col-8">';
                        bli_fieldHTML += '<input type="text" class="business_line_others_othersss form-control" value="'+val.name+'">';
                        bli_fieldHTML += '</div><a href="javascript:void(0);" class="bli_remove_button btn btn-danger" title="Remove field">';
                        bli_fieldHTML += '<i class="icon-minus-circle"></i></a></div>';

                        $('.business_line_others_field_wrapper').append(bli_fieldHTML);
                }
                bli_ctr++;
            } else {
                $('#'+service_name).prop('checked','checked');
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
                var ac_html  = '<div class="row ac_wrap"><div class="col-md-4 form-group">';
                    ac_html += '<input type="text" class="form-control ac_inst" placeholder="Institution" id="ac_institution'+key+'" name="ac_institution'+key+'" value="'+val.institution+'"></div>';
                    ac_html += '<div class="col-md-4 form-group">';
                    ac_html += '<input type="text" class="form-control ac_addr" placeholder="Address" id="ac_address'+key+'" name="ac_address'+key+'" value="'+val.address+'"></div>';
                    ac_html += '<div class="col-10 col-md-3 form-group">';
                    ac_html += '<input type="text" class="form-control ac_tel" placeholder="Telephone" id="ac_telephone'+key+'" name="ac_telephone'+key+'" value="'+val.phone+'"></div>';
                    ac_html += '<div class="col-1 p-0 form-group"><a href="javascript:void(0);" class="remove_button2 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                
                $('.field_wrapper2').append(ac_html); //Add field html
            }
        });
    } else {
        $('#chkNo').click();
    }

    if(js_supplier_cqualities.length>0) {
        $('#qlty-standards').click();
        $.each(js_supplier_cqualities, function(key, val){

            if(key == 0){
                $('#quality_cert_number').val(val.certification_number);
                $('#quality_cert_validity').val(moment(val.certification_validity).format("MM/DD/YYYY"));
                $('#quality_cert_body').val(val.certification_body);
            } else {
                var qs_fieldHTML  = '<div class="row quality_certs" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    qs_fieldHTML += '<input type="text" id="quality_cert_number'+key+'" class="form-control qcc_number" value="'+val.certification_number+'"></div>';
                    qs_fieldHTML += '<div class="col-4">';
                    qs_fieldHTML += '<input type="text" class="form-control datepicker qcc_date" id="quality_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+moment(val.certification_validity).format("MM/DD/YYYY")+'"></div>';
                    qs_fieldHTML += '<div class="col-3">';
                    qs_fieldHTML += '<input type="text" id="quality_cert_body'+key+'" class="form-control qcc_body" value="'+val.certification_body+'"></div>';                
                    qs_fieldHTML += '<a href="javascript:void(0);" class="qs_remove_button btn btn-danger" title="Remove field">';
                    qs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
               
                $('.qs_field_wrapper').append(qs_fieldHTML); //Add field html
            }

        });

    }

    if(js_supplier_cenveronmentals.length>0) {
        $('#nvrment-stdrds').click();
        $.each(js_supplier_cenveronmentals, function(key, val){
            
            if(key == 0){
                $('#environmental_cert_number').val(val.certification_number);
                $('#environmental_cert_validity').val(moment(val.certification_validity).format("MM/DD/YYYY"));
                $('#environmental_cert_body').val(val.certification_body);
            } else {
                var es_fieldHTML  = '<div class="row environmental_certs" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    es_fieldHTML += '<input type="text" id="environmental_cert_number'+key+'" class="form-control ec_number" value="'+val.certification_number+'"></div>';
                    es_fieldHTML += '<div class="col-4">';
                    es_fieldHTML += '<input type="text" class="form-control datepicker ec_date" id="environmental_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+moment(val.certification_validity).format("MM/DD/YYYY")+'"></div>';
                    es_fieldHTML += '<div class="col-3">';
                    es_fieldHTML += '<input type="text" id="environmental_cert_body'+key+'" class="form-control ec_body" value="'+val.certification_body+'"></div>';                
                    es_fieldHTML += '<a href="javascript:void(0);" class="es_remove_button btn btn-danger" title="Remove field">';
                    es_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>' //New input field html 
               
                $('.es_field_wrapper').append(es_fieldHTML); //Add field html
            }



        });

    }

    if(js_supplier_csafety.length>0) {
        $('#sfty-chck').click();
        $.each(js_supplier_csafety, function(key, val){
            
            if(key == 0){
                $('#safety_cert_number').val(val.certification_number);
                $('#safety_cert_validity').val(moment(val.certification_validity).format("MM/DD/YYYY"));
                $('#safety_cert_body').val(val.certification_body);
            } else {
                var ocs_fieldHTML  = '<div class="row safety_certs" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    ocs_fieldHTML += '<input type="text" id="safety_cert_number'+key+'" class="form-control sc_number" value="'+val.certification_number+'"></div>';
                    ocs_fieldHTML += '<div class="col-4">';
                    ocs_fieldHTML += '<input type="text" class="form-control datepicker sc_date" id="safety_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+moment(val.certification_validity).format("MM/DD/YYYY")+'"></div>';
                    ocs_fieldHTML += '<div class="col-3">';
                    ocs_fieldHTML += '<input type="text" id="safety_cert_body'+key+'" class="form-control sc_body" value="'+val.certification_body+'"></div>';                
                    ocs_fieldHTML += '<a href="javascript:void(0);" class="scs_remove_button btn btn-danger" title="Remove field">';
                    ocs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
               
                $('.scs_field_wrapper').append(ocs_fieldHTML); //Add field html
            }

            

        });

    }

    if(js_supplier_cothers.length>0) {
        $('#other-cert').click();
        $.each(js_supplier_cothers, function(key, val){
            
            if(key == 0){
                $('#others_cert_number').val(val.certification_number);
                $('#others_cert_validity').val(moment(val.certification_validity).format("MM/DD/YYYY"));
                $('#others_cert_body').val(val.certification_body);
            } else {
                var ocs_fieldHTML  = '<div class="row ocs_certs" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    ocs_fieldHTML += '<input type="text" id="others_cert_number'+key+'" class="form-control oc_number" value="'+val.certification_number+'"></div>';
                    ocs_fieldHTML += '<div class="col-4">';
                    ocs_fieldHTML += '<input type="text" class="form-control datepicker oc_date" id="others_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+moment(val.certification_validity).format("MM/DD/YYYY")+'"></div>';
                    ocs_fieldHTML += '<div class="col-3">';
                    ocs_fieldHTML += '<input type="text" id="others_cert_body'+key+'" class="form-control oc_body" value="'+val.certification_body+'"></div>';                
                    ocs_fieldHTML += '<a href="javascript:void(0);" class="ocs_remove_button btn btn-danger" title="Remove field">';
                    ocs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
               
                $('.ocs_field_wrapper').append(ocs_fieldHTML); //Add field html
            }

            

        });

    }

    if(js_supplier_controllered_comms.length>0){
        $.each(js_supplier_controllered_comms, function(key, val){
            
            let controlled_comm = val.name.replaceAll(" ", "_").toLowerCase();   

            if( val.attachment != null && val.attachment != '' && val.attachment != 'null' ) {
                $('#'+controlled_comm+"_attachment_holder").empty();
                _attachment_name = val.attachment.split('/').reverse();

                var html  = '<label for="'+controlled_comm+'_validity">Attachment'; 
                    html += '<span class="field-req1">*</span></label>';
                    html += '<p><a href="'+storage_url+val.attachment+'" target="_blank" id="'+controlled_comm+'_img_exist">'+_attachment_name[0]+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    html += '<a href="javascript:void(0);" class="remove-logo" data-tdkey="'+controlled_comm+'" data-from="controlled comm">x</a></p>';

                $('#'+controlled_comm+"_attachment_holder").append(html);
            }

            switch(controlled_comm) {
                case 'ecc_certificates':
                    $('#utilitys').click();
                    break;
                case 'pdea_permits':
                    $('#cons-works').click();
                    break;
                case 'import_permit':
                    $('#fabric').click();
                    break;
                case 'consultancy_and_firms':
                    $('#cons-firms').click();
                    break;
                case 'pnp_permits':
                    $('#rprs-serv').click();
                    break;
                case 'bfad_registration_or_fda':
                    $('#other-timb').click();
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
                $('#cpc_email').val(val.email);
            } else if( key < 5 ) {
                $('#cpc_institution'+key).val(val.name);
                $('#cpc_address'+key).val(val.address);
                $('#cpc_telephone'+key).val(val.phone);
                $('#cpc_email'+key).val(val.email);
            } else {
                var mc_html  = '<div class="row mc_wrap"><div class="col-md-3 form-group">';
                    mc_html += '<input type="text" class="form-control mc_institution" placeholder="Institution" id="cpc_institution'+key+'" name="cpc_institution'+key+'" value="'+val.name+'"></div>';
                    mc_html += '<div class="col-md-3 form-group"><input type="text" class="form-control mc_address" placeholder="Address" id="cpc_address'+key+'" name="cpc_address'+key+'" value="'+val.address+'"></div>';
                    mc_html += '<div class="col-10 col-md-3 form-group"><input type="text" class="form-control mc_number" placeholder="Contact Number" id="cpc_telephone'+key+'" name="cpc_telephone'+key+'" value="'+val.phone+'">';
                    mc_html += '</div>';
                    mc_html += '<div class="col-10 col-md-2 form-group"><input type="email" class="form-control mc_email" placeholder="Email Address" id="cpc_email'+key+'" name="cpc_email'+key+'" value="'+val.email+'">';
                    mc_html += '</div>';
                    mc_html += '<div class="col-1 p-0 form-group">';
                    mc_html += '<a href="javascript:void(0);" class="remove_button7 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
                
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
                $('#clty_email').val(val.email);
            } else if( key < 5 ) {
                $('#clty_institution'+key).val(val.name);
                $('#clty_address'+key).val(val.address);
                $('#clty_telephone'+key).val(val.phone);
                $('#clty_email'+key).val(val.email);
            } else {
                var lty_html  = '<div class="row clty_wrap"><div class="col-md-3 form-group">';
                    lty_html += '<input type="text" class="form-control clty_inst" placeholder="Institution" id="clty_institution'+key+'" name="clty_institution'+key+'" value="'+val.name+'"></div>';
                    lty_html += '<div class="col-md-3 form-group"><input type="text" class="form-control clty_addr" placeholder="Address" id="clty_address'+key+'" name="clty_address'+key+'" value="'+val.address+'"></div>';
                    lty_html += '<div class="col-md-3 form-group"><input type="text" class="form-control clty_cnum" placeholder="Contact Number" id="clty_telephone'+key+'" name="clty_telephone'+key+'" value="'+val.phone+'"></div>';
                    lty_html += '<div class="col-md-2 form-group"><input type="email" class="form-control clty_eaddr" placeholder="Email Address" id="clty_email'+key+'" name="clty_email'+key+'" value="'+val.email+'">';
                    lty_html += '</div><div class="col-1 p-0 form-group"><a href="javascript:void(0);" class="remove_button8 btn btn-danger" title="Remove field">';
                    lty_html += '<i class="icon-minus-circle"></i></a></div></div>';
                    $('.field_wrapper8').append(lty_html); //Add field html 
            }

        });

    }

    if( js_supplier_fs.length>0) {
        $.each(js_supplier_fs, function(key, val){

            let _req = val.name.replaceAll(" ","_").toLowerCase();
            $('#'+_req).click();

            if( val.attachment != null && val.attachment != '' && val.attachment != 'null' ) {
                $('#'+_req+"_attachment_holder").empty();
                _attachment_name = val.attachment.split('/').reverse();

                var html  = '<label for="'+_req+'_validity" style="display: block;">Attachment'; 
                    html += '<span class="field-req1">*</span></label>';
                    html += '<p><a href="'+storage_url+val.attachment+'" target="_blank" id="'+_req+'_img_exist">'+_attachment_name[0]+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    html += '<a href="javascript:void(0);" class="remove-logo" data-tdkey="'+_req+'" data-from="financial status">x</a></p>';

                $('#'+_req+"_attachment_holder").append(html);
            } else {
                console.log('aw null fs');
            }
            
        });
    }

    if( js_supplier_pt.length>0) {
        $.each(js_supplier_pt, function(key, val){

            let _req = val.name.replaceAll(" ","_").toLowerCase();
            $('#'+_req).prop('checked', 'checked');
        });
    }

    if(js_supplier_genreq.length>0) {

        let cntry = js_supplier_genreq.length > 0 ? js_supplier_details.country : 'Philippines';
        
        $.each(js_supplier_genreq, function(key, val){

            let _req = val.name.replaceAll(" ","_").toLowerCase();
            let _attachment_name = null;
            let _data = {
                name : null , 
                attachment: null ,
                validity: null
            };

            if(val.validity != null) {
                var _date = moment(val.validity).format('MM/DD/YYYY');
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

            if(val.name == 'company profile' || val.name == 'sample charge invoice' || val.name == 'general information sheet'){

                if(cntry == 'Philippines'){
                    $('#'+_req).prop('checked','checked');
                    $('#'+_req+"_wrap").css('display', 'block');
                } else {
                    $('#'+_req).prop('checked', 'checked');
                    $('#'+_req+"_wrap").css('display', 'block');
                }

            } else {
                $('#'+_req).prop('checked', 'checked');
                $('#'+_req+"_wrap").css('display', 'block');
            }

            gen_req[_req] = _data;

        });

    }

    // $('.form-genreq').click(function() {

    //     if(this.checked) {

    //         let _req_n = val.value.replaceAll(" ", "_").toLowerCase();

    //         $('#'+_req_n+"_attachment").attr('required', true);


    //     } else {

    //         let _req_n = val.value.replaceAll(" ", "_").toLowerCase();

    //         $('#'+_req_n+"_attachment").attr('required', false);

    //     }

    // });

    $(document).on('click', '#supplier_form_btn' , function(e){

        e.preventDefault();

        if(!isValid) {
            alert("The file you are trying to upload exceeds the maximum size limit");
            return false;
        }

        let supp_officers = [];
        let supp_bank_d = [];
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
        let supp_pt = [];
        let supp_bli = [];
        let supp_cles = [];
        let supp_certss = [];
        let attachment_added = true;
        let validity_added = true;
        let has_invalid_date = false;


        $('.bli').each(function(key, val){
            let bli_name = $(this).val().replaceAll(' ', '_').toLowerCase();

            if(this.checked) {
                if( val.value == 'others') {
                    $('.business_line_others_othersss').each(function(k,v) {
                        supp_bli.push({
                            type: 'others' ,
                            name: v.value
                        });
                    });
                } else {
                    supp_bli.push({
                        type: val.value ,
                        name: val.value 
                    });
                }
            }                 
        });

        // check all supplier officers inputed
        $('.off_wrap').each(function(i, officer){
            if(i == 0 ){
                supp_officers.push({
                    name     : $("#officer_name").val() ,
                    position : $("#officer_position").val()
                });
            } else {
                supp_officers.push({
                    name     : $(this).children().children('.off_name').val()  ,
                    position : $(this).children().children('.off_pos').val() 
                });
            }
        });

        // check all supplier bank details
        $('.bank_wrap').each(function(i, officer){
            if(i == 0 ){
                supp_bank_d.push({
                    name     : $("#bank_option").val() ,
                    account  : $("#account_name").val()
                });
            } else {
                supp_bank_d.push({
                    name     : $(this).children().children('.bank_opt').val() ,
                    account  : $(this).children().children('.bank_name').val() 
                });
            }
        });

        // check all access credits 
        $('.ac_wrap').each(function(i, bankDetails){
            if(i == 0 ){
                supp_ac.push({
                    institution     : $("#ac_institution").val() ,
                    address         : $("#ac_address").val() ,
                    phone           : $('#ac_telephone').val()
                });
            } else {
                supp_ac.push({
                    institution     : $(this).children().children('.ac_inst').val()  ,
                    address         : $(this).children().children('.ac_addr').val()  ,
                    phone           : $(this).children().children('.ac_tel').val() 
                });
            }
        });

        // check all quality standards
        if($('#qlty-standards:checked').length>0) {
            $('.quality_certs').each(function(i, bankDetails){
                if(i == 0 ){
                    if($('#quality_cert_number').val() != ''){

                        if( moment($('#quality_cert_validity').val()).isValid() == false ) {
                            $('body, html').animate({
                                scrollTop: $('#qlty-standards').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;
                        } else {
                            supp_qualities.push({
                                'cert_no' : $('#quality_cert_number').val() ,
                                'validity': $('#quality_cert_validity').val() ,
                                'body'    : $("#quality_cert_body").val()
                            });
                        }
                    }
                } else {
                    if($(this).children().children('.qcc_number').val() != ''){
                        if( moment($(this).children().children('.qcc_date').val()).isValid() == false ) {
                            $('body, html').animate({
                                scrollTop: $('#qlty-standards').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;
                        } else {
                            supp_qualities.push({
                                'cert_no' : $(this).children().children('.qcc_number').val() ,    //$('#quality_cert_number'+$(this).data('count')).val() ,
                                'validity': $(this).children().children('.qcc_date').val() ,
                                'body'    : $(this).children().children('.qcc_body').val()
                            });
                        }
                    }
                }
            });
        }

        // // check all environment standards
        if($('#nvrment-stdrds:checked').length>0){
            $('.environmental_certs').each(function(i, bankDetails){
                if(i == 0 ){
                    if($('#environmental_cert_number').val() != ''){

                        if( moment($('#environmental_cert_validity').val()).isValid() == false ) {
                            $('body, html').animate({
                                scrollTop: $('#nvrment-stdrds').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;
                        } else {
                            supp_environmental.push({
                                'cert_no' : $('#environmental_cert_number').val() ,
                                'validity': $('#environmental_cert_validity').val() ,
                                'body'    : $("#environmental_cert_body").val()
                            });
                        }

                    }
                } else {
                    if($(this).children().children('.ec_number').val() != ''){

                        if( moment($(this).children().children('.ec_date').val()).isValid() == false ) {
                            $('body, html').animate({
                                scrollTop: $('#nvrment-stdrds').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;
                        } else {
                            supp_environmental.push({
                                'cert_no' : $(this).children().children('.ec_number').val() ,
                                'validity': $(this).children().children('.ec_date').val() ,
                                'body'    : $(this).children().children('.ec_body').val()
                            });
                        }
                    }
                }
            });
        }

        // // check all safety standards
        if($('#sfty-chck:checked').length>0){
            $('.safety_certs').each(function(i, bankDetails){
                if(i == 0 ){
                    if($('#safety_cert_number').val() != ''){

                        if( moment($('#safety_cert_validity').val()).isValid() == false ) {

                            $('body, html').animate({
                                scrollTop: $('#sfty-chck').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;

                        } else {
                            supp_safety.push({
                                'cert_no' : $('#safety_cert_number').val() ,
                                'validity': $('#safety_cert_validity').val() ,
                                'body'    : $("#safety_cert_body").val()
                            });
                        }
                    }
                } else {
                    if($(this).children().children('.sc_number').val() != ''){

                        if( moment($(this).children().children('.sc_date').val()).isValid() == false ) {
                            $('body, html').animate({
                                scrollTop: $('#sfty-chck').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;
                        } else {
                            supp_safety.push({
                                'cert_no' : $(this).children().children('.sc_number').val() ,
                                'validity': $(this).children().children('.sc_date').val() ,
                                'body'    : $(this).children().children('.sc_body').val()
                            });
                        }
                    }
                }
            });
        }

        // // check all other standards
        if($('#other-cert:checked').length>0){
            $('.ocs_certs').each(function(i, bankDetails){
                if(i == 0 ){
                    if($('#others_cert_number').val() != '' ){

                        if( moment($('#others_cert_validity').val()).isValid() == false ) {

                            $('body, html').animate({
                                scrollTop: $('#other-cert').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;

                        } else {

                            supp_others.push({
                                'cert_no' : $('#others_cert_number').val() ,
                                'validity': $('#others_cert_validity').val() ,
                                'body'    : $("#others_cert_body").val()
                            });

                        }
                    }
                } else {
                    if($(this).children().children('.oc_number').val() != ''){

                        if( moment($(this).children().children('.oc_date').val()).isValid() == false ) {

                            $('body, html').animate({
                                scrollTop: $('#other-cert').offset().top - 250
                            }, 600);

                            alert('validity date is invalid');

                            has_invalid_date = true;

                            return false;

                        } else {    
                            supp_others.push({
                                'cert_no' : $(this).children().children('.oc_number').val() ,
                                'validity': $(this).children().children('.oc_date').val() ,
                                'body'    : $(this).children().children('.oc_body').val()
                            });                    
                        }
                    }
                }
            });
        }

        if(has_invalid_date) return false;

        // $('.cerrts').each(function(k,v){

        //     if(this.checked) {
        //         let cert_name = this.value;

        //         supp_certss.push({
        //             'name'          : cert_name ,
        //             'cert_no'       : $('#'+cert_name+'_cert_number').val() ,
        //             'cert_validity' : $('#'+cert_name+'_cert_validity').val() ,
        //             'cert_body'     : $('#'+cert_name+'_cert_body').val()
        //         });

        //     }

        // });

        // check all current and past customers
        $('.mc_wrap').each(function(i, bankDetails){
            if(i == 0 ){
                supp_mc.push({
                    name     : $("#cpc_institution").val() ,
                    address  : $("#cpc_address").val() ,
                    phone    : $("#cpc_telephone").val() ,
                    email    : $("#cpc_email").val()
                });
            } else {
                supp_mc.push({
                    name     : $(this).children().children('.mc_institution').val() ,
                    address  : $(this).children().children('.mc_address').val() ,
                    phone    : $(this).children().children('.mc_number').val() ,
                    email    : $(this).children().children('.mc_email').val()
                });
            }
        });


        // check all current and past customers
        $('.clty_wrap').each(function(i, bankDetails){
            if(i == 0 ){
                supp_clty.push({
                    name     : $("#clty_institution").val() ,
                    address  : $("#clty_address").val() , 
                    phone    : $("#clty_telephone").val() , 
                    email    : $("#clty_email").val()
                });
            } else {
                supp_clty.push({
                    name     : $(this).children().children('.clty_inst').val() ,
                    address  : $(this).children().children('.clty_addr').val() , 
                    phone    : $(this).children().children('.clty_cnum').val() , 
                    email    : $(this).children().children('.clty_eaddr').val()
                });
            }
        });

        // $('.ga_services').each(function(key, val){
        //     let service_name = $(this).val().replaceAll(' ', '_').toLowerCase();
        //     if(this.checked) {
        //         let _that = this;
        //         $('.'+service_name+'_selectable').each(function(){

        //             supp_services.push({
        //                 cat: $(_that).val() ,
        //                 name: $(this).val() == 'others' ? $('#'+$(this).val()+"_license_name").val() : $(this).val()
        //             });

        //         });
        //     }                 
        // });

        $('.form-genreq').each(function(key, val){
            if(this.checked) {
                let _req_n = val.value.replaceAll(" ", "_").toLowerCase();

                if($('#country').val() == 'Philippines' || $('#country').val() == 'PH'){
                    
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

        if(!attachment_added || !validity_added) return false;

        $('.form-controlled').each(function(key, val){

            if(this.checked) {

                var _name = $(this).val().replaceAll(" ", "_").toLowerCase();

                if( $('#'+_name+"_attachment").val() == '' ) {

                    $('body, html').animate({
                        scrollTop: $('#'+_name+"_attachment").offset().top - 250
                    }, 600);

                    attachment_added = false;

                    alert(val.value + " attachment is required");

                    return false;

                } else {
                    attachment_added = true;
                }

                supp_controlled_comms.push({
                    'cat' : $(this).val() ,
                    'name'  : $(this).val() == 'others' ? $('#other_cert_others').val() : $(this).val() ,
                    'img_exist' : $('#'+_name+'_img_exist').length > 0 ? $('#'+_name+'_img_exist').text() : null
                });

            }

        });

        if(!attachment_added) return false;

        $('.form-fs').each(function(key, val){
            if(this.checked) {
                
                let _req_n = val.value.replaceAll(" ", "_").toLowerCase();

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

                supp_fs.push({
                    'name'  : $(this).val() ,
                    'img_exist': $('#'+_req_n+'_img_exist').length > 0 ? $('#'+_req_n+'_img_exist').text() : null
                });

            }
        });

        if(!attachment_added) return false;

        $('.form-pt').each(function(key, val){
            if(this.checked) {

                supp_pt.push({
                    'name'  : $(this).val()
                });

            }
        });

        $('.ga_services').each(function(key, val){
            var _that = this;
            if(_that.checked) {

                if(_that.value == 'others') {
                    $('.others_license_name_otherss').each(function(i, v){
                        
                        if(v.value != 'others') {
                            supp_cles.push({
                                'other_name'    : v.value,
                                'cat'           : 'others' ,
                                'name'          : 'others'
                            });
                        }

                    });
                } else {

                    let service_name = _that.value.replaceAll(' ', '_').toLowerCase();

                    $('.'+service_name+'_selectable').each(function(k, v) {

                        let service_name_sub = v.value.replaceAll(' ', '_').toLowerCase();

                        if(v.checked ) {                        
                            if( v.value == 'others' ) { 

                                $('.'+service_name+'_otherss').each(function(i, j){

                                    if(j.value != 'others') {
                                        supp_cles.push({
                                            'other_name'    : j.value,
                                            'cat'           : _that.value ,
                                            'name'          : 'others'
                                        });
                                    }

                                });

                            } else {

                                supp_cles.push({
                                    'other_name'    : '',
                                    'cat'           : _that.value ,
                                    'name'          : v.value
                                });

                            }

                        } 

                    });

                }
            }

        });


        // set data to input type hidden
        $('#h_officers').val(JSON.stringify(supp_officers));
        $('#h_bank_details').val(JSON.stringify(supp_bank_d));
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
        $('#h_bli').val(JSON.stringify(supp_bli));
        $('#h_pt').val(JSON.stringify(supp_pt));
        $('#h_cles').val(JSON.stringify(supp_cles));
        $('#h_certss').val(JSON.stringify(supp_certss));

        $('#supplier_form').submit();
    });    
    
    $(document).on('change', '.sis_attachment', function(evt){
        if(!validate_files(evt, upload_image)) {
            $(this).val('');
        }
    });

    $(document).on('change', '.fs_toggles', function(evt){
        if(!validate_files(evt, upload_image)) {
            $(this).val('');
        }
    });

    $(document).on('change', '.controlled_commss', function(evt){
        if(!validate_files(evt, upload_image)) {
            $(this).val('');
        }
    });

    $('#input-3').change(function(evt) {
        if(!validate_files(evt, upload_image)) {
            $('#input-3').val('');
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
})

