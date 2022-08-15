@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
	<style type="text/css">
        
        .page-item.active .page-link, .page-link:hover, .page-link:focus {
            background: #007bff !important;
            border-color: #007bff !important;
        }

        .page-link {
            background: #ffffff !important;
            border-color: #ffffff !important;
        }

    </style>
@endsection

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

            	<div class="col-12">
            		
            		<h5 class="text-center mb-5"> List of Pending Supplier Registrations </h5>

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

            	</div>

            	<div class="col-md-12">

                    <div class="row">
        	            <div class="col-md-6">
        	                <div class="mg-t-5">
        	                    @if ($initial_regs->firstItem() == null)
        	                        <p class="tx-gray-400 tx-12 d-inline">{{__('common.showing_zero_items')}}</p>
        	                    @else
        	                        <p class="tx-gray-400 tx-12 d-inline">Showing {{($initial_regs->firstItem() ?? 0)}} to {{($initial_regs->lastItem() ?? 0)}} of {{$initial_regs->total()}} items</p>
        	                    @endif
        	                </div>
        	            </div>
        	            <div class="col-md-6">
        	                <div class="text-md-right float-md-right mg-t-5">
        	                    {{ $initial_regs->links() }}
        	                </div>
        	            </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
