<div class="col-12">
    <h4 class="bg-secondary text-light p-3">Payment Terms</h4>
    <div class="row">
        <div class="col-12">
            <div class="col-12 form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input form-pt" type="checkbox" value="strictly cash on delivery in all transactions" id="strictly_cash_on_delivery_in_all_transactions" name="pt[]">
                    <label class="form-check-label" for="strictly_cash_on_delivery_in_all_transactions">
                        Strictly cash on delivery in all transactions
                    </label>
                </div>
            </div>
            <div class="col-12 form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input form-pt" type="checkbox" value="credit terms after delivery" id="credit_terms_after_delivery" name="pt[]">
                    <label class="form-check-label" for="credit_terms_after_delivery">
                        Credit terms after delivery
                    </label>
                </div>
            </div>
            <div class="col-12 form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input form-pt" type="checkbox" value="mixed advance payment and credit term" id="mixed_advance_payment_and_credit_term" name="pt[]">
                    <label class="form-check-label" for="mixed_advance_payment_and_credit_term">
                        Mixed advance payment and credit term
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    var js_supplier_pt = {!! $data !!};
    sections.payment_terms = js_supplier_pt;
    _sections.payment_terms = {};

    if( js_supplier_pt.length>0) {
        $.each(js_supplier_pt, function(key, val){

            let _req = val.name.replaceAll(" ","_").toLowerCase();
            $('#'+_req).prop('checked', 'checked');
        });
    }

    function getPaymentTerms() {

        let supp_pt = [];
        let _for_update = [];

        $('.form-pt').each(function(key, val){
            if(this.checked) {

                supp_pt.push({
                    'name'  : $(this).val()
                });

            }
        });

        $.each(supp_pt, function(k,v) {

            let _match = false;

            $.each(js_supplier_pt, function(k1, v1) {

                if( v.name == v1.name ) {
                    _match = true;
                    return;
                }

            });

            if(!_match) {
                // update
                    _for_update.push({
                    'name'          : v.name ,
                    'action'        : 'new'
                });

            }

        });

        $.each(js_supplier_pt, function(k,v) {

            let _match = false;

            $.each(supp_pt, function(k1, v1) {

                if( v.name == v1.name ) {
                    _match = true;
                    return;
                }

            });

            if(!_match) {
                // update
                    _for_update.push({
                    'name'          : v.name ,
                    'action'        : 'remove'
                });

            }

        });

        _sections.payment_terms = _for_update;

    }

</script>