<div class="table-responsive" style="max-height: 400px; overflow: auto;">
<table class="table">

	<thead>
		<tr>
			<td> User </td>
			<td> Received </td>
			<td> Processed </td>
			<td> Status </td>
			<td> Aging </td>
		</tr>
	</thead>

	<tbody>
		
		@forelse( $history as $h ) 
			@php
				$approver = \App\User::find($h->user_id);
				$approval_step = \App\SupplierModels\ApproverSteps::find($h->approval_step_id);
			@endphp

			@if( $loop->index  == 0 )
			<tr>
				<td>{{ $approver->first_name . " " . $approver->last_name  }} </td>
				<td>
					@if( $approval_step )	
						{{ \Carbon\Carbon::parse($approval_step->date_started)->format('Y-m-d g:i A') }}
					@else
						{{ \Carbon\Carbon::parse($h->created_at)->format('Y-m-d g:i A') }}
					@endif
				</td>
				<td>{{ $h->updated_at->format('Y-m-d g:i A') }}</td>
				<td>{{ $h->action }}</td>
				<td>
					@if( $approval_step )
						{{ \Carbon\Carbon::parse($approval_step->date_started)->diffForHumans() }}
					@else
						{{ \Carbon\Carbon::parse($h->created_at)->diffForHumans() }}
					@endif
				</td>
			</tr>
			@else
			<tr>
				<td>{{ $approver->first_name . " " . $approver->last_name  }} </td>
				<td>{{ \Carbon\Carbon::parse($history[$loop->index-1]->created_at)->format('Y-m-d g:i A') }}</td>
				<td>{{ $h->updated_at->format('Y-m-d g:i A') }}</td>
				<td>{{ $h->action }}</td>
				<td>{{ \Carbon\Carbon::parse($h->created_at)->diffForHumans() }}</td>
			</tr>
			@endif
		@empty

		@endforelse

	</tbody>
	
</table>
</div>