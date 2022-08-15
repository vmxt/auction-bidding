<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">Profile</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="profile_body">
	<table class="table-sm" style="font-size:15px;">
		<tr>
			<td>Name:</td>
			<td>{{$supplier->name}}</td>
		</tr>
		<tr>
			<td>Address:</td>
			<td>{{$supplier->address}}</td>
		</tr>
		<tr>
			<td>Territory:</td>
			<td>{{$supplier->territory}}</td>
		</tr>
		<tr>
			<td>Contact Person:</td>
			<td>{{$supplier->contact_person}} ({{$supplier->designation}})</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{$supplier->email}}</td>
		</tr>

		@if(!is_null($supplier->contact_person1) && $supplier->contact_person1 != '' )

		<tr>
			<td>Contact Person 1:</td>
			<td>{{$supplier->contact_person1}} ({{$supplier->designation1}})</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{$supplier->email1}}</td>
		</tr>

		@endif

		@if(!is_null($supplier->contact_person2) && $supplier->contact_person2 != '' )
		
		<tr>
			<td>Contact Person 2:</td>
			<td>{{$supplier->contact_person2}} ({{$supplier->designation2}})</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{$supplier->email2}}</td>
		</tr>

		@endif

		@if(!is_null($supplier->contact_person3) && $supplier->contact_person3 != '' )
		<tr>
			<td>Contact Person 3:</td>
			<td>{{$supplier->contact_person3}} ({{$supplier->designation3}})</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{$supplier->email3}}</td>
		</tr>
		@endif

		@if(!is_null($supplier->contact_person4) && $supplier->contact_person4 != '' )
		<tr>
			<td>Contact Person 4:</td>
			<td>{{$supplier->contact_person4}} ({{$supplier->designation4}})</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{$supplier->email4}}</td>
		</tr>
		@endif
		

		<tr>
			<td>Status:</td>
			<td>{{ $supplier->status == 'Approved' ? 'Screened' : $supplier->status }}</td>
		</tr>
		@if($supplier->status != 'Pending')
		<tr>
			<td>Remarks:</td>
			<td>{{$supplier->remarks}}</td>
		</tr>
		@endif
		<tr>
			<td valign="top">Commodities:</td>
			<td><br>
				<ul>
					@if($supplier->commodities)
						@forelse(explode("|", $supplier->commodities) as $c)
							<li>{{$c}}</li>
						@empty
						@endforelse
					@endif
				</ul>
				
		</tr>
		<tr>
			<td valign="top">Sample Products:</td>
			<td>
				@if(count($supplier->products))
					@if(!is_null($supplier->products->first()->description))
						@php 
							$pl = $supplier->products->first()->description;
							$pl = explode(",", $pl);
						@endphp
						<br>
						@foreach( $pl as $product )
							<p>{{ $product }}</p>
						@endforeach
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td>
				<label for="form-check-label">
					<input type="checkbox" name="one_time" value="1" id="one-time"> One Time Transaction 
				</label>
			</td>
		</tr>
		
	</table>
	<form method="POST" name="approve_form" id="approve_form" action="{{route('supplier-applicants.approve')}}">
		@csrf
		<input type="hidden" value="{{$supplier->id}}" name="supplier_id">
		<input type="hidden" id="hidden_action" name="hidden_action">
		<input type="hidden" id="remarks_hidden" name="remarks">
		<input type="hidden" id="is_one_time" name="is_one_time" value="0">
	</form>
</div>
<div class="modal-footer">
	<div class="col-md-12 text-right">
	@if($supplier->Hasaccount == 0)
		@if($supplier->status == 'Pending' )
			<a href="javascript:void(0)" onclick="showRemarksField(this);" class="btn btn-success" actionn="approve"><i class="fa fa-thumbs-up"></i> Approve</a>
			<a href="javascript:void(0);" onclick="showRemarksField(this);" class="btn btn-warning" id="disapprove_link" data-action="{{route('supplier-applicants.disapprove', $supplier->id)}}"><i class="fa fa-thumbs-down"></i> Disapprove</a>
		@endif

	@endif

	@if($supplier->status == 'Approved' && $supplier->Hasaccount != 0)

		<h5 class="d-block">Screened By: {{ $supplier->approved_by }}</h5>
		<h5 class="d-block">Date: {{ \Carbon\Carbon::parse($supplier->approved_time)->toDateTimeString() }}</h5>

	@endif

	@if($supplier->status == 'Disapproved')

		<h5 class="d-block">Disapproved By: {{ $supplier->disapproved_by }}</h5>
		<h5 class="d-block">Disapproved Date: {{ \Carbon\Carbon::parse($supplier->disapproved_time)->toDateTimeString() }}</h5>

	@endif

		<a href="mailto:{{$supplier->email}}" class="btn btn-info"><i class="fa fa-envelope"></i> Email</a>
	</div>
</div>
        