@extends('admin.layouts.app')

@section('pagetitle')
    Manage Category
@endsection

@section('pagecss')
    <link href="{{ asset('lib/ion-rangeslider/css/ion.rangeSlider.min.css') }}" rel="stylesheet">
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
                        <li class="breadcrumb-item active" aria-current="page">Suppliers</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Manage Suppliers</h4>
            </div>
        </div>

        <div class="row row-sm">

            <!-- Start Filters -->
            <div class="col-md-12">


            	


            </div>

        </div>

    </div>
@endsection