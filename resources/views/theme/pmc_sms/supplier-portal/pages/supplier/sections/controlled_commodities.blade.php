<div class="col-12 mt-3">
    <h4 class="bg-secondary text-light p-3">For Timber, Explosives, Chemicals and Other Controlled Commodity Suppliers<br><small>Please check if you have any of the following permits/licenses and clearances:</small></h4>
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

<script type="text/javascript">

    var js_supplier_controllered_comms = {!! $data !!};
    sections.controlled_commodities = js_supplier_controllered_comms;
    _sections.controlled_commodities = {};

    function cert_cce() {
        var checkBoxd4 = document.getElementById("utilitys");
        var textd4 = document.getElementById("ecc_certificates_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function cert_pdea() {
        var checkBoxd4 = document.getElementById("rprs-serv");
        var textd4 = document.getElementById("pnp_permits_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function cert_consultancy_and_firms() {
        var checkBoxd4 = document.getElementById("cons-works");
        var textd4 = document.getElementById("pdea_permits_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function cert_pnp() {
        var checkBoxd4 = document.getElementById("fabric");
        var textd4 = document.getElementById("import_permit_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function cert_import() {
        var checkBoxd4 = document.getElementById("cons-firms");
        var textd4 = document.getElementById("consultancy_and_firms_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
    }

    function cert_bfad() {
        var checkBoxd4 = document.getElementById("other-timb");
        var textd4 = document.getElementById("bfad_registration_or_fda_wrap");
        if (checkBoxd4.checked == true){
            textd4.style.display = "block";
        } else {
            textd4.style.display = "none";
        }  
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

    function getControlledComms() {

        let supp_controlled_comms = [];
        let _for_update = [];

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

        $.each(supp_controlled_comms, function(k,v) {

            let _match = false;

            $.each(js_supplier_controllered_comms, function(k1, v1) {

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
                    'action'        : 'new'
                });

            }

        });

        _sections.controlled_commodities = _for_update;

    }

    $(document).on('change', '.controlled_commss', function(evt){
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