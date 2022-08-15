<div class="col-12">
	
	<label class="bg-dark text-light p-2">Bank Details: <span class="field-req">*</span></label><br>
    <div class="field_wrapper20">

        <div class="row bank_wrap" data-action="update" id="f_bank">
            <div class="col-sm-6">
                <label for="bank_option"> Payment Option Name: </label>
                <select name="bank_option" class="form-control bank_opt" id="bank_option">

                    @foreach( Setting::availableBanks() as $key => $bank )

                        <optgroup label="{{$key}}">
                            @foreach($bank as $b)
                                <option value="{{strtolower($b)}}">{{ ucfirst($b) }}</option>
                            @endforeach
                        </optgroup>  

                    @endforeach

                </select>                                                    
            </div>
            <div class="col-sm-6">
                <label for="account_name"> Account Name: </label>
                <input type="text" id="account_name" name="account_name" class="form-control bank_name">
            </div>
        </div>

    </div>
    <a href="javascript:void(0);" class="add_button20 btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
	
</div>

<script type="text/javascript">
    
    var js_supplier_banks = {!! $data !!};
    sections.bank_details = js_supplier_banks;
    var maxField20 = 10; //Input fields increment limitation
    var addButton20 = $('.add_button20'); //Add button selector
    var wrapper20 = $('.field_wrapper20'); //Input field wrapper

    var x20 = js_supplier_banks.length > 0 ? js_supplier_banks.length : 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton20).click(function(){
        //Check maximum number of input fields
        if(x20 < maxField20){ 
            var fieldHTML20  = '<div class="row bank_wrap" data-action="new"><div class="col-sm-6">';
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
    
    if(js_supplier_banks.length>0){

        var wrapper20 = $('.field_wrapper20');

        $.each(js_supplier_banks, function(key, val){

            if(key > 0 ) {

                var fieldHTML20  = '<div class="row bank_wrap" data-action="update" data-id="'+val.id+'"><div class="col-sm-6">';
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
                $('#f_bank').attr('data-id', val.id);
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

    function getBankDetails() {

        var _banks = [];

        $('.bank_wrap').each(function() {

            let _action         = $(this).data('action');
            let _account_name   = $(this).children().children('.bank_name').val();
            let _bank_name      = $(this).children().children('.bank_opt').val();
            let _exist  = false;
            let _id     = null;

            if( _action == 'update' ) {

                _id = $(this).data('id');

                $.each(js_supplier_banks, function(k,v){

                    if( v.id == _id ) {

                        _exist = true;

                        if ( v.bank_name != _bank_name || v.account_name != _account_name ) {

                            _banks.push({
                                'account_name'  : _account_name ,
                                'bank_name'     : _bank_name ,
                                'action'        : _action ,
                                'id'            : _id
                            });

                        }

                        return false;

                    }

                });

            } else {

                _banks.push({
                    'account_name'  : _account_name ,
                    'bank_name'     : _bank_name ,
                    'action'        : _action ,
                    'id'            : _id
                });

            }


            $.each(js_supplier_banks, function(key, val) {

                let is_match = false;

                $('.bank_wrap').each( function() {

                    if( $(this).data('action') == 'update' ) {
                        if( val.id == $(this).data('id') ) {
                            is_match = true;
                        }
                    }

                });

                if( !is_match ) {

                    _banks.push({
                        'bank_name'         : val.bank_name ,
                        'account_name'      : val.account_name ,
                        'action'            : 'remove' ,
                        'id'                : val.id
                    });

                }
            });


            _sections.bank_details = _banks;

        });


    }

</script>