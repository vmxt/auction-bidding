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
            <h1> Settings </h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>                      
            </ol>
        </div>
    </section>

	<section id="content">
        <div class="content-wrap">
            <div class="container clearfix">  

                <div class="col-md-12">
                    <form method="POST" action="{{ route('approver.post-settings') }}">
                        @csrf
	                <div class="table-list mg-b-10">
	                    <div class="table-responsive-lg">
	                        <table class="table mg-b-0 table-light" style="width:100%;">
	                            
                                <tbody>
                                    <tr>
                                        <td>Receive Email Notifications for new supplier applications</td>
                                        <td><input type="checkbox" name="notif_for_new_suppliers" @if($setting? $setting->notif_for_new_suppliers : false) checked @endif value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Receive Email notifications monthly for my unapproved requests</td>
                                        <td><input type="checkbox" name="notif_for_monthly_unapproved_request" @if($setting ? $setting->notif_for_monthly_unapproved_request : false) checked @endif value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Automatically forward request to my next approver if I didn't respond in 2 days</td>
                                        <td><input type="checkbox" name="notif_to_forward_request_to_next_approver" @if($setting ? $setting->notif_to_forward_request_to_next_approver : false) checked @endif value="1"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="submit" class="btn btn-primary pull-right"> Save </button></td>
                                    </tr>
                                </tbody>

	                        </table>
	                    </div>
	                </div>

                    </form>
	            </div>
            
            </div>
        </div>
    </section>

@endsection


@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/include/fileupload/image-uploader.min.js') }}"></script>
@endsection