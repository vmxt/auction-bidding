@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/bs-filestyle.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/custom.css') }}" type="text/css" />
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
            <h1> Rejected Suppliers </h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('evaluator.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rejected Suppliers</li>                      
            </ol>
        </div>
    </section>

	<section id="content">
        <div class="content-wrap">
            <div class="container clearfix">  

            	<div class="col-md-12">

                <div class="filter-buttons mg-b-10">
                    <div class="d-md-flex bd-highlight">
                        <div class="bd-highlight mg-r-10 mg-t-10">
                            <h2>Rejected     Suppliers ({{$applicants->count() ?? 0}})</h2>
                        </div>
                        <div class="ml-auto bd-highlight mg-t-10">
                            <form class="form-inline" id="searchForm">
                                <div class="search-form mg-r-10">
                                    <input name="search" type="search" id="search" class="form-control"  placeholder="Search by Name" value="{{ $filter->search }}">
                                    <button class="btn filter" id="btnSearch"><i data-feather="search"></i></button>
                                </div>
                                {{-- @if (auth()->user()->has_access_to_route('supplier-categories.create'))
                                    <a class="btn btn-primary btn-sm mg-b-5" href="{{ route('supplier-categories.create') }}">Create a Category</a>
                                @endif --}}
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
	                <div class="table-list mg-b-10">
	                    <div class="table-responsive-lg">
	                        <table class="table mg-b-0 table-light table-hover table-striped" style="width:100%;">
	                            <thead>
	                            <tr>
	                                <th scope="col" width="30%">Company</th>
	                                <th scope="col" width="25%">Date Established</th>
	                                <th scope="col" width="20%">Date Approved</th>
                                    <th scope="col" width="10%">Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
	                            @forelse($applicants as $applicant)
	                                <tr id="row{{$applicant->supplier_id}}" class="row_cb">

	                                    <td><strong> {{ $applicant->company_name }} </strong></td>
	                                    <td><strong> {{ \Carbon\Carbon::parse($applicant->date_established)->toFormattedDateString() }} </strong></td>
	                                    <td><strong>
                                            @php
                                                $approval = \App\SupplierModels\Approvals::where('supplier_id', $applicant->supplier_id)->first();
                                                $last_step = \App\SupplierModels\ApproverSteps::where('approval_id', $approval->id)
                                                    ->where('status', 'Reject')->orderBy('sequence','DESC')->first();
                                            @endphp 
                                            {{ \Carbon\Carbon::parse($last_step->denied_date)->toFormattedDateString() }}
                                        </strong></td>
                                        <td class="text-left">
                                            <a href="{{route('sms.auth.profile.view',$applicant->supplier_id)}}" class="btn btn-success">Profile</a>
                                        </td>
	                                </tr>

	                            @empty
	                                <tr>
	                                    <th colspan="5" style="text-align: center;"> <p class="text-danger">No record found.</p></th>
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
        	                    @if ($applicants->firstItem() == null)
        	                        <p class="tx-gray-400 tx-12 d-inline">{{__('common.showing_zero_items')}}</p>
        	                    @else
        	                        <p class="tx-gray-400 tx-12 d-inline">Showing {{($applicants->firstItem() ?? 0)}} to {{($applicants->lastItem() ?? 0)}} of {{$applicants->total()}} items</p>
        	                    @endif
        	                </div>
        	            </div>
        	            <div class="col-md-6" style="display:none;">
        	                <div class="text-md-right float-md-right mg-t-5">
        	                    {{ $applicants->appends((array) $filter)->links() }}
        	                </div>
        	            </div>
                    </div>

                </div>


            </div>

            </div>
        </div>
    </section>

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
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/include/fileupload/image-uploader.min.js') }}"></script>
@endsection