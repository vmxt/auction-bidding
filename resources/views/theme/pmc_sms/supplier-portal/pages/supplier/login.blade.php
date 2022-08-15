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
            <h1>Supplier Login</h1>
            <span>Philsaga Mining Corporation</span>
            <ol class="breadcrumb">             
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Supplier Login</a></li>                      
            </ol>
        </div>
    </section>
@endif

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">                    
                <div class="row">

                    <div class="col-lg-6 offset-lg-3">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email <i class="tx-danger">*</i> </label>
                                <input required type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>

                            <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Password <i class="tx-danger">*</i> </label>
                                <input required type="password" id="password" name="password" class="form-control" >
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                            
                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Sign In</button>
                                    <a href="{{route('password.request')}}" class="btn btn-info btn-sm">Forgot Password</a>
                                </div>
                                <div class="text-center">
                                    <p> Don`t have an account yet? <a href="{{ route('sp.register') }}"> sign up here </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>                
            </div>

        </div>

    </section>
    
   
@endsection


