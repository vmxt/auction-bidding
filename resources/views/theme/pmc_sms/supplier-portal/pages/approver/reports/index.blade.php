@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('content')

    <section id="page-title" class="page-title-nobg">

        <div class="container clearfix">
            <h1>Reports</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
				<li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reports</li>  
            </ol>
        </div>

    </section>


    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">  

            	<div class="col-12" id="accordion">
            		
            		<h5 data-toggle="collapse" data-target="#psr" aria-expanded="true" aria-controls="psr">
            			List of Pending Supplier Registrations 
            		</h5>

            		<div id="psr" class="col-12 collapse show" aria-labelledby="psr" data-parent="#accordion">

            			<div class="table-responsive">

	            		<table class="table mg-b-0 table-light table-hover" style="width:100%;">
	            			
	            			<thead>
	                            <tr>
	                                <th scope="col">Date Applied</th>
	                                <th scope="col">Contact Person</th>
	                                <th scope="col">Company</th>
	                                <th scope="col">Status</th>
	                            </tr>
		                    </thead>

		                    <tbody>
		                    	
	                    		@forelse( $initial_regs as $initial )
		                    		<tr>
		                    			<td>{{ $initial->created_at->toDayDateTimeString() }}</td>
		                    			<td>{{ strtoupper($initial->contact_person) }} </td>
		                    			<td>{{ strtoupper($initial->name) }} </td>
		                    			<td>{{ $initial->status }} </td>
		                    		</tr>
	                    		@empty
	                    			<tr>
	                    				<td colspan="5" class="text-center"> No Initial Registration </td>
									</tr>
	                    		@endforelse

		                    </tbody>

	            		</table>

		            	</div>

	            	</div>

            		<hr> <br>

					<h5 data-toggle="collapse" data-target="#lsss" aria-expanded="true" aria-controls="lsss"> List of Suppliers where SIS is for submission </h5>

					<div class="col-12 collapse show" id="lsss" aria-labelledby="lsss" data-parent="#accordion">
						<div class="row">

							<div class="table-responsive">

		            		<table class="table mg-b-0 table-light table-hover" style="width:100%;">
		            			
		            			<thead>
		                            <tr>
		                                <th scope="col">Date Applied</th>
		                                <th scope="col">Contact Person</th>
		                                <th scope="col">Company</th>
		                            </tr>
			                    </thead>

			                    <tbody>
			                    	
		                    		@forelse( $sis_submission as $sis )
		                    			@php
		                    				$supplier = $sis->user_obj;		                    			
		                    				//$supplier = \App\User::find($sis->supplier_id);
		                    			@endphp
			                    		<tr>
			                    			<td>{{ $sis->created_at->toDayDateTimeString() }}</td>
			                    			<td>{{ strtoupper($supplier->first_name) ." ". strtoupper($supplier->last_name) }} </td>
			                    			<td>{{ strtoupper($sis->name) }} </td>
			                    		</tr>
		                    		@empty
		                    			<tr>
		                    				<td colspan="5" class="text-center"> No SIS submission </td>
										</tr>
		                    		@endforelse

			                    </tbody>

		            		</table>

			            	</div>

		            	</div>
		            </div>

            		<hr> <br>

					<h5 data-toggle="collapse" data-target="#lsa" aria-expanded="true" aria-controls="lsa"> List of Suppliers for Approval </h5>

					<div class="col-12 collapse show" id="lsa" aria-labelledby="lsa" data-parent="#accordion">
						<div class="row">		

							<div class="table-responsive">

		            		<table class="table mg-b-0 table-light table-hover" style="width:100%;">
		            			
		            			<thead>
		                            <tr>
		                                <th scope="col">Date Submitted</th>		                                
		                                <th scope="col">Company</th>
		                                <th scope="col">Last Updated</th>
		                                <th scope="col">Current Status</th>
		                                <th scope="col">Current Approver</th>
		                            </tr>
			                    </thead>

			                    <tbody>

		                    		@forelse( $for_approvals as $approval )

		                    			@php
		                    				$approver = \App\User::find($approval->current_approver->approver_id); 
		                    				$supplier = \App\User::find($approval->supplier_id); 
		                    				$_approval = \App\SupplierModels\Approvals::where('supplier_id', $supplier->id)
		                    					->first();
		                    				$_step = \App\SupplierModels\ApproverSteps::where('approval_id', $_approval->id)
		                    					->where('is_current', 1)->first();
		                    			@endphp

			                    		<tr>
			                    			<td>{{ $_approval->created_at->toDayDateTimeString() }}</td>
			                    			<td>
			                    				<a href="{{route('sms.auth.profile.view',$supplier->id)}}" target="_blank"> 
				                    				{{ strtoupper($approval->company_name) }} 
				                    			</a>
				                    		</td>			                    			
			                    			<td>
			                    				{{ $_step->updated_at->toDayDateTimeString() }}
			                    			</td>
			                    			<td>
			                    				{{ $_step->status }}
			                    			</td>
			                    			<td>
			                    				Approver {{ strtoupper($approval->current_approver->sequence) }}
			                    				(<a href="javascript:void(0);" class="btn-history" data-id="{{ $approval->supplier_id }}"> {{$approver->first_name ." ". $approver->last_name}} </a>) 
			                    			</td>
			                    		</tr>
		                    		@empty
		                    			<tr>
		                    				<td colspan="5" class="text-center"> No SIS submission </td>
										</tr>
		                    		@endforelse

			                    </tbody>

		            		</table>

			            	</div>

		            	</div>
		            </div>

            		<hr> <br>

					<h5 data-toggle="collapse" data-target="#las" aria-expanded="true" aria-controls="las"> List of Approved Suppliers </h5>

					<div class="col-12 collapse show" id="las" aria-labelledby="las" data-parent="#accordion">
						<div class="row">

							<div class="table-responsive">

		            		<table class="table mg-b-0 table-light table-hover" style="width:100%;">
		            			
		            			<thead>
		                            <tr>
		                                <th scope="col">Date Approved</th>
		                                <th scope="col">Contact Person</th>
		                                <th scope="col">Company</th>
		                            </tr>
			                    </thead>

			                    <tbody>
			                    	
		                    		@forelse( $active_suppliers as $approval )

		                    			@php
		                    				$supplier = \App\User::find($approval->supplier_id);
		                    			@endphp

			                    		<tr>
			                    			<td>{{ $approval->created_at->toDayDateTimeString() }}</td>
			                    			<td>
			                    				<a href="{{route('sms.auth.profile.view',$supplier->id)}}" target="_blank">
				                    				{{ strtoupper($supplier->first_name) ." ". strtoupper($supplier->last_name) }} 
				                    			</a>
				                    		</td>
			                    			<td>
			                    				<a href="{{route('sms.auth.profile.view',$supplier->id)}}" target="_blank">
				                    				{{ strtoupper($approval->company_name) }} 
				                    			</a>
				                    		</td>	                    			
			                    		</tr>
		                    		@empty
		                    			<tr>
		                    				<td colspan="5" class="text-center"> No Approved Supplier </td>
										</tr>
		                    		@endforelse

			                    </tbody>

		            		</table>

			            	</div>

		            	</div>
	            	</div>

            	</div>

            </div>
        </div>
    </section>

    <!-- Modal -->
	<div class="modal fade" id="approval-history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Approval History</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body" id="history-body">

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>

		</div>
		</div>
	</div>

@endsection

@section('pagejs')

	<script type="text/javascript">
			
		$(document).on('click', '.btn-history', function() {

			let supplier_id = $(this).data('id');

			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: { supplier: supplier_id},
                type: "get",
                url: "{{ route('approver.show-history') }}" ,
               
                success: function(r) {
                	console.log(r);
                    $('#history-body').html(r);
                    $('#approval-history').modal('show');
                }
            });

		});

	</script>

@endsection