@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/bs-filestyle.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/custom.css') }}" type="text/css" />
@endsection

@section('content')
@if(!Session::has('success'))
    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Change Password</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>                      
            </ol>
        </div>
    </section>
@endif

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">    
                @if(Session::has('error'))
                    
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Incorrect username or password..
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="row">

                        <div class="col-lg-6 offset-lg-3">  
                            <form method="POST" action="{{ route('approver.password-update') }}">
                                @csrf
                                
                                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="password">Current Password <i class="tx-danger">*</i></label>
                                    <input required type="password" id="password" name="current_password" class="form-control" >
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                </div>

                                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="password">New Password <i class="tx-danger">*</i></label>
                                    <input required type="password" id="password" name="password" class="form-control" >
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                </div>

                                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="password">Confirm New Password <i class="tx-danger">*</i></label>
                                    <input required type="password" id="password" name="confirm_password" class="form-control" >
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                </div>

                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        <a href="{{route('password.request')}}" class="btn btn-info btn-sm">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
         
                
            </div>

        </div>

    </section>
    
   
@endsection

@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/include/fileupload/image-uploader.min.js') }}"></script>

    <script>

        jQuery(document).ready( function($){

            // Multiple Select
            $("#commodities").select2({
                placeholder: "Choose"
            });


            
        });
       

    </script>
@endsection


