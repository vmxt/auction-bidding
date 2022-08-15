@extends('admin.layouts.app')

@section('pagetitle')
    Category Management
@endsection

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <style>
        #errorMessage {
            list-style-type: none;
            padding: 0;
            margin-bottom: 0px;
        }
    </style>
@endsection

@section('content')
<div class="container pd-x-0">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('dashboard')}}">CMS</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('approver-steps.index')}}">Approver Template</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Approver Step</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Edit Approver Step</h4>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <form autocomplete="off" action="{{ route('approver-steps.update', $step->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row row-sm">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Approver <i class="tx-danger">*</i></label>
                            <select class="form-control @error('approver') is-invalid @enderror" name="approver" id="approver">
                                @foreach($approvers as $approver)
                                    <option value="{{$approver->id}}" @if($approver->id == $step->approver_id) selected @endif>{{$approver->username}}</option>
                                @endforeach
                            </select>
                            @hasError(['inputName' => 'approver'])@endhasError
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Approver Sequence</label>
                            <select class="custom-select select2 @error('sequence') is-invalid @enderror" name="sequence" id="sequence">
                                @for( $x = 1; $x <= 10; $x++)
                                    <option value="{{$x}}" @if($x == $step->sequence_no) selected @endif>{{ $x }}</option>
                                @endfor
                            </select>
                            @hasError(['inputName' => 'sequence'])@endhasError
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Override Sequence</label>
                            <select class="custom-select select2 @error('overridable') is-invalid @enderror" name="overridable[]" id="overridable" multiple>
                                @php
                                    $exploded_overridable = explode(",", $step->overridable);
                                @endphp 
                                @for( $x = 1; $x <= 10; $x++)
                                    <option value="{{$x}}" @if(in_array($x, $exploded_overridable)) selected @endif>{{ $x }}</option>
                                @endfor
                            </select>
                            @hasError(['inputName' => 'overridable'])@endhasError
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary btn-uppercase">Update Template Step</button>
                <a href="{{ route('approver-steps.index') }}" class="btn btn-outline-secondary btn-sm btn-uppercase">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customjs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script>

        $("#overridable").select2({
            placeholder: "Choose" ,
        });
        
    </script>
@endsection
