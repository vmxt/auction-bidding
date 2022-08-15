@extends('admin.layouts.app')

@section('pagetitle')
    Manage Category
@endsection

@section('pagecss')
    <link href="{{ asset('lib/ion-rangeslider/css/ion.rangeSlider.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <style>
        .table {
            table-layout: fixed;
            word-wrap: break-word;
            /*border-collapse: separate;*/
            /*border-spacing:0 12px;*/
        }
        a.disabled {
            pointer-events: none;
            cursor: default;
            color: #272727;
        }
        .row-selected {
            background-color: #92b7da !important;
        }
    </style>
@endsection


@section('content')
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('dashboard')}}">CMS</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invite Supplier</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Invite Supplier</h4>
            </div>
        </div>

        <div class="row row-sm">

            <!-- Start Filters -->
            <div class="col-md-12">


            	<form autocomplete="off" action="{{ route('supplier-categories.store') }}" method="post">
                @method('POST')
                @csrf

                <div class="row row-sm">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Company Name <i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="250" name="name" id="name">
                            @hasError(['inputName' => 'name'])@endhasError
                        </div>
                        
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Company Address <i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" maxlength="250" name="address" id="address">
                            @hasError(['inputName' => 'address'])@endhasError
                        </div>

                        <div class="form-group">
                            <label for="text" class="d-block">Commodity: <i class="tx-danger">*</i></label>
                            <select class="form-control" required="required" multiple="multiple" id="commodities" name="commodities[]">
                              @forelse(\App\SupplierModels\SupplierCategoryMaster::orderBy('name')->get() as $c)
                                <option value="{{$c->name}}">{{$c->name}}</option>
                              @empty
                              @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Territory</label>
                            <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                <label class="btn btn-outline-secondary ls0 nott" for="new-application">
                                    <input type="radio" required="required" name="territory" autocomplete="off" value="Local"> Local
                                </label>
                                <label class="btn btn-outline-secondary ls0 nott" for="update-information">
                                    <input type="radio" required="required" name="territory" autocomplete="off" value="Global"> Global
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Contact Person<i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="250" name="name" id="name">
                            @hasError(['inputName' => 'name'])@endhasError
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Designation<i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="250" name="name" id="name">
                            @hasError(['inputName' => 'name'])@endhasError
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Email Address <i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="250" name="name" id="name">
                            @hasError(['inputName' => 'name'])@endhasError
                        </div>

                        <div class="form-group row">
                                    <label for="upload" class="col-sm-4 col-form-label">Insert product samples:</label>
                                    <div class="col-sm-8">
                                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary ls0 nott" for="uploadImg">
                                                <input type="radio" name="uploads" id="uploadImg" value="Upload Image" onclick="ShowHideDiv2()" 
                                                @if(old('uploads') == 'Upload Image') checked @endif> Attached Items
                                            </label>
                                            <label class="btn btn-outline-secondary ls0 nott" for="uploadURL">
                                                <input type="radio" name="uploads" id="uploadURL" value="Upload URL" onclick="ShowHideDiv2()"
                                                @if(old('uploads') == 'Upload URL') checked @endif> Insert URL
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="upURL" style="display:none">
                                    <div class="field_wrapper11">
                                        <div class="upload">
                                            <div class="form-group row">
                                                <label for="text" class="col-md-4 col-form-label">Product URL:</label>
                                                <div class="col-md-7 col-9">
                                                    <input type="text" name="product_url1" id="product_url1" class="form-control required url @error('product_url1') is-invalid @enderror" placeholder="https://" >
                                                    @hasError(['inputName' => 'product_url1'])@endhasError
                                                </div>
                                                <div class="col-md-1 col-3 text-right">
                                                    <a href="javascript:void(0);" class="remove_button11 btn btn-danger" title="Add field"><i class="icon-minus-circle"></i></a>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <a href="javascript:void(0);" class="add_button11 btn btn-success mt-2 btn-xs" title="Add field">Add Product <i class="icon-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="upIMG" style="display: none">
                                    <div class="row ">
                                        <div class="col-lg-8 bottommargin">
                                            <label class="small">Upload sample products, brochures, etc.</label><br>
                                            <input id="input-3" name="input2" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true">
                                            @hasError(['inputName' => 'input2'])@endhasError
                                        </div>
                                        <div class="col-lg-4 bottommargin">
                                            <label class="small">Description</label><br>
                                            <textarea name="prod_description" id="prod_description" class="form-control @error('prod_description') is-invalid @enderror" placeholder="Input product description, prices, sizes, etc." cols="30" rows="12"></textarea>
                                            @hasError(['inputName' => 'prod_description'])@endhasError
                                        </div>
                                    </div>         
                                </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary btn-uppercase">Save Category</button>
                <a href="{{ route('supplier-categories.index') }}" class="btn btn-outline-secondary btn-sm btn-uppercase">Cancel</a>
            </form>


            </div>

        </div>

    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript">
        
        jQuery(document).ready( function($){

            // Multiple Select
            $("#commodities").select2({
                placeholder: "Choose" ,
            });

        });

    </script>
@endsection