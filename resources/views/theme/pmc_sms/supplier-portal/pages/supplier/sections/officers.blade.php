<div class="col-12">
	
	<label class="bg-dark text-light p-2">Officers: <span class="field-req">*</span>
    (at least 1 complete with name and position)</label><br>
    <div class="field_wrapper" id="officers-field-wrapper">
        <div class="row off_wrap" data-action="update" id="ow1">
            <div class="col-md-6 form-group">
              <input type="text" class="form-control off_name" placeholder="Name" id="officer_name" name="officer_name">
            </div>
            <div class="col-md-6 form-group">
              <input type="text" class="form-control off_pos" placeholder="Position" id="officer_position" name="officer_position">
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" class="add_button btn btn-success mt-2" title="Add field">Add <i class="icon-plus-circle"></i></a>
	
</div>


<script type="text/javascript">
    
    var js_supplier_officers = {!! $data !!};
    var officers = [];
    _sections.officers = {};
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var xx = js_supplier_officers.length > 0 ? js_supplier_officers.length : 1; //Initial field counter is 1
    var wrapper = $('.field_wrapper'); //Input field wrapper
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(xx < maxField){ 
            var fieldHTML = '<div class="row off_wrap" data-action="new"><div class="col-md-6 form-group"><input type="text" id="officer_name'+xx+'" class="form-control off_name" placeholder="Name" name="officer_name'+xx+'">';
                fieldHTML += '</div><div class="col-10 col-md-5 form-group">';
                fieldHTML += '<input type="text" id="officer_position'+xx+'" class="form-control off_pos" placeholder="Position" name="officer_position'+xx+'"></div>';
                fieldHTML += '<div class="col-1 p-0"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>'; 
                //New input field html 
            xx++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    
    

    if(js_supplier_officers.length>0) {
    
        $.each(js_supplier_officers, function(key, val){
            if(key == 0){
                $('#officer_name').val(val.name);
                $('#officer_position').val(val.position);
                $('#ow1').attr('data-id', val.id);
            } else {
                let officer_html  = '<div class="row off_wrap" data-action="update" data-id="'+val.id+'"><div class="col-md-6 form-group"><input type="text" id="officer_name'+key+'" class="form-control off_name" placeholder="Name" name="officer_name'+key+'" value="'+val.name+'">';
                    officer_html += '</div><div class="col-10 col-md-5 form-group">';
                    officer_html += '<input type="text" id="officer_position'+key+'" class="form-control off_pos" placeholder="Position" name="officer_position'+key+'" value="'+val.position+'"></div>';
                    officer_html += '<div class="col-1 p-0"><a href="javascript:void(0);" data-action="remove" data-id="'+val.id+'" class="remove_button btn btn-danger" title="Remove field"><i class="icon-minus-circle"></i></a></div></div>';
                $('#officers-field-wrapper').append(officer_html);
            }
            
        });

    }

    function getUpdatedOfficers() {

        officers = [];
        let _id_exist   = false;

        $('.off_wrap').each( function(k1, v1) {

            let _action = $(v1).data('action');
            let _name   = $(v1).children().children('.off_name').val();
            let _pos    = $(v1).children().children('.off_pos').val();
            let _exist  = false;
            let _id     = null;


            if( _action == 'update' ) {

                $.each(js_supplier_officers, function(k,v) {

                    if( v.id == $(v1).data('id') ) {
                        
                        _exist = true;

                        if ( v.name != _name || v.position != _pos ) {

                            officers.push({
                                'name'      : _name ,
                                'position'  : _pos ,
                                'action'    : _action ,
                                'id'        : $(v1).data('id')
                            });

                        }

                        return false;

                    }

                });                

            } else {

                officers.push({
                    'name'      : _name ,
                    'position'  : _pos ,
                    'action'    : _action ,
                    'id'        : _id
                });

            }


        });

        $.each(js_supplier_officers, function(key, val) {

            let is_match = false;

            $('.off_wrap').each( function(k2, v2) {

                if( $(v2).data('action') == 'update' ) {
                    if( val.id == $(v2).data('id') ) {
                        is_match = true;
                    }
                }

            });

            if( !is_match ) {

                officers.push({
                    'name'      : val.name ,
                    'position'  : val.position ,
                    'action'    : 'remove' ,
                    'id'        : val.id
                });

            }
        });

        // $('.off_wrap').each( function(k, v) {

        //     let _action = $(v).data('action');
        //     let _name   = $(v).children().children('.off_name').val();
        //     let _pos    = $(v).children().children('.off_pos').val();
        //     let _exist  = false;

        //     if( _action == 'update' ) {

        //         $.each(js_supplier_officers, function(key, val) {

        //             if( _name == val.name && _pos == val.position ) {
        //                 _exist = true;
        //                 return false;
        //             }                

        //         });

        //         if( !_exist ) {

        //             officers.push({
        //                 'action'    : _action ,
        //                 'name'      : _name ,
        //                 'position'  : _pos ,
        //                 'id'        : $(v).data('id')
        //             });

        //         }

        //     } else if ( _action == 'new' ) {

        //         officers.push({
        //             'action'    : _action ,
        //             'name'      : _name ,
        //             'position'  : _pos ,
        //             'id'        : null
        //         });

        //     }

        // });

        _sections.officers = officers;

        // if( officers.length > 0 ) {

        //     var html = '<h5 class="bg-dark text-light p-2">Officers:</h5>';
        //         html += '<div class="table-responsive">';
        //         html += '<table><tr><td>Name</td><td>Position</td></tr>';
        //         html += '<body>';
        //         $.each(officers, function(k,v) {
        //             html += '<tr><td>'+ v.name +'</td><td>'+ v.position + '</td></tr>';
        //         });
        //         html += '</body></table></div>';
        //         $('#update-holder').append(html);
        // }

    }


    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();

        $(this).parent('div').parent('div').remove(); //Remove field html
        xx--; //Decrement field counter
    });

</script>