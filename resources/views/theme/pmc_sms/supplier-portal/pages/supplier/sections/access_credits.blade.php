<div class="col-12">
	
	<h4 class="bg-secondary text-light p-3">Do you have any access to any form of credit? <span class="field-req" style="color: #ffffff;">*</span></h4>
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
            <div class="row ac_wrap" data-action="update" id="f_ac">
                <div class="col-md-4 form-group">
                  <input type="text" class="form-control ac_inst" placeholder="Institution" name="ac_institution" 
                    id="ac_institution" data-field="institution" >
                </div>
                <div class="col-md-4 form-group">
                  <input type="text" class="form-control ac_addr" placeholder="Address" name="ac_address" 
                    id="ac_address" data-field="address">
                </div>
                <div class="col-md-4 form-group">
                  <input type="text" class="form-control ac_tel" placeholder="Telephone" name="ac_telephone"
                    id="ac_telephone" data-field="phone">
                </div>
            </div>
        </div>
        <a href="javascript:void(0);" class="add_button2 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
    </div>

</div>


<script type="text/javascript">
    
    var js_supplier_ac = {!! $data !!};
    sections.access_credits = js_supplier_ac;
    _sections.access_credits = {};

    if(js_supplier_ac.length>0){
        $('#chkYes').click();
        $.each(js_supplier_ac, function(key, val){
            if(key == 0){
                $('#ac_institution').val(val.institution);
                $('#ac_address').val(val.address);
                $('#ac_telephone').val(val.phone);
                $('#f_ac').attr('data-id', val.id);
            }else{
                var ac_html  = '<div class="row ac_wrap" data-field="update" data-id="'+ val.id +'"><div class="col-md-4 form-group">';
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

    function ShowHideDiv() {

        var chkYes = document.getElementById("chkYes");
        var dvtext = document.getElementById("dvtext");
        dvtext.style.display = chkYes.checked ? "block" : "none";

    }

    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper

    var x1 = js_supplier_ac.length > 0 ? js_supplier_ac.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x1 < maxField2){ 
            var fieldHTML2  = '<div class="row ac_wrap" data-action="new"><div class="col-md-4 form-group">';
                fieldHTML2 += '<input type="text" class="form-control ac_inst" placeholder="Institution" id="ac_institution'+x1+'" name="ac_institution'+x1+'"></div>';
                fieldHTML2 += '<div class="col-md-4 form-group">';
                fieldHTML2 += '<input type="text" class="form-control ac_addr" placeholder="Address" id="ac_address'+x1+'" name="ac_address'+x1+'"></div>';
                fieldHTML2 += '<div class="col-10 col-md-3 form-group">';
                fieldHTML2 += '<input type="text" class="form-control ac_tel" placeholder="Telephone" id="ac_telephone'+x1+'" name="ac_telephone'+x1+'"></div>';
                fieldHTML2 += '<div class="col-1 p-0 form-group"><a href="javascript:void(0);" class="remove_button2 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            x1++; //Increment field counter
            $(wrapper2).append(fieldHTML2); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x1--; //Decrement field counter
    });

    function getAccessCredits() {

        var _access_credits = [];

        if($('#chkNo').is(':checked')) return;

        $('.ac_wrap').each(function() {

            let _action         = $(this).data('action');
            let _institution    = $(this).children().children('.ac_inst').val().trim();
            let _phone          = $(this).children().children('.ac_tel').val().trim();
            let _address        = $(this).children().children('.ac_addr').val().trim();
            let _exist          = false;
            let _id             = null;

            // _institution    = _institution.trim() == "" ? null : _institution.trim();
            // _phone          = _phone.trim() == "" ? null : _phone.trim();
            // _address        = _address.trim() == "" ? null : _address.trim();

            if( _action == 'update' ) {

                _id = $(this).data('id');

                $.each(js_supplier_ac, function(k,v){

                    if( v.id == _id ) {

                        _exist = true;

                        if ( v.institution != _institution || v.address != _address  || v.phone != _phone ) {

                            _access_credits.push({
                                'institution'   : _institution ,
                                'address'       : _address ,
                                'phone'         : _phone ,
                                'action'        : _action ,
                                'id'            : _id
                            });

                        }

                        return false;

                    }

                });

            } else {

                _access_credits.push({
                    'institution'   : _institution ,
                    'address'       : _address ,
                    'phone'         : _phone ,
                    'action'        : _action ,
                    'id'            : _id
                });

            }


            $.each(js_supplier_ac, function(key, val) {

                let is_match = false;

                $('.ac_wrap').each( function() {

                    if( $(this).data('action') == 'update' ) {
                        if( val.id == $(this).data('id') ) {
                            is_match = true;
                        }
                    }

                });

                if( !is_match ) {

                    _access_credits.push({
                        'institution'   : val.institution ,
                        'address'       : val.address ,
                        'phone'         : val.phone ,
                        'action'        : _action ,
                        'id'            : _id
                    });

                }
            });


            _sections.access_credits = _access_credits;

        });

    }

</script>