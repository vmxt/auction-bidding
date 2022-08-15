@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
@endsection

@section('content')

    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Messages</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('sms.auth.profile.view', \Auth()->user()->id) }}">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Messages</li>                      
            </ol>
        </div>
    </section>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

            	<div class="col-md-12">
	                <div class="table-list mg-b-10">
	                    <div class="table-responsive-lg">
	                        <table class="table mg-b-0 table-light table-hover" style="width:100%;">
	                            <thead>
		                            <tr>
		                                <th scope="col" width="25%">From</th>
		                                <th scope="col" width="50%">Last Message</th>
		                                <th scope="col" width="25%">Action</th>
		                            </tr>
	                            </thead>
	                            <tbody>
	                            	@forelse($messages as $message)
	                            		@foreach($message as $m)
	                            		@if($loop->first)
	                            		<tr>
	                            			<td> {{ $m->from }} </td>
	                            			<td> {{ $m->created_at->toDayDateTimeString() }} </td>
	                            			<td> 
                                                <button class="btn btn-primary send-m" data-to="{{$m->from}}">Message</button>
                                                <a class="btn btn-success" href="#" onclick="show_convo('{{$m->from}}');" title="View Profile">View Convo</a> 
                                            </td>
	                            		</tr>
	                            		@endif                                            
	                            		@endforeach
	                            	@empty
                                        <tr>
                                            <th colspan="3" style="text-align: center;"> <p class="text-danger">No record found.</p></th>
                                        </tr>
	                            	@endif
	                            </tbody>
	                        </table>

	                    </div>

	                </div>

	            </div>

        	</div>

        </div>

    </section>

    <div class="modal effect-scale" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="profile_body" style="height: 50vh; overflow-y: auto;">
                

            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="send-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Message Supplier Directly</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="to">To</label>
                        <input type="text" name="to" id="to" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" rows="5" id="message"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success" id="btnSend">Send</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('pagejs')

	<script type="text/javascript">

		function show_convo(i){
			var url = "{{ env('APP_URL') }}" +"/sp/message/"+i+"/convo";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: url,
               
                success: function(r) {
                    $('#profile_body').html(r);
                    $('#profile').modal('show');
                }
            });
            
        }
        
        $('.send-m').click(function(){
                
            $('#send-message').modal('show');
            $('#to').val($(this).data('to'));

        });

        $('#btnSend').click(function() {

            var data = {
                to : $('#to').val() ,
                from: "{!! auth()->user()->email !!}" ,
                message: $('#message').val()
            };

            sendMessage(data);

        });
        
        function sendMessage(data) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: data,
                type: "POST",
                url: "{{ route('sms.message') }}",
               
                success: function(r) {

                    if(r.status=="success")
                    {
                        alert(r.message);
                        $('#to').val("");
                        $('#message').val("");
                        $('#send-message').modal('hide');
                    }

                }
            });

        }     
	</script>

@endsection