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
                                            <td colspan="5" class="text-center"> No Active Supplier </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                            </div>

                        </div>
                    </div>

            	</div>

            	<div class="col-md-12">

                    <div class="row">
        	            <div class="col-md-6">
        	                <div class="mg-t-5">
        	                    @if ($active_suppliers->firstItem() == null)
        	                        <p class="tx-gray-400 tx-12 d-inline">{{__('common.showing_zero_items')}}</p>
        	                    @else
        	                        <p class="tx-gray-400 tx-12 d-inline">Showing {{($active_suppliers->firstItem() ?? 0)}} to {{($active_suppliers->lastItem() ?? 0)}} of {{$active_suppliers->total()}} items</p>
        	                    @endif
        	                </div>
        	            </div>
        	            <div class="col-md-6">
        	                <div class="text-md-right float-md-right mg-t-5">
        	                    {{ $active_suppliers->links() }}
        	                </div>
        	            </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
