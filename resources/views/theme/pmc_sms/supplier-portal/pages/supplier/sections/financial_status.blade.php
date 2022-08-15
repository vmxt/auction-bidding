<div class="col-12">
    <h4 class="bg-secondary text-light p-3">Financial Status<br><small>Please provide any of the following latest audited Financial Statement.</small></h4>
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

<script type="text/javascript">

    var js_supplier_fs = {!! $data !!};
    sections.financial_status = js_supplier_fs;
    _sections.financial_status = {};

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

    function getFinancialStatus() {

        let supp_fs = [];
        let _for_update = [];

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

        $.each(supp_fs, function(k,v) {

            let _match = false;

            $.each(js_supplier_fs, function(k1, v1) {

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

        $.each(js_supplier_fs, function(k,v) {

            let _match = false;

            $.each(supp_fs, function(k1, v1) {

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
                    'action'        : 'remove'
                });

            }

        });

        _sections.financial_status = _for_update;

    }

</script>