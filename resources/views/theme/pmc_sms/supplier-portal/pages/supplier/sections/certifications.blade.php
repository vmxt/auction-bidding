<div class="col-12">
    <h4 class="bg-secondary text-light p-3">Certifications (Example: ISO 14001: 2015)<br><small>Please check if you have any of the following, specify certification including certifying body and certification number.</small></h4>
    <div class="row">
        <div class="col-md-12 form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input cerrts" type="checkbox" value="quality" id="qlty-standards" name="certs[]" onclick="myFunction()">
                <label class="form-check-label" for="qlty-standards">Quality Standards</label>
            </div>
            <div id="qlty-standards-form" style="display:none">
                <div class="qs_field_wrapper">
                    <div class="row quality_certs" data-action="new" id="f_qcc">
                        <div class="col-4 form-group">
                            <input type="text" id="quality_cert_number" placeholder="Cert No."  class="form-control qcc_number">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" class="form-control datepicker qcc_date" id="quality_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" id="quality_cert_body" placeholder="Cert Body"  class="form-control qcc_body">
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
                    <div class="row safety_certs" data-action="new" id="f_sc">
                        <div class="col-4 form-group">
                            <input type="text" id="safety_cert_number" placeholder="Cert No."  class="form-control sc_number">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" class="form-control datepicker sc_date" id="safety_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" id="safety_cert_body" placeholder="Cert Body"  class="form-control sc_body">
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
                    <div class="row environmental_certs" data-action="new" id="f_ec">
                        <div class="col-4 form-group">
                            <input type="text" id="environmental_cert_number" placeholder="Cert No."  class="form-control ec_number">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" class="form-control datepicker ec_date" id="environmental_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" id="environmental_cert_body" placeholder="Cert Body"  class="form-control ec_body">
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
                    <div class="row ocs_certs" data-action="new" id="f_oc">
                        <div class="col-4 form-group">
                            <input type="text" id="others_cert_number" placeholder="Cert No."  class="form-control oc_number">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" class="form-control datepicker oc_date" id="others_cert_validity" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y">
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" id="others_cert_body" placeholder="Cert Body"  class="form-control oc_body">
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0);" class="ocs_add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    
    function myFunction() {
            
        var checkBox1 = document.getElementById("qlty-standards");
        var text1 = document.getElementById("qlty-standards-form");
        if (checkBox1.checked == true){
            text1.style.display = "block";
        } else {
            text1.style.display = "none";
        }

        // E. Certifications (Example: ISO 14001: 2015) - Safety Checks/Standards form
        var checkBox2 = document.getElementById("sfty-chck");
        var text2 = document.getElementById("sfty-chck-form");
        if (checkBox2.checked == true){
            text2.style.display = "block";
        } else {
            text2.style.display = "none";
        }

        // E. Certifications (Example: ISO 14001: 2015) - Environmental Standards form
        var checkBox3 = document.getElementById("nvrment-stdrds");
        var text3 = document.getElementById("nvrment-stdrds-form");
        if (checkBox3.checked == true){
            text3.style.display = "block";
        } else {
            text3.style.display = "none";
        }

        // E. Certifications (Example: ISO 14001: 2015) - Other certifications, please specify: form
        var checkBox4 = document.getElementById("other-cert");
        var text4 = document.getElementById("other-cert-form");
        if (checkBox4.checked == true){
            text4.style.display = "block";
        } else {
            text4.style.display = "none";
        }

        $('.datepicker').datepicker({
            autoclose: true
        }); 
    
    };

    var js_supplier_cqualities                  = {!! $supplier_cqualities !!};
    var js_supplier_cenveronmentals             = {!! $supplier_csafety !!};
    var js_supplier_csafety                     = {!! $supplier_cenveronmentals !!};
    var js_supplier_cothers                     = {!! $supplier_cothers !!};
    sections.certifications                     = {};
    sections.certifications.quality             = js_supplier_cqualities;
    sections.certifications.environmental       = js_supplier_cenveronmentals;
    sections.certifications.safety              = js_supplier_csafety;
    sections.certifications.others              = js_supplier_cothers;
    _sections.certifications                    = {};

    var qs_maxField = 10; //Input fields increment limitation
    var qs_addButton = $('.qs_add_button'); //Add button selector
    var qs_wrapper = $('.qs_field_wrapper'); //Input field wrapper

    var qs_x = js_supplier_cqualities.length > 0 ? js_supplier_cqualities.length : 1; //Initial field counter is 1

    //Once add button is clicked
    $(qs_addButton).click(function(){
        //Check maximum number of input fields
        if(qs_x < qs_maxField){ 
            var qs_fieldHTML  = '<div class="row quality_certs" data-action="new" data-count="'+qs_x+'" style="margin-bottom: 15px;"><div class="col-4">';
                qs_fieldHTML += '<input type="text" id="quality_cert_number'+qs_x+'" placeholder="Cert No." class="form-control qcc_number"></div>';
                qs_fieldHTML += '<div class="col-4">';
                qs_fieldHTML += '<input type="text" class="form-control datepicker qcc_date" id="quality_cert_validity'+qs_x+'" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y"></div>';
                qs_fieldHTML += '<div class="col-3">';
                qs_fieldHTML += '<input type="text" id="quality_cert_body'+qs_x+'" placeholder="Cert Body"  class="form-control qcc_body"></div>';                
                qs_fieldHTML += '<a href="javascript:void(0);" class="qs_remove_button btn btn-danger" title="Remove field">';
                qs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            qs_x++; //Increment field counter
            $(qs_wrapper).append(qs_fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(qs_wrapper).on('click', '.qs_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        qs_x--; //Decrement field counter
    });

    var scs_maxField = 10; //Input fields increment limitation
    var scs_addButton = $('.scs_add_button'); //Add button selector
    var scs_wrapper = $('.scs_field_wrapper'); //Input field wrapper

    var scs_x = js_supplier_csafety.length > 0 ? js_supplier_csafety.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(scs_addButton).click(function(){
        //Check maximum number of input fields
        if(scs_x < scs_maxField){ 
            var scs_fieldHTML  = '<div class="row safety_certs" data-action="new" data-count="'+scs_x+'" style="margin-bottom: 15px;"><div class="col-4">';
                scs_fieldHTML += '<input type="text" id="safety_cert_number'+scs_x+'" placeholder="Cert No" class="form-control sc_number"></div>';
                scs_fieldHTML += '<div class="col-4">';
                scs_fieldHTML += '<input type="text" class="form-control datepicker sc_date" id="safety_cert_validity'+scs_x+'" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y"></div>';
                scs_fieldHTML += '<div class="col-3">';
                scs_fieldHTML += '<input type="text" id="safety_cert_body'+scs_x+'" placeholder="Cert Body"  class="form-control sc_body"></div>';                
                scs_fieldHTML += '<a href="javascript:void(0);" class="scs_remove_button btn btn-danger" title="Remove field">';
                scs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            scs_x++; //Increment field counter
            $(scs_wrapper).append(scs_fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(scs_wrapper).on('click', '.scs_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        scs_x--; //Decrement field counter
    });

    var es_maxField = 10; //Input fields increment limitation
    var es_addButton = $('.es_add_button'); //Add button selector
    var es_wrapper = $('.es_field_wrapper'); //Input field wrapper

    var es_x = js_supplier_cenveronmentals.length > 0 ? js_supplier_cenveronmentals.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(es_addButton).click(function(){
        //Check maximum number of input fields
        if(es_x < es_maxField){ 
            var es_fieldHTML  = '<div class="row environmental_certs" data-action="new" data-count="'+es_x+'" style="margin-bottom: 15px;"><div class="col-4">';
                es_fieldHTML += '<input type="text" id="environmental_cert_number'+es_x+'" placeholder="Cert No." class="form-control ec_number"></div>';
                es_fieldHTML += '<div class="col-4">';
                es_fieldHTML += '<input type="text" class="form-control datepicker ec_date" id="environmental_cert_validity'+es_x+'" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y"></div>';
                es_fieldHTML += '<div class="col-3">';
                es_fieldHTML += '<input type="text" id="environmental_cert_body'+es_x+'" placeholder="Cert Body"  class="form-control ec_body"></div>';                
                es_fieldHTML += '<a href="javascript:void(0);" class="es_remove_button btn btn-danger" title="Remove field">';
                es_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            es_x++; //Increment field counter
            $(es_wrapper).append(es_fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(es_wrapper).on('click', '.es_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        es_x--; //Decrement field counter
    });

    var ocs_maxField = 10; //Input fields increment limitation
    var ocs_addButton = $('.ocs_add_button'); //Add button selector
    var ocs_wrapper = $('.ocs_field_wrapper'); //Input field wrapper

    var ocs_x = js_supplier_cothers.length > 0 ? js_supplier_cothers.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(ocs_addButton).click(function(){
        //Check maximum number of input fields
        if(ocs_x < ocs_maxField){ 
            var ocs_fieldHTML  = '<div class="row ocs_certs" data-action="new" data-count="'+ocs_x+'" style="margin-bottom: 15px;"><div class="col-4">';
                ocs_fieldHTML += '<input type="text" id="others_cert_number'+ocs_x+'" placeholder="Cert No." class="form-control oc_number"></div>';
                ocs_fieldHTML += '<div class="col-4">';
                ocs_fieldHTML += '<input type="text" class="form-control datepicker oc_date" id="others_cert_validity'+ocs_x+'" placeholder="MM-DD-YYYY" data-date-start-date="-50y" data-date-end-date="+50y"></div>';
                ocs_fieldHTML += '<div class="col-3">';
                ocs_fieldHTML += '<input type="text" id="others_cert_body'+ocs_x+'" placeholder="Cert Body"  class="form-control oc_body"></div>';                
                ocs_fieldHTML += '<a href="javascript:void(0);" class="ocs_remove_button btn btn-danger" title="Remove field">';
                ocs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            ocs_x++; //Increment field counter
            $(ocs_wrapper).append(ocs_fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(ocs_wrapper).on('click', '.ocs_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        ocs_x--; //Decrement field counter
    });

    if(js_supplier_cqualities.length>0) {
        $('#qlty-standards').click();
        $.each(js_supplier_cqualities, function(key, val){
            let __date = new Date(val.certification_validity);
            __date = __date.getMonth() +'/'+ __date.getDate() +'/'+ __date.getFullYear();
            if(key == 0){
                $('#quality_cert_number').val(val.certification_number);
                $('#quality_cert_validity').val(__date);
                $('#quality_cert_body').val(val.certification_body);
                $('#f_qcc').attr('data-action', 'update');
                $('#f_qcc').attr('data-id', val.id);
            } else {
                var qs_fieldHTML  = '<div class="row quality_certs" data-action="update" data-id="'+val.id+'" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    qs_fieldHTML += '<input type="text" id="quality_cert_number'+key+'" class="form-control qcc_number" value="'+val.certification_number+'"></div>';
                    qs_fieldHTML += '<div class="col-4">';
                    qs_fieldHTML += '<input type="text" class="form-control datepicker qcc_date" id="quality_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+__date+'"></div>';
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
            let __date = new Date(val.certification_validity);
            __date = __date.getMonth() +'/'+ __date.getDate() +'/'+ __date.getFullYear();
            if(key == 0){
                $('#environmental_cert_number').val(val.certification_number);
                $('#environmental_cert_validity').val(__date);
                $('#environmental_cert_body').val(val.certification_body);
                $('#f_ec').attr('data-id', val.id);
                $('#f_ec').attr('data-action', "update");
            } else {
                var es_fieldHTML  = '<div class="row environmental_certs" data-action="update" data-id="'+val.id+'" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    es_fieldHTML += '<input type="text" id="environmental_cert_number'+key+'" class="form-control ec_number" value="'+val.certification_number+'"></div>';
                    es_fieldHTML += '<div class="col-4">';
                    es_fieldHTML += '<input type="text" class="form-control datepicker ec_date" id="environmental_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+__date+'"></div>';
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
            let __date = new Date(val.certification_validity);
            __date = __date.getMonth() +'/'+ __date.getDate() +'/'+ __date.getFullYear();
            if(key == 0){
                $('#safety_cert_number').val(val.certification_number);
                $('#safety_cert_validity').val(__date);
                $('#safety_cert_body').val(val.certification_body);
                $('#f_sc').attr('data-id', val.id);
                $('#f_sc').attr('data-action', 'update');
            } else {
                var ocs_fieldHTML  = '<div class="row safety_certs" data-action="update" data-id="'+val.id+'" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
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
            let __date = new Date(val.certification_validity);
            __date = __date.getMonth() +'/'+ __date.getDate() +'/'+ __date.getFullYear();
            if(key == 0){
                $('#others_cert_number').val(val.certification_number);
                $('#others_cert_validity').val(__date);
                $('#others_cert_body').val(val.certification_body);
                $('#f_oc').attr('data-id', val.id);
                $('#f_oc').attr('data-action', 'update');
            } else {
                var ocs_fieldHTML  = '<div class="row ocs_certs" data-action="update" data-id="'+val.id+'" data-count="'+key+'" style="margin-bottom: 15px;"><div class="col-4">';
                    ocs_fieldHTML += '<input type="text" id="others_cert_number'+key+'" class="form-control oc_number" value="'+val.certification_number+'"></div>';
                    ocs_fieldHTML += '<div class="col-4">';
                    ocs_fieldHTML += '<input type="text" class="form-control datepicker oc_date" id="others_cert_validity'+key+'" placeholder="MM/DD/YYYY" data-date-start-date="-50y" data-date-end-date="+50y" value="'+__date+'"></div>';
                    ocs_fieldHTML += '<div class="col-3">';
                    ocs_fieldHTML += '<input type="text" id="others_cert_body'+key+'" class="form-control oc_body" value="'+val.certification_body+'"></div>';                
                    ocs_fieldHTML += '<a href="javascript:void(0);" class="ocs_remove_button btn btn-danger" title="Remove field">';
                    ocs_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
               
                $('.ocs_field_wrapper').append(ocs_fieldHTML); //Add field html
            }

            

        });

    }


    function getCertifications() {

        let _sc     = [];
        let _qcc    = [];
        let _ec     = [];
        let _oc     = [];

        $('.quality_certs').each(function() {

            let _action         = $(this).data('action');
            let _qcc_number     = $(this).children().children('.qcc_number').val();
            let _qcc_date       = $(this).children().children('.qcc_date').val();
            let _qcc_body       = $(this).children().children('.qcc_body').val();
            let _exist          = false;
            let _id             = null;
            let _is_checked     = $(this).parent().parent().siblings().children('.cerrts').prop('checked');

            if( _action == 'update' ) {

                _id = $(this).data('id');

                $.each(js_supplier_cqualities, function(k,v){

                    if( v.id == _id ) {

                        _exist = true;
                        let js_qcc_date = new Date(v.certification_validity);
                        js_qcc_date = js_qcc_date.getMonth() +'/'+ js_qcc_date.getDate() +'/'+ js_qcc_date.getFullYear();
                                        

                        if ( v.certification_number != _qcc_number || js_qcc_date != _qcc_date 
                                || v.certification_body != _qcc_body ) {
                            
                            if(_is_checked) {
                                _qcc.push({
                                    'certification_number'      : _qcc_number ,
                                    'certification_validity'    : _qcc_date ,
                                    'certification_body'        : _qcc_body ,
                                    'action'                    : _action ,
                                    'id'                        : _id
                                });
                            }

                        }

                        return false;

                    }

                });

            } else {

                if(_is_checked) {
                    _qcc.push({
                        'certification_number'      : _qcc_number ,
                        'certification_validity'    : _qcc_date ,
                        'certification_body'        : _qcc_body ,
                        'action'                    : _action ,
                        'id'                        : _id
                    });
                }

            }

        });

        $.each(js_supplier_cqualities, function(key, val) {

            let is_match    = false;
            let _is_checked = true; 
            $('.quality_certs').each( function() {
                _is_checked = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
                if( $(this).data('action') == 'update' ) {
                    if( val.id == $(this).data('id') ) {
                        is_match = true;
                    }
                }

            });

            if( !is_match || !_is_checked ) {
                let _dat = new Date(val.certification_validity);
                _dat = _dat.getMonth() +'/'+ _dat.getDate() +'/'+ _dat.getFullYear();
                _qcc.push({
                    'certification_number'      : val.certification_number ,
                    'certification_validity'    : _dat ,
                    'certification_body'        : val.certification_body ,
                    'action'                    : 'remove' ,
                    'id'                        : val.id
                });

            }

        });

        _sections.certifications.quality = _qcc;


        $('.safety_certs').each(function() {

            let _action         = $(this).data('action');
            let _sc_number      = $(this).children().children('.sc_number').val();
            let _sc_date        = $(this).children().children('.sc_date').val();
            let _sc_body        = $(this).children().children('.sc_body').val();
            let _is_checked     = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
            let _exist  = false;
            let _id     = null;

            if( _action == 'update' ) {

                _id = $(this).data('id');

                $.each(js_supplier_csafety, function(k,v){

                    if( v.id == _id ) {

                        _exist = true;
                        let js_sc_date = new Date(v.certification_validity);
                        js_sc_date = js_sc_date.getMonth() +'/'+ js_sc_date.getDate() +'/'+ js_sc_date.getFullYear();
                                        

                        if ( v.certification_number != _sc_number || js_sc_date != _sc_date 
                                || v.certification_body != _sc_body ) {
                            
                            if(_is_checked) {
                                _sc.push({
                                    'certification_number'      : _sc_number ,
                                    'certification_validity'    : _sc_date ,
                                    'certification_body'        : _sc_body ,
                                    'action'                    : _action ,
                                    'id'                        : _id
                                });
                            }

                        }

                        return false;

                    }

                });

            } else {

                if(_is_checked) {
                    _sc.push({
                        'certification_number'      : _sc_number ,
                        'certification_validity'    : _sc_date ,
                        'certification_body'        : _sc_body ,
                        'action'                    : _action ,
                        'id'                        : _id
                    });
                }

            }

        });

        $.each(js_supplier_csafety, function(key, val) {

            let is_match = false;
            let _is_checked = true;
            $('.safety_certs').each( function() {
                _is_checked     = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
                if( $(this).data('action') == 'update' ) {
                    if( val.id == $(this).data('id') ) {
                        is_match = true;
                    }
                }

            });

            if( !is_match || !_is_checked ) {
                let _dat = new Date(val.certification_validity);
                _dat = _dat.getMonth() +'/'+ _dat.getDate() +'/'+ _dat.getFullYear();
                _sc.push({
                    'certification_number'      : val.certification_number ,
                    'certification_validity'    : _dat ,
                    'certification_body'        : val.certification_body ,
                    'action'                    : 'remove' ,
                    'id'                        : val.id
                });

            }

        });

        _sections.certifications.safety = _sc;

        $('.environmental_certs').each(function() {

            let _action        = $(this).data('action');
            let _ec_number     = $(this).children().children('.ec_number').val();
            let _ec_date       = $(this).children().children('.ec_date').val();
            let _ec_body       = $(this).children().children('.ec_body').val();
            let _is_checked     = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
            let _exist         = false;
            let _id            = null;

            if( _action == 'update' ) {

                _id = $(this).data('id');

                $.each(js_supplier_cenveronmentals, function(k,v){

                    if( v.id == _id ) {

                        _exist = true;
                        let js_ec_date = new Date(v.certification_validity);
                        js_ec_date = js_ec_date.getMonth() +'/'+ js_ec_date.getDate() +'/'+ js_ec_date.getFullYear();
                                        

                        if ( v.certification_number != _ec_number || js_ec_date != _ec_date 
                                || v.certification_body != _ec_body ) {
                            
                            if(_is_checked) {
                                _ec.push({
                                    'certification_number'      : _ec_number ,
                                    'certification_validity'    : _ec_date ,
                                    'certification_body'        : _ec_body ,
                                    'action'                    : _action ,
                                    'id'                        : _id
                                });
                            }

                        }

                        return false;

                    }

                });

            } else {

                if(_is_checked) {
                    _ec.push({
                        'certification_number'      : _ec_number ,
                        'certification_validity'    : _ec_date ,
                        'certification_body'        : _ec_body ,
                        'action'                    : _action ,
                        'id'                        : _id
                    });
                }

            }

        });

        $.each(js_supplier_cenveronmentals, function(key, val) {

            let is_match = false;
            let _is_checked = true;
            $('.environmental_certs').each( function() {
                _is_checked     = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
                if( $(this).data('action') == 'update' ) {
                    if( val.id == $(this).data('id') ) {
                        is_match = true;
                    }
                }

            });

            if( !is_match || !_is_checked ) {
                let _dat = new Date(val.certification_validity);
                _dat = _dat.getMonth() +'/'+ _dat.getDate() +'/'+ _dat.getFullYear();
                _ec.push({
                    'certification_number'      : val.certification_number ,
                    'certification_validity'    : _dat ,
                    'certification_body'        : val.certification_body ,
                    'action'                    : 'remove' ,
                    'id'                        : val.id
                });

            }

        });

        _sections.certifications.environmentals = _ec;

        $('.ocs_certs').each(function() {

            let _action         = $(this).data('action');
            let _oc_number      = $(this).children().children('.oc_number').val();
            let _oc_date        = $(this).children().children('.oc_date').val();
            let _oc_body        = $(this).children().children('.oc_body').val();
            let _is_checked     = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
            let _exist  = false;
            let _id     = null;

            if( _action == 'update' ) {

                _id = $(this).data('id');

                $.each(js_supplier_cothers, function(k,v){

                    if( v.id == _id ) {

                        _exist = true;
                        let js_oc_date = new Date(v.certification_validity);
                        js_oc_date = js_oc_date.getMonth() +'/'+ js_oc_date.getDate() +'/'+ js_oc_date.getFullYear();
                                        

                        if ( v.certification_number != _oc_number || js_oc_date != _oc_date 
                                || v.certification_body != _oc_body ) {
                            
                            if( _is_checked ) {
                                _oc.push({
                                    'certification_number'      : _oc_number ,
                                    'certification_validity'    : _oc_date ,
                                    'certification_body'        : _oc_body ,
                                    'action'                    : _action ,
                                    'id'                        : _id
                                });
                            }

                        }

                        return false;

                    }

                });

            } else {

                if(_is_checked) {
                    _oc.push({
                        'certification_number'      : _oc_number ,
                        'certification_validity'    : _oc_date ,
                        'certification_body'        : _oc_body ,
                        'action'                    : _action ,
                        'id'                        : _id
                    });
                }

            }

        });

        $.each(js_supplier_cothers, function(key, val) {

            let is_match = false;
            let _is_checked = true;
            $('.ocs_certs').each( function() {
                _is_checked = $(this).parent().parent().siblings().children('.cerrts').prop('checked');
                if( $(this).data('action') == 'update' ) {
                    if( val.id == $(this).data('id') ) {
                        is_match = true;
                    }
                }

            });

            if( !is_match || !_is_checked ) {
                let _dat = new Date(val.certification_validity);
                _dat = _dat.getMonth() +'/'+ _dat.getDate() +'/'+ _dat.getFullYear();
                _oc.push({
                    'certification_number'      : val.certification_number ,
                    'certification_validity'    : _dat ,
                    'certification_body'        : val.certification_body ,
                    'action'                    : 'remove' ,
                    'id'                        : val.id
                });

            }

        });

        _sections.certifications.others = _oc;

        
        
    }

</script>




