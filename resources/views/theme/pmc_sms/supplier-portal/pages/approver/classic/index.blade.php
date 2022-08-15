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
            <h1> Suppliers From Classic  </h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Suppliers From Classic</li>                      
            </ol>
        </div>
    </section>

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">  

            	<div class="filter-buttons mg-b-10">
                    <div class="d-md-flex bd-highlight">
                        <div class="bd-highlight mg-r-10 mg-t-10">
                            <h5>Suppliers From Classic ( {{ $suppliers->total() }} )</h5>
                        </div>
                        <div class="ml-auto bd-highlight mg-t-10">
                            <form class="form-inline" id="searchForm">
                                <div class="search-form mg-r-10">
                                    <input name="search" type="search" id="search" class="form-control"  placeholder="Search by Name">
                                    <button class="btn filter" id="btnSearch"><i data-feather="search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="float-right">
                	<button class="btn btn-primary" id="upload-classic"> Upload Classic Data </button>
                </div>

                <div class="clearfix"></div>


                <div class="col-md-12">
                    <div class="table-list mg-b-10">
                        <div class="table-responsive-lg">
                            <table class="table mg-b-0 table-light table-hover table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th scope="col" width="30%">Company</th>
                                    <th scope="col" width="25%">Vendor Code</th>
                                    <th scope="col" width="20%">Date Entered</th>
                                    <th scope="col" width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($suppliers as $supplier)
                                    <tr id="row{{$supplier->supplier_id}}" class="row_cb">

                                        <td><strong> {{ strtoupper($supplier->company_name) }} </strong></td>
                                        <td><strong> {{ strtoupper($supplier->code) }} </strong></td>
                                        <td><strong> {{ \Carbon\Carbon::parse($supplier->created_at)->toFormattedDateString() }}
                                        </strong></td>
                                        <td class="text-left">
                                            <a target="_blank" href="{{route('sms.auth.profile.view',$supplier->supplier_id)}}" class="btn btn-success">Profile</a>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <th colspan="5" style="text-align: center;"> <p class="text-danger">No records found.</p></th>
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
                                @if ($suppliers->firstItem() == null)
                                    <p class="tx-gray-400 tx-12 d-inline">{{__('common.showing_zero_items')}}</p>
                                @else
                                    <p class="tx-gray-400 tx-12 d-inline">Showing {{($suppliers->firstItem() ?? 0)}} to {{($suppliers->lastItem() ?? 0)}} of {{$suppliers->total()}} items</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right float-md-right mg-t-5">
                                {{ $suppliers->appends((array) $filter)->links() }}
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </section>

    <div class="modal effect-scale" id="classic-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Upload Classic Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
  					<form action="{{ route('approver.classic-post-data') }}" method="POST" 
  						id="classic-form" enctype="multipart/form-data" >
  						@csrf 
	                	<input type="file" name="classic" id="classic" />
	                </form>
                </div>                    

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger btn-upload-classic-data">Upload</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('pagejs')
	
	<script type="text/javascript">
		
		$(document).on('click', '#upload-classic', function(){

			$('#classic-data').modal('show');

		});

		$(document).on('click', '.btn-upload-classic-data', function (){

			$('#classic-form').submit();

		});

	</script>

@endsection