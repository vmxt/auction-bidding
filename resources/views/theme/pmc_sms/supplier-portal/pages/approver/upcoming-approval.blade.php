@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
            <h1> Upcoming Applications </h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upcoming Applications</li>                      
            </ol>
        </div>
    </section>

	<section id="content">
        <div class="content-wrap">
            <div class="container clearfix">  

            	<div class="col-md-12">
                    <div style="margin-bottom: 30px;">
                        <small><span id="note"> Legend: </span> 
                            <span id="supp-legend-f" class="supp-legend" style="background: #007bff;"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span>Approved
                            <span id="supp-legend-s" class="supp-legend" style="background: #ffff00;"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span>Pending
                            <span id="supp-legend-t" class="supp-legend" style="background: #6c757d;"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span><span id="legend-hold">Hold</span>
                            <span id="supp-legend-fo" class="supp-legend" style="background: #dc3545;"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span>Reject
                        </small>
                    </div>
                <div class="filter-buttons mg-b-10">
                    <div class="d-md-flex bd-highlight">
                        <div class="bd-highlight mg-r-10 mg-t-10">
                            <h2>Upcoming Supplier Applications ({{$applicants->count() ?? 0}})</h2>
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
	                        <table class="table mg-b-0 table-light table-hover table-bordered" style="width:100%;">                                
                                <thead>
                                <tr>
                                    <th scope="col" width="26%" >Company</th>
                                    <th scope="col" width="18%" colspan="3" class="text-center">MCD</th>
                                    <th scope="col" width="18%" colspan="3" class="text-center">Accounting</th>
                                    <th scope="col" width="6%" class="text-center">ABD</th>
                                    <th scope="col" width="6%" class="text-center">RCV</th>
                                    <th scope="col" width="26%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($applicants as $applicant)
                                    @php
                                        $approver_seq = \App\SupplierModels\ApproverSteps::where('approval_id', $applicant->approval_id)->get();
                                        $curr_app = \App\SupplierModels\ApproverSteps::where('approval_id', $applicant->approval_id)
                                            ->where('is_current', 1)->first();
                                    @endphp
                                   
                                    <tr id="row{{$applicant->approval->supplier->id}}" class="row_cb">
                                        
                                        <td>
                                            <strong> 
                                                {{ strtoupper($applicant->approval->supplier_details->company_name) }} 
                                                @if(!is_null($applicant->approval->supplier_details->code))
                                                    - <span class="badge badge-primary mr-2"> {{ $applicant->approval->supplier_details->code }} </span>
                                                @else    
                                                    - <span class="badge badge-danger mr-2"> NEW </span>
                                                @endif
                                                @if($applicant->approval->supplier_details->is_one_time == 1 && $applicant->approval->supplier_details->apply_as_permanent == 0)                                                   
                                                    <span class="badge badge-warning mr-2" style="background-color:purple; color: white; font-weight: 900;">ONE TIME SUPPLIER</span>
                                                @elseif($applicant->approval->supplier_details->is_one_time == 1 && $applicant->approval->supplier_details->apply_as_permanent == 1)                                                   
                                                    <span class="badge badge-warning mr-2" style="background-color:purple; color: white; font-weight: 900;">APPYLING AS REGULAR SUPPLIER</span>
                                                @endif
                                            </strong>
                                        </td>
                                        
                                        @foreach($approver_seq as $seq)

                                            @if($seq->sequence <= $curr_app->sequence)
                                                @if($seq->status == 'Approved')
                                                    <td style="background: #007bff; color: #ffffff;" width="6%" class="text-center">
                                                        <i class="fas fa-thumbs-up"></i>
                                                    </td>
                                                @elseif($seq->status == 'Hold')
                                                    <td style="background: #444; color: #ffffff;" width="6%" class="text-center">
                                                        <i class="fas fa-hand-paper"></i>
                                                    </td>
                                                @elseif($seq->status == 'Pending')
                                                    <td style="background: #ffff00; color: #ffffff;" width="6%">
                                                        
                                                    </td>
                                                @else
                                                    <td style="background: #dc3545; color: #ffffff;" class="text-center" width="6%">
                                                        <i class="fas fa-thumbs-down"></i>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif

                                        @endforeach
                                        @if(count($approver_seq)<8)
                                            <td><strong>N/a</strong></td>
                                            <td><strong>N/a</strong></td>
                                        @endif
                                        <td style="display:flex; justify-content: center;">
                                            
                                            <button data-to="{{$applicant->approval->supplier->email}}" class="btn btn-primary send-m btn-sm mb-1 mr-1">
                                                <span class="d-md-none d-block">
                                                    <i class="icon-note"></i>
                                                </span>
                                                <span class="d-none d-md-block">Message</span>
                                            </button>

                                            <a href="{{route('sms.auth.profile.view',$applicant->approval->supplier->id)}}" 
                                                class="btn btn-success btn-sm mb-1">
                                                <span class="d-md-none d-block">
                                                    <i class="icon-user"></i>
                                                </span>
                                                <span class="d-none d-md-block">Profile</span>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="10" style="text-align: center;"> <p class="text-danger">No record found.</p></th>
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

@endsection


@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/include/fileupload/image-uploader.min.js') }}"></script>

    <script>

        jQuery(document).ready( function($){

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
                url: "{{ route('approver.message') }}",
               
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