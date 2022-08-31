@extends('theme.pmc_sms.main.main')
@section('content')
    @include('partials.page-title', [
        'title' => isset($company) ? 'Edit Company: ' . $company->name : 'Create A Company',
        'subtitle' => 'A Short Page Title Tagline'
    ])
    
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div class="form-widget">
                    <div class="form-result"></div>

                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            <form class="row mb-0" id="" action="{{ isset($company) ? route('company.update', $company->id) : route('company.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (isset($company))
                                    @method('PUT')
                                @else
                                    @method('POST')
                                @endif

                                <!--<div class="form-process">
                                    <div class="css3-spinner">
                                        <div class="css3-spinner-scaler"></div>
                                    </div>
                                </div>-->
                                <div class="col-12 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="">Company Name:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" id="" class="form-control required" value="{{ isset($company) ? $company->name : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="">Office Address:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea  type="" name="office_address" id="" class="form-control required" value="" rows="6" cols="30">{{ isset($company) ? $company->office_address : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="">Contact Person:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="contact_person" id="" class="form-control required" value="{{ isset($company) ? $company->contact_person : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="">Contact Number:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="contact_number" id="" class="form-control required" value="{{ isset($company) ? $company->contact_number : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="">Mobile Number:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="mobile_number" id="" class="form-control required" value="{{ isset($company) ? $company->mobile_number : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="">Email Address:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" name="email_address" id="" class="form-control required" value="{{ isset($company) ? $company->email_address : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="fitness-form-submit" class="btn btn-success">Save Company</button>
                                    <a href="{{ route('company.index') }}" id="calories-trigger" class="btn btn-secondary valid">Cancel</a>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                
            </div>
        </div>
    </section>
@endsection