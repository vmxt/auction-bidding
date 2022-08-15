<div class="col-12">
	
	<label class="bg-dark text-light p-2">Contact Details: <span class="field-req">*</span></label><br>
                                        
    <div class="row">
        
        <div class="col-md-4 form-group">
            
            <label class="bg-info text-light p-2 label-warning">Customer Service</label>
        
            <div class="form-group">
                <label for="cs_name"> Contact Person (name) </label>
                <input type="text" name="cs_name" id="contact-person-name" class="form-control cd_input" data-group="cs" data-field="name" 
                    value="{{ old('cs_name', $supplier_contact_cs ? $supplier_contact_cs->name:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_position"> Position </label>
                <input type="text" name="cs_position" id="contact-person-name1" class="form-control cd_input" data-group="cs" data-field="position"
                    value="{{ old('cs_position', $supplier_contact_cs ? $supplier_contact_cs->position:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_email"> Email </label>
                <input type="email" name="cs_email" id="contact-person-name2" class="form-control cd_input" data-group="cs" data-field="email" 
                    value="{{ old('cs_email', $supplier_contact_cs ? $supplier_contact_cs->email:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_telephone"> Telephone Number </label>
                <input type="text" name="cs_telephone" id="contact-person-name3" class="form-control cd_input" 
                    data-group="cs" data-field="telephone_no"
                    value="{{ old('cs_telephone', $supplier_contact_cs ? $supplier_contact_cs->telephone_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_mobile"> Mobile Number </label>
                <input type="text" name="cs_mobile" id="contact-person-name5" class="form-control cd_input" 
                    data-group="cs" data-field="mobile_no" 
                    value="{{ old('cs_mobile', $supplier_contact_cs ? $supplier_contact_cs->mobile_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_fax"> Fax Number </label>
                <input type="text" name="cs_fax" id="contact-person-name4" class="form-control cd_input" data-group="cs" data-field="fax_no"
                    value="{{ old('cs_fax', $supplier_contact_cs ? $supplier_contact_cs->fax_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_skype"> Skype </label>
                <input type="text" name="cs_skype" id="contact-person-name6" class="form-control cd_input" data-group="cs" data-field="skype"
                    value="{{ old('cs_skype', $supplier_contact_cs ? $supplier_contact_cs->skype:'') }}" >
            </div>

            <div class="form-group">
                <label for="cs_others"> Others </label>
                <input type="text" name="cs_others" id="contact-person-name7" class="form-control cd_input" data-group="cs" data-field="others" 
                    value="{{ old('cs_others', $supplier_contact_cs ? $supplier_contact_cs->others:'') }}" >
            </div>                                                

        </div>

        <div class="col-md-4 form-group">
           
           <label class="bg-info text-light p-2 label-warning">Sales</label>

           <div class="form-group">
                <label for="sales_name"> Contact Person (name) </label>
                <input type="text" name="sales_name" id="contact-person-sale" class="form-control cd_input" data-group="sales" data-field="name"
                    value="{{ old('sales_name', $supplier_contact_sales ? $supplier_contact_sales->name:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_position"> Position </label>
                <input type="text" name="sales_position" id="contact-person-sale1" class="form-control cd_input" 
                    data-group="sales" data-field="position" 
                    value="{{ old('sales_position', $supplier_contact_sales ? $supplier_contact_sales->position:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_email"> Email </label>
                <input type="email" name="sales_email" id="contact-person-sale2" class="form-control cd_input" data-group="sales" data-field="email" 
                    value="{{ old('sales_email', $supplier_contact_sales ? $supplier_contact_sales->email:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_telephone"> Telephone Number </label>
                <input type="text" name="sales_telephone" id="contact-person-sale3" class="form-control cd_input" data-group="sales"
                    data-field="telephone_no" 
                    value="{{ old('sales_telephone', $supplier_contact_sales ? $supplier_contact_sales->telephone_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_mobile"> Mobile Number </label>
                <input type="text" name="sales_mobile" id="contact-person-sale5" class="form-control cd_input" 
                    data-group="sales" data-field="mobile_no" 
                    value="{{ old('sales_mobile', $supplier_contact_sales ? $supplier_contact_sales->mobile_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_fax"> Fax Number </label>
                <input type="text" name="sales_fax" id="contact-person-sale4" class="form-control cd_input" data-group="sales" data-field="fax_no" 
                    value="{{ old('sales_fax', $supplier_contact_sales ? $supplier_contact_sales->fax_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_skype"> Skype </label>
                <input type="text" name="sales_skype" id="contact-person-sale6" class="form-control cd_input" data-group="sales" data-field="skype" 
                    value="{{ old('sales_skype', $supplier_contact_sales ? $supplier_contact_sales->skype:'') }}" >
            </div>

            <div class="form-group">
                <label for="sales_others"> Others </label>
                <input type="text" name="sales_others" id="contact-person-sale7" class="form-control cd_input" data-group="sales" data-field="others"
                    value="{{ old('sales_others', $supplier_contact_sales ? $supplier_contact_sales->others:'') }}" >
            </div>
        
        </div>

        <div class="col-md-4 form-group">
            
            <label class="bg-info text-light p-2 label-warning">Accounting</label>

            <div class="form-group">
                <label for="accounting_name"> Contact Person (name) </label>
                <input type="text" name="accounting_name" id="contact-person-accnt" class="form-control cd_input" data-group="accounting" 
                    data-field="name" 
                    value="{{ old('accounting_name', $supplier_contact_accounting ? $supplier_contact_accounting->name:'') }}" >
            </div>

            <div class="form-group">
                <label for="accounting_position"> Position </label>
                <input type="text" name="accounting_position" id="contact-person-accnt1" class="form-control cd_input" data-group="accounting" 
                    data-field="position" 
                    value="{{ old('accounting_position', $supplier_contact_accounting ? $supplier_contact_accounting->position:'') }}" >
            </div>

            <div class="form-group">
                <label for="accounting_email"> Email </label>
                <input type="email" name="accounting_email" id="contact-person-accnt2" class="form-control cd_input" data-group="accounting" 
                    data-field="email" 
                    value="{{ old('accounting_email', $supplier_contact_accounting ? $supplier_contact_accounting->email:'') }}" >                
            </div>

            <div class="form-group">
                <label for="accounting_telephone"> Telephone Number </label>
                <input type="text" name="accounting_telephone" id="contact-person-accnt3" class="form-control cd_input" 
                    data-group="accounting" data-field="telephone_no" 
                    value="{{ old('accounting_telephone', $supplier_contact_accounting ? $supplier_contact_accounting->telephone_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="accounting_mobile"> Mobile Number </label>
                <input type="text" name="accounting_mobile" id="contact-person-accnt5" class="form-control cd_input" 
                    data-group="accounting" data-field="mobile_no" 
                    value="{{ old('accounting_mobile', $supplier_contact_accounting ? $supplier_contact_accounting->mobile_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="accounting_fax"> Fax Number </label>
                <input type="text" name="accounting_fax" id="contact-person-accnt4" class="form-control cd_input" 
                    data-group="accounting" data-field="fax_no" 
                    value="{{ old('accounting_fax', $supplier_contact_accounting ? $supplier_contact_accounting->fax_no:'') }}" >
            </div>

            <div class="form-group">
                <label for="accounting_skype"> Skype </label>
                <input type="text" name="accounting_skype" id="contact-person-accnt6" class="form-control cd_input" data-group="accounting" 
                    data-field="skype" 
                    value="{{ old('accounting_skype', $supplier_contact_accounting ? $supplier_contact_accounting->skype:'') }}" >
            </div>

            <div class="form-group">
                <label for="accounting_others"> Others </label>
                <input type="text" name="accounting_others" id="contact-person-accnt7" class="form-control cd_input" 
                    data-group="accounting" data-field="others" 
                    value="{{ old('accounting_others', $supplier_contact_accounting ? $supplier_contact_accounting->others:'') }}" >
            </div>

        </div>

    </div>
	
</div>

<script type="text/javascript">
    
    var js_supplier_contacts = {};
    js_supplier_contacts.cs = {!! $supplier_contact_cs !!};
    js_supplier_contacts.sales = {!! $supplier_contact_sales !!};
    js_supplier_contacts.accounting = {!! $supplier_contact_accounting !!};
    sections.contact_details = js_supplier_contacts;
    _sections.contact_details = {};
    

    function getContactDetails() {
        var _contacts = {};
        $('.cd_input').each( function () {

            var _type   = $(this).data('group');
            var _field  = $(this).data('field');
            var _val    = $(this).val().trim() != "" ? $(this).val().trim() : null;
            
            if( _contacts[_type] === undefined ) {
                _contacts[_type] = {};
            }

            if( js_supplier_contacts[_type][_field] != _val ) {

                _contacts[_type][_field] = _val;

            }


        });

        _sections.contact_details = _contacts;

    }


</script>