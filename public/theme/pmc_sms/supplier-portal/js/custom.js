// JavaScript Document

// add and remove fields

$(document).ready(function(){
    $('#freelance-quote-project-type').on('change',function(){        
        var x = $(this).val();
        if(x == 'Reject')
            $('#rejectModal').modal('show');
        else if(x == 'Hold')
            $('#holdModal').modal('show');
        else if(x == 'Return to previous Approver')
            $('#returnModal').modal('show');
    })
  $(".table-menus-desk li").hover(function(){
    $(this).children("ul").css("transform","scale(1)");
    $(this).addClass("active");
  }, function(){
    $(this).children("ul").css("transform","scale(0)");
    $(this).removeClass("active");
  });
  
  $(".approvedModalBtn").on("click",function(){
    $(".approvedModalOption").removeClass("active focus");
  });
  
  $(".yesApprovedModalBtn").on("click",function(){
    $("#dvtext").css("display","none");
    $(".field_reason").css("display","none");
  });
  
  $(".disapproveOption").on("click",function(){
    $(".field_reason").css("display","block");
  });
  
  $(".noDisapproveOption").on("click",function(){
    $(".field_reason").css("display","none");
    $(".selectedOption").attr("selected");
  });
  
  
  $('.input-images').imageUploader();
  
  
  $( "#processTabs" ).tabs({ show: { effect: "fade", duration: 400 } });
  $( ".tab-linker" ).click(function() {
    $( "#processTabs" ).tabs("option", "active", $(this).attr('rel') - 1);
    return false;
  });
  
  
  // officers field
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var xx = js_supplier_officers.length > 0 ? js_supplier_officers.length : 1; //Initial field counter is 1
    var wrapper = $('.field_wrapper'); //Input field wrapper
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(xx < maxField){ 
            var fieldHTML = '<div class="row off_wrap"><div class="col-md-6 form-group"><input type="text" id="officer_name'+xx+'" class="form-control off_name" placeholder="Name" name="officer_name'+xx+'">';
                fieldHTML += '</div><div class="col-10 col-md-5 form-group">';
                fieldHTML += '<input type="text" id="officer_position'+xx+'" class="form-control off_pos" placeholder="Position" name="officer_position'+xx+'"></div>';
                fieldHTML += '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>'; 
                //New input field html 
            xx++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        xx--; //Decrement field counter
    });
  
  
  // bank details field
  var maxField1 = 10; //Input fields increment limitation
    var addButton1 = $('.add_button1'); //Add button selector
    var wrapper1 = $('.field_wrapper1'); //Input field wrapper
    var bank_len =  0//js_supplier_bank_d_iban.length;
    // if( js_supplier_bank_d_swift.length > js_supplier_bank_d_iban.length ) {
    //     bank_len = js_supplier_bank_d_swift.length;
    // }

    var x = bank_len > 0 ? bank_len : 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton1).click(function(){
        //Check maximum number of input fields
        if(x < maxField1){ 
        var fieldHTML1 = '<div class="row pb-0"><div class="col-12"><hr></div><div class="col-md-2"><label>Bank Name:</label></div>';
            fieldHTML1+= '<div class="col-md-10 form-group">';
            fieldHTML1+= '<input type="text" name="swift_bank_details_name'+x+'" id="swift_bank_details_name'+x+'" class="form-control required valid">';
            fieldHTML1+= '</div>';
            fieldHTML1+= '<div class="col-md-2"><label>Account Name:</label></div><div class="col-md-10 form-group">';
            fieldHTML1+= '<input type="text" name="swift_bank_details_accnt'+x+'" id="swift_bank_details_accnt'+x+'" class="form-control required valid"></div>';
            fieldHTML1+= '<div class="col-md-2"><label>Swift Code:</label></div><div class="col-md-10 form-group">';
            fieldHTML1+= '<input type="text" name="swift_bank_details_swift'+x+'" id="swift_bank_details_swift'+x+'" class="form-control required valid"></div>';
            fieldHTML1+= '<div class="col-12">&nbsp;</div><div class="col-md-2"><label>Bank Name:</label></div><div class="col-md-10 form-group">';
            fieldHTML1+= '<input type="text" name="iban_bank_details_name'+x+'" id="iban_bank_details_name'+x+'" class="form-control required valid"></div>';
            fieldHTML1+= '<div class="col-md-2"><label>Account Name:</label></div><div class="col-md-10 form-group">';
            fieldHTML1+= '<input type="text" name="iban_bank_details_accnt'+x+'" id="iban_bank_details_accnt'+x+'" class="form-control required valid"></div>';
            fieldHTML1+= '<div class="col-md-2"><label>IBAN Code:</label></div>';
            fieldHTML1+= '<div class="col-9"><input type="text" name="iban_bank_details_iban'+x+'" id="iban_bank_details_iban'+x+'" class="form-control required valid"></div>';
            fieldHTML1+= '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button1 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></div></a></div>'; 
            //New input field html 
            x++; //Increment field counter
            $(wrapper1).append(fieldHTML1); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper1).on('click', '.remove_button1', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    // Bank Details
    var maxField20 = 10; //Input fields increment limitation
    var addButton20 = $('.add_button20'); //Add button selector
    var wrapper20 = $('.field_wrapper20'); //Input field wrapper

    var x20 = js_supplier_banks.length > 0 ? js_supplier_banks.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton20).click(function(){
        //Check maximum number of input fields
        if(x20 < maxField20){ 
            var fieldHTML20  = '<div class="row bank_wrap"><div class="col-sm-6">';
                fieldHTML20 += '<label for="bank_option'+x20+'"> Payment Option Name: </label>';
                fieldHTML20 += '<select name="bank_option'+x20+'" class="form-control bank_opt" id="bank_option'+x20+'">';
                fieldHTML20 += '</select></div>';
                fieldHTML20 += '<div class="col-sm-5"><label for="bank_option'+x20+'"> Account Name: </label>';
                fieldHTML20 += '<input type="text" id="account_name'+x20+'" name="account_name'+x20+'" class="form-control bank_name"></div>';
                fieldHTML20 += '<div class="col-1 p-0"><label for="action'+x20+'" class="d-block" style="color:#fff;"> a </label>';
                fieldHTML20 += '<a href="javascript:void(0);" class="remove_button20 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></div></a></div></div>';
            $(wrapper20).append(fieldHTML20); //Add field html
            $('#bank_option'+x20).append($('#bank_option > optgroup').clone());            
             //Increment field counter
            x20++;
        }
    });
    //Once remove button is clicked
    $(wrapper20).on('click', '.remove_button20', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x20--; //Decrement field counter
    });
  
    // C. Do you have any access to any form of credit? field
    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper

    var x1 = js_supplier_ac.length > 0 ? js_supplier_ac.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x1 < maxField2){ 
            var fieldHTML2  = '<div class="row ac_wrap"><div class="col-md-4 form-group">';
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
  
  //   // E. Certifications (Example: ISO 14001: 2015) - Quality Standards form
  //   var maxField3 = 10; //Input fields increment limitation
  //   var addButton3 = $('.add_button3'); //Add button selector
  //   var wrapper3 = $('.field_wrapper3'); //Input field wrapper

  //   var x2 = js_supplier_cqualities.length > 0 ? js_supplier_cqualities.length : 1; //Initial field counter is 1
  //   //Once add button is clicked
  //   $(addButton3).click(function(){
  //       //Check maximum number of input fields
  //       if(x2 < maxField3){ 
  //           var fieldHTML3  = '<div class="row"><div class="col-md-10 col-10 form-group">';
  //               fieldHTML3 += '<input type="text" id="cert_number'+x2+'" name="cert_number'+x2+'" class="form-control required" value="" ></div>';
  //               fieldHTML3 += '<div class="col-1 p-0 form-group">';
  //               fieldHTML3 += '<a href="javascript:void(0);" class="remove_button3 btn btn-danger" title="Remove field">';
  //               fieldHTML3 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
  //           x2++; //Increment field counter
  //           $(wrapper3).append(fieldHTML3); //Add field html
  //       }
  //   });
  //   //Once remove button is clicked
  //   $(wrapper3).on('click', '.remove_button3', function(e){
  //       e.preventDefault();
  //       $(this).parent('div').parent('div').remove(); //Remove field html
  //       x2--; //Decrement field counter
  //   });
  
  // // E. Certifications (Example: ISO 14001: 2015) - Safety Checks/Standards form
  // var maxField4 = 10; //Input fields increment limitation
  //   var addButton4 = $('.add_button4'); //Add button selector
  //   var wrapper4 = $('.field_wrapper4'); //Input field wrapper

  //   var x3 = js_supplier_csafety.length > 0 ? js_supplier_csafety.length : 1; //Initial field counter is 1
  //   //Once add button is clicked
  //   $(addButton4).click(function(){
  //       //Check maximum number of input fields
  //       if(x3 < maxField4){ 
  //           var fieldHTML4  = '<div class="row"><div class="col-md-10 col-10 form-group">';
  //               fieldHTML4 += '<input type="text" id="cert_safety'+x3+'" name="cert_safety'+x3+'" class="form-control required" value="" ></div>';
  //               fieldHTML4 += '<div class="col-1 p-0 form-group">';
  //               fieldHTML4 += '<a href="javascript:void(0);" class="remove_button4 btn btn-danger" title="Remove field">';
  //               fieldHTML4 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
  //           x3++; //Increment field counter
  //           $(wrapper4).append(fieldHTML4); //Add field html
  //       }
  //   });
  //   //Once remove button is clicked
  //   $(wrapper4).on('click', '.remove_button4', function(e){
  //       e.preventDefault();
  //       $(this).parent('div').parent('div').remove(); //Remove field html
  //       x3--; //Decrement field counter
  //   });
  
  // // E. Certifications (Example: ISO 14001: 2015) - Environmental Standards form
  //   var maxField5 = 10; //Input fields increment limitation
  //   var addButton5 = $('.add_button5'); //Add button selector
  //   var wrapper5 = $('.field_wrapper5'); //Input field wrapper
  //   var x4 = js_supplier_cenveronmentals.length > 0 ? js_supplier_cenveronmentals.length : 1; //Initial field counter is 1
  //   //Once add button is clicked
  //   $(addButton5).click(function(){
  //       //Check maximum number of input fields
  //       if(x4 < maxField5){ 
  //           var fieldHTML5  = '<div class="row"><div class="col-md-10 col-10 form-group">';
  //               fieldHTML5 += '<input type="text" id="cert_environmental'+x4+'" name="cert_environmental'+x4+'" class="form-control required" value="" ></div>';
  //               fieldHTML5 += '<div class="col-1 p-0 form-group">';
  //               fieldHTML5 += '<a href="javascript:void(0);" class="remove_button5 btn btn-danger" title="Remove field">';
  //               fieldHTML5 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
  //           x4++; //Increment field counter
  //           $(wrapper5).append(fieldHTML5); //Add field html
  //       }
  //   });
  //   //Once remove button is clicked
  //   $(wrapper5).on('click', '.remove_button5', function(e){
  //       e.preventDefault();
  //       $(this).parent('div').parent('div').remove(); //Remove field html
  //       x4--; //Decrement field counter
  //   });
  
  // // E. Certifications (Example: ISO 14001: 2015) - Other certifications form
  //   var maxField6 = 10; //Input fields increment limitation
  //   var addButton6 = $('.add_button6'); //Add button selector
  //   var wrapper6 = $('.field_wrapper6'); //Input field wrapper
  //   var x6 = js_supplier_cothers.length > 0 ? js_supplier_cothers.length : 1; //Initial field counter is 1
  //   //Once add button is clicked
  //   $(addButton6).click(function(){
  //       //Check maximum number of input fields
  //       if(x6 < maxField6){ 
  //           var fieldHTML6  = '<div class="row"><div class="col-md-10 col-10 form-group">';
  //               fieldHTML6 += '<input type="text" id="cert_others'+x6+'" name="cert_others'+x6+'" class="form-control required" value="" ></div>';
  //               fieldHTML6 += '<div class="col-1 p-0 form-group">';
  //               fieldHTML6 += '<a href="javascript:void(0);" class="remove_button6 btn btn-danger" title="Remove field">';
  //               fieldHTML6 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
  //           x6++; //Increment field counter
  //           $(wrapper6).append(fieldHTML6); //Add field html
  //       }
  //   });
  //   //Once remove button is clicked
  //   $(wrapper6).on('click', '.remove_button6', function(e){
  //       e.preventDefault();
  //       $(this).parent('div').parent('div').remove(); //Remove field html
  //       x6--; //Decrement field counter
  //   });
  
  // G. Current and Past Customers (List at least five) - Major Customer: form
    var maxField7 = 10; //Input fields increment limitation
    var addButton7 = $('.add_button7'); //Add button selector
    var wrapper7 = $('.field_wrapper7'); //Input field wrapper
    var x7 = js_supplier_mc.length < 5 ? 5 : js_supplier_mc.length; //Initial field counter is 1
    //Once add button is clicked
    $(addButton7).click(function(){
        //Check maximum number of input fields
        if(x7 < maxField7){ 
            var fieldHTML7  = '<div class="row mc_wrap"><div class="col-md-3 form-group">';
                fieldHTML7 += '<input type="text" class="form-control mc_institution" placeholder="Institution" id="cpc_institution'+x7+'" name="cpc_institution'+x7+'"></div>';
                fieldHTML7 += '<div class="col-md-3 form-group"><input type="text" class="form-control mc_address" placeholder="Address" id="cpc_address'+x7+'" name="cpc_address'+x7+'"></div>';
                fieldHTML7 += '<div class="col-10 col-md-3 form-group"><input type="text" class="form-control mc_number" placeholder="Contact Number" id="cpc_telephone'+x7+'" name="cpc_telephone'+x7+'">';
                fieldHTML7 += '</div>';
                fieldHTML7 += '<div class="col-10 col-md-2 form-group"><input type="email" class="form-control mc_email" placeholder="Email Address" id="cpc_email'+x7+'" name="cpc_email'+x7+'">';
                fieldHTML7 += '</div>';
                fieldHTML7 += '<div class="col-1 p-0 form-group">';
                fieldHTML7 += '<a href="javascript:void(0);" class="remove_button7 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            x7++; //Increment field counter
            $(wrapper7).append(fieldHTML7); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper7).on('click', '.remove_button7', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x7--; //Decrement field counter
    });
  
  // G. Current and Past Customers (List at least five) - Customer of Last Three Years: form
    var maxField8 = 10; //Input fields increment limitation
    var addButton8 = $('.add_button8'); //Add button selector
    var wrapper8 = $('.field_wrapper8'); //Input field wrapper
    var x8 = js_supplier_lty.length < 5 ? 5 : js_supplier_lty.length; //Initial field counter is 1
    //Once add button is clicked
    $(addButton8).click(function(){
        //Check maximum number of input fields
        if(x8 < maxField8){ 
            var fieldHTML8  = '<div class="row clty_wrap"><div class="col-md-3 form-group">';
                fieldHTML8 += '<input type="text" class="form-control clty_inst" placeholder="Institution" id="clty_institution'+x8+'" name="clty_institution'+x8+'"></div>';
                fieldHTML8 += '<div class="col-md-3 form-group"><input type="text" class="form-control clty_addr" placeholder="Address" id="clty_address'+x8+'" name="clty_address'+x8+'"></div>';
                fieldHTML8 += '<div class="col-10 col-md-3 form-group"><input type="text" class="form-control clty_cnum" placeholder="Contact Number" id="clty_telephone'+x8+'" name="clty_telephone'+x8+'">';
                fieldHTML8 += '</div>';
                fieldHTML8 += '<div class="col-10 col-md-2 form-group"><input type="email" class="form-control clty_eaddr" placeholder="Email Address" id="clty_email'+x8+'" name="clty_email'+x8+'">';
                fieldHTML8 += '</div><div class="col-1 p-0 form-group"><a href="javascript:void(0);" class="remove_button8 btn btn-danger" title="Remove field">';
                fieldHTML8 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
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
  
  // approval form
  var maxField9 = 10; //Input fields increment limitation
    var addButton9 = $('.add_button9'); //Add button selector
    var wrapper9 = $('.field_wrapper9'); //Input field wrapper
    var fieldHTML9 = ''; //New input field html 
    var x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton9).click(function(){
        //Check maximum number of input fields
        $('.field_wrapper9').css('display','block');
        $('.add_button9').css('display','none');
        $('.remove_button9').css('display','inline-block');
    });
    //Once remove button is clicked
    $('.remove_button9').click(function(){
        $('.field_wrapper9').css('display','none');
        $('.add_button9').css('display','inline-block');
        $('.remove_button9').css('display','none');
    });
  
  // upload products on register page
  var maxField10 = 10; //Input fields increment limitation
    var addButton10 = $('.add_button10'); //Add button selector
    var wrapper10 = $('.field_wrapper10'); //Input field wrapper
    var fieldHTML10 = '<div class="upload"><div class="form-group row"><label for="text" class="col-sm-4 col-form-label">Product Name:</label><div class="col-sm-8"><input class="form-control" type="text" placeholder="Default input" id="text"></div></div><div class="form-group row"><label for="text" class="col-sm-4 col-form-label">Description:</label><div class="col-sm-8"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div></div><div class="form-group row"><label for="text" class="col-sm-4 col-form-label">Upload pictures:</label><div class="col-sm-8"><p class="small mb-2">Required image dimension: 600px by 600px<br>Maximum file size: 1MB<br>Required file type: .jpeg .png </p><form action="http://example.com/post" name="form-example-2" id="form-example-2" enctype="multipart/form-data" class="m-0"><div class="input-images"></div></form><p class="small m-0">Drag & Drop files or click the box to browse</p></div></div><div class="form-group row text-right"><div class="col-sm-12"><a href="javascript:void(0);" class="remove_button10 btn btn-danger" title="Remove field">Delete Product <i class="icon-minus-circle"></i></a></div></div><hr></div>'; //New input field html
    //Once add button is clicked
    $(addButton10).click(function(){
        //Check maximum number of input fields
        if(x < maxField10){ 
            x++; //Increment field counter
            $(wrapper10).append(fieldHTML10); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper10).on('click', '.remove_button10', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
  
  var maxField11 = 10; //Input fields increment limitation
    var addButton11 = $('.add_button11'); //Add button selector
    var wrapper11 = $('.field_wrapper11'); //Input field wrapper
   
    //Once add button is clicked
    $(addButton11).click(function(){
        //Check maximum number of input fields
        if(x < maxField11){ 
            x++; //Increment field counter
             var fieldHTML11 = '<div class="upload"><div class="form-group row"><label for="text" class="col-md-4 col-form-label">Product URL:</label><div class="col-md-7 col-9"><input type="text" name="product_url'+x+'" id="product_url'+x+'" placeholder="https://" class="form-control required url"></div><div class="col-md-1 col-3 text-right"><a href="javascript:void(0);" class="remove_button11 btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div></div>'; //New input field html
            $(wrapper11).append(fieldHTML11); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper11).on('click', '.remove_button11', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
  
  
});


// Goods and Services
    
    var gas_maxField = 10; //Input fields increment limitation
    var gas_addButton = $('.gas_add_button'); //Add button selector
    var gas_wrapper = $('.chemicals_lab_equipment_and_supplies_field_wrapper'); //Input field wrapper

    var gas_x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton).click(function(){
        //Check maximum number of input fields
        if(gas_x < gas_maxField){ 
            var gas_fieldHTML  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML += '<input type="text" class="chemicals_lab_equipment_and_supplies_otherss form-control"></div>';
                gas_fieldHTML += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML += '<a href="javascript:void(0);" class="chemicals_lab_equipment_and_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x++; //Increment field counter
            $(gas_wrapper).append(gas_fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper).on('click', '.chemicals_lab_equipment_and_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x--; //Decrement field counter
    });

    var gas_maxField1 = 10; //Input fields increment limitation
    var gas_addButton1 = $('.gas_add_button1'); //Add button selector
    var gas_wrapper1 = $('.electrical_and_instrumentation_supplies_field_wrapper'); //Input field wrapper

    var gas_x1 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton1).click(function(){
        //Check maximum number of input fields
        if(gas_x1 < gas_maxField1){ 
            var gas_fieldHTML1  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML1 += '<input type="text" class="electrical_and_instrumentation_supplies_otherss form-control"></div>';
                gas_fieldHTML1 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML1 += '<a href="javascript:void(0);" class="electrical_and_instrumentation_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML1 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x1++; //Increment field counter
            $(gas_wrapper1).append(gas_fieldHTML1); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper1).on('click', '.electrical_and_instrumentation_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x1--; //Decrement field counter
    });

    var gas_maxField2 = 10; //Input fields increment limitation
    var gas_addButton2 = $('.gas_add_button2'); //Add button selector
    var gas_wrapper2 = $('.explosives_and_accessories_field_wrapper'); //Input field wrapper

    var gas_x2 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton2).click(function(){
        //Check maximum number of input fields
        if(gas_x2 < gas_maxField2){ 
            var gas_fieldHTML2  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML2 += '<input type="text" class="explosives_and_accessories_otherss form-control"></div>';
                gas_fieldHTML2 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML2 += '<a href="javascript:void(0);" class="explosives_and_accessories_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML2 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x2++; //Increment field counter
            $(gas_wrapper2).append(gas_fieldHTML2); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper2).on('click', '.explosives_and_accessories_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x2--; //Decrement field counter
    });

    var gas_maxField3 = 10; //Input fields increment limitation
    var gas_addButton3 = $('.gas_add_button3'); //Add button selector
    var gas_wrapper3 = $('.food_household_appliance_housekeeping_and_general_supplies_field_wrapper'); //Input field wrapper

    var gas_x3 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton3).click(function(){
        //Check maximum number of input fields
        if(gas_x3 < gas_maxField3){ 
            var gas_fieldHTML3  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML3 += '<input type="text" class="food_household_appliance_housekeeping_and_general_supplies_otherss form-control"></div>';
                gas_fieldHTML3 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML3 += '<a href="javascript:void(0);" class="food_household_appliance_housekeeping_and_general_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML3 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x3++; //Increment field counter
            $(gas_wrapper3).append(gas_fieldHTML3); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper3).on('click', '.food_household_appliance_housekeeping_and_general_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x3--; //Decrement field counter
    });

    var gas_maxField4 = 10; //Input fields increment limitation
    var gas_addButton4 = $('.gas_add_button4'); //Add button selector
    var gas_wrapper4 = $('.hardware_and_construction_supplies_field_wrapper'); //Input field wrapper

    var gas_x4 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton4).click(function(){
        //Check maximum number of input fields
        if(gas_x4 < gas_maxField4){ 
            var gas_fieldHTML4  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML4 += '<input type="text" class="hardware_and_construction_supplies_otherss form-control"></div>';
                gas_fieldHTML4 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML4 += '<a href="javascript:void(0);" class="hardware_and_construction_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML4 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x4++; //Increment field counter
            $(gas_wrapper4).append(gas_fieldHTML4); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper4).on('click', '.hardware_and_construction_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x4--; //Decrement field counter
    });

    var gas_maxField5 = 10; //Input fields increment limitation
    var gas_addButton5 = $('.gas_add_button5'); //Add button selector
    var gas_wrapper5 = $('.information_and_communication_technology_field_wrapper'); //Input field wrapper

    var gas_x5 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton5).click(function(){
        //Check maximum number of input fields
        if(gas_x5 < gas_maxField5){ 
            var gas_fieldHTML5  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML5 += '<input type="text" class="information_and_communication_technology_otherss form-control"></div>';
                gas_fieldHTML5 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML5 += '<a href="javascript:void(0);" class="information_and_communication_technology_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML5 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x5++; //Increment field counter
            $(gas_wrapper5).append(gas_fieldHTML5); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper5).on('click', '.information_and_communication_technology_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x5--; //Decrement field counter
    });

    var gas_maxField6 = 10; //Input fields increment limitation
    var gas_addButton6 = $('.gas_add_button6'); //Add button selector
    var gas_wrapper6 = $('.mechanical_machineries_equipment_and_supplies_field_wrapper'); //Input field wrapper

    var gas_x6 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton6).click(function(){
        //Check maximum number of input fields
        if(gas_x6 < gas_maxField6){ 
            var gas_fieldHTML6  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML6 += '<input type="text" class="mechanical_machineries_equipment_and_supplies_otherss form-control"></div>';
                gas_fieldHTML6 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML6 += '<a href="javascript:void(0);" class="mechanical_machineries_equipment_and_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML6 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x6++; //Increment field counter
            $(gas_wrapper6).append(gas_fieldHTML6); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper6).on('click', '.mechanical_machineries_equipment_and_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x6--; //Decrement field counter
    });

    var gas_maxField7 = 10; //Input fields increment limitation
    var gas_addButton7 = $('.gas_add_button7'); //Add button selector
    var gas_wrapper7 = $('.medical_equipment_and_supplies_field_wrapper'); //Input field wrapper

    var gas_x7 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton7).click(function(){
        //Check maximum number of input fields
        if(gas_x7 < gas_maxField7){ 
            var gas_fieldHTML7  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML7 += '<input type="text" class="medical_equipment_and_supplies_otherss form-control"></div>';
                gas_fieldHTML7 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML7 += '<a href="javascript:void(0);" class="medical_equipment_and_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML7 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x7++; //Increment field counter
            $(gas_wrapper7).append(gas_fieldHTML7); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper7).on('click', '.medical_equipment_and_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x7--; //Decrement field counter
    });

    var gas_maxField8 = 10; //Input fields increment limitation
    var gas_addButton8 = $('.gas_add_button8'); //Add button selector
    var gas_wrapper8 = $('.ore_milling_and_processing_supplies_field_wrapper'); //Input field wrapper

    var gas_x8 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton8).click(function(){
        //Check maximum number of input fields
        if(gas_x8 < gas_maxField8){ 
            var gas_fieldHTML8  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML8 += '<input type="text" class="ore_milling_and_processing_supplies_otherss form-control"></div>';
                gas_fieldHTML8 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML8 += '<a href="javascript:void(0);" class="ore_milling_and_processing_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML8 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x8++; //Increment field counter
            $(gas_wrapper8).append(gas_fieldHTML8); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper8).on('click', '.ore_milling_and_processing_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x8--; //Decrement field counter
    });

    var gas_maxField9 = 10; //Input fields increment limitation
    var gas_addButton9 = $('.gas_add_button9'); //Add button selector
    var gas_wrapper9 = $('.mining_supplies_field_wrapper'); //Input field wrapper

    var gas_x9 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton9).click(function(){
        //Check maximum number of input fields
        if(gas_x9 < gas_maxField9){ 
            var gas_fieldHTML9  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML9 += '<input type="text" class="mining_supplies_otherss form-control"></div>';
                gas_fieldHTML9 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML9 += '<a href="javascript:void(0);" class="mining_supplies_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML9 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x9++; //Increment field counter
            $(gas_wrapper9).append(gas_fieldHTML9); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper9).on('click', '.mining_supplies_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x9--; //Decrement field counter
    });

    var gas_maxField10 = 10; //Input fields increment limitation
    var gas_addButton10 = $('.gas_add_button10'); //Add button selector
    var gas_wrapper10 = $('.office_equipment_furniture_and_fixtures_field_wrapper'); //Input field wrapper

    var gas_x10 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton10).click(function(){
        //Check maximum number of input fields
        if(gas_x10 < gas_maxField10){ 
            var gas_fieldHTML10  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML10 += '<input type="text" class="office_equipment_furniture_and_fixtures_otherss form-control"></div>';
                gas_fieldHTML10 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML10 += '<a href="javascript:void(0);" class="office_equipment_furniture_and_fixtures_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML10 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x10++; //Increment field counter
            $(gas_wrapper10).append(gas_fieldHTML10); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper10).on('click', '.office_equipment_furniture_and_fixtures_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x10--; //Decrement field counter
    });

    var gas_maxField11 = 10; //Input fields increment limitation
    var gas_addButton11 = $('.gas_add_button11'); //Add button selector
    var gas_wrapper11 = $('.safety_equipment_and_apparel_field_wrapper'); //Input field wrapper

    var gas_x11 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton11).click(function(){
        //Check maximum number of input fields
        if(gas_x11 < gas_maxField11){ 
            var gas_fieldHTML11  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML11 += '<input type="text" class="safety_equipment_and_apparel_otherss form-control"></div>';
                gas_fieldHTML11 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML11 += '<a href="javascript:void(0);" class="safety_equipment_and_apparel_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML11 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x11++; //Increment field counter
            $(gas_wrapper11).append(gas_fieldHTML11); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper11).on('click', '.safety_equipment_and_apparel_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x11--; //Decrement field counter
    });

    var gas_maxField12 = 10; //Input fields increment limitation
    var gas_addButton12 = $('.gas_add_button12'); //Add button selector
    var gas_wrapper12 = $('.tools_and_equipment_field_wrapper'); //Input field wrapper

    var gas_x12 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton12).click(function(){
        //Check maximum number of input fields
        if(gas_x12 < gas_maxField12){ 
            var gas_fieldHTML12  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML12 += '<input type="text" class="tools_and_equipment_otherss form-control"></div>';
                gas_fieldHTML12 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML12 += '<a href="javascript:void(0);" class="tools_and_equipment_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML12 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x12++; //Increment field counter
            $(gas_wrapper12).append(gas_fieldHTML12); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper12).on('click', '.tools_and_equipment_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x12--; //Decrement field counter
    });

    var gas_maxField13 = 10; //Input fields increment limitation
    var gas_addButton13 = $('.gas_add_button13'); //Add button selector
    var gas_wrapper13 = $('.utilities_and_services_field_wrapper'); //Input field wrapper

    var gas_x13 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton13).click(function(){
        //Check maximum number of input fields
        if(gas_x13 < gas_maxField13){ 
            var gas_fieldHTML13  = '<div class="row"><div class="col-md-8 col-8 form-group">';
                gas_fieldHTML13 += '<input type="text" class="utilities_and_services_otherss form-control"></div>';
                gas_fieldHTML13 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML13 += '<a href="javascript:void(0);" class="utilities_and_services_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML13 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x13++; //Increment field counter
            $(gas_wrapper13).append(gas_fieldHTML13); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper13).on('click', '.utilities_and_services_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x13--; //Decrement field counter
    });


    var gas_maxField14 = 10; //Input fields increment limitation
    var gas_addButton14 = $('.gas_add_button14'); //Add button selector
    var gas_wrapper14 = $('.others_field_wrapper'); //Input field wrapper

    var gas_x14 = 1; //Initial field counter is 1
    //Once add button is clicked
    $(gas_addButton14).click(function(){
        //Check maximum number of input fields
        if(gas_x14 < gas_maxField14){ 
            var gas_fieldHTML13  = '<div class="row"><div class="col-md-10 col-10 form-group">';
                gas_fieldHTML13 += '<input type="text" class="others_license_name_otherss form-control"></div>';
                gas_fieldHTML13 += '<div class="col-1 p-0 form-group">';
                gas_fieldHTML13 += '<a href="javascript:void(0);" class="others_remove_button btn btn-danger" title="Remove field">';
                gas_fieldHTML13 += '<i class="icon-minus-circle"></i></a></div></div>'; //New input field html 
            gas_x14++; //Increment field counter
            $(gas_wrapper14).append(gas_fieldHTML13); //Add field html
        }
    });
    //Once remove button is clicked
    $(gas_wrapper14).on('click', '.others_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        gas_x14--; //Decrement field counter
    });


// Certifications 
    var qs_maxField = 10; //Input fields increment limitation
    var qs_addButton = $('.qs_add_button'); //Add button selector
    var qs_wrapper = $('.qs_field_wrapper'); //Input field wrapper

    var qs_x = js_supplier_cqualities.length > 0 ? js_supplier_cqualities.length : 1; //Initial field counter is 1

    //Once add button is clicked
    $(qs_addButton).click(function(){
        //Check maximum number of input fields
        if(qs_x < qs_maxField){ 
            var qs_fieldHTML  = '<div class="row quality_certs" data-count="'+qs_x+'" style="margin-bottom: 15px;"><div class="col-4">';
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
            var scs_fieldHTML  = '<div class="row safety_certs" data-count="'+scs_x+'" style="margin-bottom: 15px;"><div class="col-4">';
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
            var es_fieldHTML  = '<div class="row environmental_certs" data-count="'+es_x+'" style="margin-bottom: 15px;"><div class="col-4">';
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
            var ocs_fieldHTML  = '<div class="row ocs_certs" data-count="'+ocs_x+'" style="margin-bottom: 15px;"><div class="col-4">';
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

    var bli_maxField = 10; //Input fields increment limitation
    var bli_addButton = $('.bli_others_add_button'); //Add button selector
    var bli_wrapper = $('.business_line_others_field_wrapper'); //Input field wrapper

    var bli_x = js_supplier_cothers.length > 0 ? js_supplier_cothers.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(bli_addButton).click(function(){
        //Check maximum number of input fields
        if(bli_x < bli_maxField){ 
            var bli_fieldHTML  = '<div class="row" style="margin-top:15px;">';
                bli_fieldHTML += '<div class="col-8">';
                bli_fieldHTML += '<input type="text" class="business_line_others_othersss form-control">';
                bli_fieldHTML += '</div><a href="javascript:void(0);" class="bli_remove_button btn btn-danger" Remove="Add field">';
                bli_fieldHTML += '<i class="icon-minus-circle"></i></a></div>';
            bli_x++; //Increment field counter
            $(bli_wrapper).append(bli_fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(bli_wrapper).on('click', '.bli_remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        bli_x--; //Decrement field counter
    });

// display form when checkbox is checked
function myFunction() {

  // Goods and Services  
  var gas_checkBox = document.getElementById("chemicals_lab_equipment_and_supplies_others");
  var gas_text = document.getElementById("chemicals_lab_equipment_and_supplies_other_wrap");
  if (gas_checkBox.checked == true){
    gas_text.style.display = "block";
  } else {
    gas_text.style.display = "none";
  }

  var gas_checkBox1 = document.getElementById("electrical_and_instrumentation_supplies_others");
  var gas_text1 = document.getElementById("electrical_and_instrumentation_supplies_other_wrap");
  if (gas_checkBox1.checked == true){
    gas_text1.style.display = "block";
  } else {
    gas_text1.style.display = "none";
  }

  var gas_checkBox2 = document.getElementById("explosives_and_accessories_others");
  var gas_text2 = document.getElementById("explosives_and_accessories_other_wrap");
  if (gas_checkBox2.checked == true){
    gas_text2.style.display = "block";
  } else {
    gas_text2.style.display = "none";
  }

  var gas_checkBox3 = document.getElementById("food_household_appliance_housekeeping_and_general_supplies_others");
  var gas_text3 = document.getElementById("food_household_appliance_housekeeping_and_general_supplies_other_wrap");
  if (gas_checkBox3.checked == true){
    gas_text3.style.display = "block";
  } else {
    gas_text3.style.display = "none";
  }

  var gas_checkBox4 = document.getElementById("hardware_and_construction_supplies_others");
  var gas_text4 = document.getElementById("hardware_and_construction_supplies_other_wrap");
  if (gas_checkBox4.checked == true){
    gas_text4.style.display = "block";
  } else {
    gas_text4.style.display = "none";
  }

  var gas_checkBox5 = document.getElementById("information_and_communication_technology_others");
  var gas_text5 = document.getElementById("information_and_communication_technology_other_wrap");
  if (gas_checkBox5.checked == true){
    gas_text5.style.display = "block";
  } else {
    gas_text5.style.display = "none";
  }

  var gas_checkBox6 = document.getElementById("mechanical_machineries_equipment_and_supplies_others");
  var gas_text6 = document.getElementById("mechanical_machineries_equipment_and_supplies_other_wrap");
  if (gas_checkBox6.checked == true){
    gas_text6.style.display = "block";
  } else {
    gas_text6.style.display = "none";
  }

  var gas_checkBox7 = document.getElementById("medical_equipment_and_supplies_others");
  var gas_text7 = document.getElementById("medical_equipment_and_supplies_other_wrap");
  if (gas_checkBox7.checked == true){
    gas_text7.style.display = "block";
  } else {
    gas_text7.style.display = "none";
  }

  var gas_checkBox8 = document.getElementById("ore_milling_and_processing_supplies_others");
  var gas_text8 = document.getElementById("ore_milling_and_processing_supplies_other_wrap");
  if (gas_checkBox8.checked == true){
    gas_text8.style.display = "block";
  } else {
    gas_text8.style.display = "none";
  } 

  var gas_checkBox9 = document.getElementById("mining_supplies_others");
  var gas_text9 = document.getElementById("mining_supplies_other_wrap");
  if (gas_checkBox9.checked == true){
    gas_text9.style.display = "block";
  } else {
    gas_text9.style.display = "none";
  } 

  var gas_checkBox10 = document.getElementById("office_equipment_furniture_and_fixtures_others");
  var gas_text10 = document.getElementById("office_equipment_furniture_and_fixtures_other_wrap");
  if (gas_checkBox10.checked == true){
    gas_text10.style.display = "block";
  } else {
    gas_text10.style.display = "none";
  } 

  var gas_checkBox11 = document.getElementById("safety_equipment_and_apparel_others");
  var gas_text11 = document.getElementById("safety_equipment_and_apparel_other_wrap");
  if (gas_checkBox11.checked == true){
    gas_text11.style.display = "block";
  } else {
    gas_text11.style.display = "none";
  } 

  var gas_checkBox12 = document.getElementById("tools_and_equipment_others");
  var gas_text12 = document.getElementById("tools_and_equipment_other_wrap");
  if (gas_checkBox12.checked == true){
    gas_text12.style.display = "block";
  } else {
    gas_text12.style.display = "none";
  } 

  var gas_checkBox13 = document.getElementById("utilities_and_services_others");
  var gas_text13 = document.getElementById("utilities_and_services_other_wrap");
  if (gas_checkBox13.checked == true){
    gas_text13.style.display = "block";
  } else {
    gas_text13.style.display = "none";
  } 

  // Business line others
  var bloi = document.getElementById("business_line_others");
  var bloi_wrap = document.getElementById("business_line_others_field_wrap");
  if (bloi.checked == true){
    bloi_wrap.style.display = "block";
  } else {
    bloi_wrap.style.display = "none";
  } 

  // B. Goods and Services - chemicals lab equipment and supplies
  var checkBox = document.getElementById("chemicals_lab_equipment_and_supplies");
  var text = document.getElementById("chemicals_lab_equipment_and_supplies_form");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
  
  // B. Goods and Services - electrical and instrumentation supplies
  var checkBox1 = document.getElementById("electrical_and_instrumentation_supplies");
  var text1 = document.getElementById("electrical_and_instrumentation_supplies_form");
  if (checkBox1.checked == true){
    text1.style.display = "block";
  } else {
    text1.style.display = "none";
  }

  // B. Goods and Services - explosives and accessories
  var checkBox2 = document.getElementById("explosives_and_accessories");
  var text2 = document.getElementById("explosives_and_accessories_form");
  if (checkBox2.checked == true){
    text2.style.display = "block";
  } else {
    text2.style.display = "none";
  }
  
  // B. Goods and Services - food_household appliance housekeeping and general supplies
  var checkBox3 = document.getElementById("food_household_appliance_housekeeping_and_general_supplies");
  var text3 = document.getElementById("food_household_appliance_housekeeping_and_general_supplies_form");
  if (checkBox3.checked == true){
    text3.style.display = "block";
  } else {
    text3.style.display = "none";
  }
  
  //B. Goods and Services - hardware and construction supplies supplies
  var checkBox4 = document.getElementById("hardware_and_construction_supplies");
  var text4 = document.getElementById("hardware_and_construction_supplies_form");
  if (checkBox4.checked == true){
    text4.style.display = "block";
  } else {
    text4.style.display = "none";
  }
  
  // B. Goods and Services - information and communication technology form
  var checkBox5 = document.getElementById("information_and_communication_technology");
  var text5 = document.getElementById("information_and_communication_technology_form");
  if (checkBox5.checked == true){
    text5.style.display = "block";
  } else {
    text5.style.display = "none";
  }
  
  // B. Goods and Services - mechanical machineries equipment and supplies
  var checkBox5 = document.getElementById("mechanical_machineries_equipment_and_supplies");
  var text5 = document.getElementById("mechanical_machineries_equipment_and_supplies_form");
  if (checkBox5.checked == true){
    text5.style.display = "block";
  } else {
    text5.style.display = "none";
  }

  // B. Goods and Services - medical equipment and supplies
  var checkBox7 = document.getElementById("medical_equipment_and_supplies");
  var text7 = document.getElementById("medical_equipment_and_supplies_form");
  if (checkBox7.checked == true){
    text7.style.display = "block";
  } else {
    text7.style.display = "none";
  }
    
  // B. Goods and Services - ore milling and processing supplies
  var checkBox9 = document.getElementById("ore_milling_and_processing_supplies");
  var text9 = document.getElementById("ore_milling_and_processing_supplies_form");
  if (checkBox9.checked == true){
    text9.style.display = "block";
  } else {
    text9.style.display = "none";
  }

  // B. Goods and Services - mining supplies
  var checkBox8 = document.getElementById("mining_supplies");
  var text8 = document.getElementById("mining_supplies_form");
  if (checkBox8.checked == true){
    text8.style.display = "block";
  } else {
    text8.style.display = "none";
  }

  // B. Goods and Services - office equipment furniture and fixtures
  var checkBox10 = document.getElementById("office_equipment_furniture_and_fixtures");
  var text10 = document.getElementById("office_equipment_furniture_and_fixtures_form");
  if (checkBox10.checked == true){
    text10.style.display = "block";
  } else {
    text10.style.display = "none";
  }
  
  // B. Goods and Services - safety equipment and apparel
  var checkBox11 = document.getElementById("safety_equipment_and_apparel");
  var text11 = document.getElementById("safety_equipment_and_apparel_form");
  if (checkBox11.checked == true){
    text11.style.display = "block";
  } else {
    text11.style.display = "none";
  }
  
  // B. Goods and Services - tools and equipment form
  var checkBox12 = document.getElementById("tools_and_equipment");
  var text12 = document.getElementById("tools_and_equipment_form");
  if (checkBox12.checked == true){
    text12.style.display = "block";
  } else {
    text12.style.display = "none";
  }

  // B. Goods and Services - utilities and services form
  var checkBox12 = document.getElementById("utilities_and_services");
  var text12 = document.getElementById("utilities_and_services_form");
  if (checkBox12.checked == true){
    text12.style.display = "block";
  } else {
    text12.style.display = "none";
  }
  
  // B. Goods and Services - others form
  var checkBox13 = document.getElementById("others-goods");
  var text13 = document.getElementById("others-goods-form");
  if (checkBox13.checked == true){
    text13.style.display = "block";
  } else {
    text13.style.display = "none";
  }
  
  // E. Certifications (Example: ISO 14001: 2015) - Quality Standards form
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
  
  // F. For Timber, Explosives, Chemicals and Other Controlled Commodity Suppliers - others form
  // var checkBox4 = document.getElementById("other-timb");
  // var text4 = document.getElementById("other-timb-form");
  // if (checkBox4.checked == true){
  //   text4.style.display = "block";
  // } else {
  //   text4.style.display = "none";
  // }




}


  // D. General Requirements
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



function fs_income_statement() {
  var checkBoxd4 = document.getElementById("income_statement");
  var textd4 = document.getElementById("income_statement_wrap");
  if (checkBoxd4.checked == true){
    textd4.style.display = "block";
  } else {
    textd4.style.display = "none";
  }  
}

function fs_balance_sheet() {
  var checkBoxd4 = document.getElementById("balance_sheet");
  var textd4 = document.getElementById("balance_sheet_wrap");
  if (checkBoxd4.checked == true){
    textd4.style.display = "block";
  } else {
    textd4.style.display = "none";
  }  
}

function fs_cash_flow() {
  var checkBoxd4 = document.getElementById("statement_of_cash_flow");
  var textd4 = document.getElementById("statement_of_cash_flow_wrap");
  if (checkBoxd4.checked == true){
    textd4.style.display = "block";
  } else {
    textd4.style.display = "none";
  }  
}



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






// display form when radio button is selected
function ShowHideDiv() {
  // C. Do you have any access to any form of credit? form
  var chkYes = document.getElementById("chkYes");
  var dvtext = document.getElementById("dvtext");
  dvtext.style.display = chkYes.checked ? "block" : "none";
  
  // A. General Information - business type form
  var chkYes1 = document.getElementById("business-type5");
  var dvtext1 = document.getElementById("other-business-type");
  dvtext1.style.display = chkYes1.checked ? "block" : "none";
}
function ShowHideDiv2() {
  // upload product in register page
  var uploadImage = document.getElementById("uploadImg");
  var uploadImageForm = document.getElementById("upIMG");
  uploadImageForm.style.display = uploadImage.checked ? "block" : "none";
  
  var uploadLink = document.getElementById("uploadURL");
  var uploadLinkForm = document.getElementById("upURL");
  uploadLinkForm.style.display = uploadLink.checked ? "block" : "none";
}
