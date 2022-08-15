
// var js_supplier_officers = "";
// var js_supplier_banks  = "";
// var js_supplier_services = "";
// var js_supplier_ac = "";
// var js_supplier_genreq = "";
// var js_supplier_cqualities = "";
// var js_supplier_cenveronmentals = "";
// var js_supplier_csafety = "";
// var js_supplier_cothers = "";
// var js_supplier_controllered_comms = "";
// var js_supplier_mc = "";
// var js_supplier_lty = "";
// var js_supplier_fs = "";
// var uploads = "{!! old('uploads') !!}";
// var isValid = true;

jQuery(document).ready( function($){

    // Multiple Select
    $("#commodities").select2({
        placeholder: "Choose" ,
    });
    
    // if(uploads != "" && uploads == 'Upload URL') {
    //     ShowHideDiv2();
    // } else {
    //     ShowHideDiv2();
    // }

    // $('#btn-reg').click(function(e) {

    //     e.preventDefault();

    //     if(!isValid) {
    //         alert("The file you are trying to upload exceeds the maximum size limit");
    //         return false;
    //     }

    //     $('#reg-form').submit();

    // });

    $(document).on('keyup', '.reg_input', function () {

        let _type = $(this).attr('type');
        let _name = $(this).attr('name');
        let _val = $(this).val();
        let _that = $(this);
        let _is_inputed = false;

        if( _val.trim() == '' ) {
            $(_that).addClass('is-invalid');                    
        } else {
        
            $(_that).removeClass('is-invalid');

            if( _type == 'email' ) {                            

                $('.email_ads').each(function(key, val){

                    if(_name != $(this).attr('name')) {

                        if( _val.trim() == $(this).val().trim() ) {

                            _html  = '<span class="invalid-feedback" role="alert" style="display: block;">';
                            _html += '<strong>The email is already taken.</strong></span>';
                            _is_inputed = true;
                            input_valid = false;
                            $(_that).addClass('is-invalid');  
                            if(!$(_that).siblings("span").hasClass('invalid-feedback')) 
                                $(_that).parent().append(_html);  

                        } else {
                            input_valid = true;
                        }

                    }

                });

                if(!_is_inputed) {
                    input_valid = true;
                    checkEmailExist(_val, _that);
                }

            } 

            if( _name == 'company_name' ) {
                checkVendorExist(_val);
            }
        
        }

        if(_type == 'email' && !_is_inputed) {
            if($(_that).siblings("span").hasClass('invalid-feedback')) {
                $(_that).siblings("span").remove();   
                $(_that).removeClass('is-invalid');  
            }
        }

    });




    // $('#email_field').focusout(function () {

    //     let _name = $(this).attr('name');
    //     let _email = $(this).val();

    //     if( _name == 'email' ) {
    //         checkEmailExist(_email);
    //     }

    // });


    $('#reg-form').submit(function (evt) {
        let recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            evt.preventDefault();
            $('#catpchaError').show();
            return false;
        }
        if (!input_valid) {
            evt.preventDefault();
            alert('Please fill in all required fields');
            return false;
        }
    });


    var maxField8 = 5; //Input fields increment limitation
    var addButton8 = $('.add_button8'); //Add button selector
    var wrapper8 = $('.field_wrapper8'); //Input field wrapper
    var x8 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton8).click(function(){
        //Check maximum number of input fields

        
        if(x8 < maxField8){ 
            var fieldHTML8 = '<div class="form-group row">';
                fieldHTML8 += '<label for="text" class="col-sm-4 col-form-label">Contact Person: <span class="field-req">*</span></label>';
                fieldHTML8 += '<div class="col-sm-8">';
                fieldHTML8 += '<input class="form-control reg_input" name="contact_person'+x8+'" type="text">';
                fieldHTML8 += '</div></div>';
                fieldHTML8 += '<div class="form-group row">';
                fieldHTML8 += '<label for="text" class="col-sm-4 col-form-label">Designation: <span class="field-req">*</span></label>';
                fieldHTML8 += '<div class="col-sm-8">';
                fieldHTML8 += '<input class="form-control reg_input" name="designation'+x8+'" type="text">';
                fieldHTML8 += '</div></div>';
                fieldHTML8 += '<div class="form-group row">';
                fieldHTML8 += '<label for="text" class="col-sm-4 col-form-label">Email Address: <span class="field-req">*</span></label>';
                fieldHTML8 += '<div class="col-sm-8">';
                fieldHTML8 += '<input class="form-control reg_input email_ads" name="email'+x8+'" type="email">';
                fieldHTML8 += '</div></div>';
            x8++; //Increment field counter
            $(wrapper8).append(fieldHTML8); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper8).on('click', '.remove_button8', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x8--; //Decrement field counter
    });

}); 




function fildeValidation() {
    let fi = document.getElementById('input-3');
    
    // Check if any file is selected.
    if (fi.files.length > 0) {
        for (var i = 0; i <= fi.files.length - 1; i++) {     
            var fsize = fi.files.item(i).size;                    
            var file = Math.round((fsize / 1024));
            console.log(file);
            // The size of the file.
            if (file >= 4096) {                        
                isValid = false;
                break;
            }
        }
    }

    if(!isValid) return false;

    isValid = true;
    return;

}
       
