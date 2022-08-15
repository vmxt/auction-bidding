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
            <h1> Approved Applicants </h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Approved Applicants</li>                      
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
                            <h2>Approved Applications ({{$applicants->count() ?? 0}})</h2>
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
                                    <th>Name</th>
                                    <th>Applied Date</th>
                                    <th>Date Approved</th>
                                    <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
	                            @forelse($applicants as $applicant)

	                                <tr id="row{{$applicant->id}}" class="row_cb">
	                                    <td> {{ strtoupper($applicant->name) }} </td>
                                        <td> {{ $applicant->created_at->toFormattedDateString() }} <br> ({{ $applicant->created_at->diffForHumans() }}) </td>
                                        <td> {{ $applicant->approved_time->toFormattedDateString() }} </td>
                                        <td>
                                            <button class="btn btn-primary send-m" onclick="show_profile({{$applicant->id}});">View Application Details</button>
                                            @if($applicant->has_account)
                                                <a href="{{route('sms.auth.profile.view',$applicant->user_obj->id)}}" class="btn btn-success">View Supplier Profile</a>
                                            @endif
                                        </td>
	                                </tr>

	                            @empty
	                                <tr>
	                                    <th colspan="7" style="text-align: center;"> <p class="text-danger">No record found.</p></th>
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

        	            <div class="col-md-6">
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

    <div class="modal effect-scale" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="profile_body">
                
            </div>
        </div>
    </div>

@endsection


@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/include/fileupload/image-uploader.min.js') }}"></script>

    <script type="text/javascript">
        
        function show_profile(i){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: { supplier: i},
                type: "get",
                url: "{{ route('supplier-applicants.profile') }}"+'/'+i,
               
                success: function(r) {
                    $('#profile_body').html(r);
                    $('#profile').modal('show');
                }
            });
            
        }

    </script>
@endsection