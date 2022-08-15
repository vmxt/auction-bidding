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
            		
            		<h5 class="text-center mb-5"> List of Suppliers where SIS is for submission </h5>

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

            	</div>

            	<div class="col-md-12">

                    <div class="row">
        	            <div class="col-md-6">
        	                <div class="mg-t-5">
        	                    @if ($sis_submission->firstItem() == null)
        	                        <p class="tx-gray-400 tx-12 d-inline">{{__('common.showing_zero_items')}}</p>
        	                    @else
        	                        <p class="tx-gray-400 tx-12 d-inline">Showing {{($sis_submission->firstItem() ?? 0)}} to {{($sis_submission->lastItem() ?? 0)}} of {{$sis_submission->total()}} items</p>
        	                    @endif
        	                </div>
        	            </div>
        	            <div class="col-md-6">
        	                <div class="text-md-right float-md-right mg-t-5">
        	                    {{ $sis_submission->links() }}
        	                </div>
        	            </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
