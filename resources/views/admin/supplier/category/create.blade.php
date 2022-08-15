@extends('admin.layouts.app')

@section('pagetitle')
    Category Management
@endsection

@section('pagecss')
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
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('supplier-categories.index')}}">Supplier Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Supplier Category</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Create Supplier Category</h4>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <form autocomplete="off" action="{{ route('supplier-categories.store') }}" method="post">
                @method('POST')
                @csrf
                <div class="row row-sm">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="d-block">Name <i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="250" name="name" id="name">
                            @hasError(['inputName' => 'name'])@endhasError
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Description <i class="tx-danger">*</i></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description"></textarea>
                            @hasError(['inputName' => 'description'])@endhasError
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Parent Category</label>
                            <select class="custom-select select2 @error('parent') is-invalid @enderror" name="parent" id="parent">
                                <option selected value="">- Select -</option>
                                @forelse(\App\SupplierModels\SupplierCategoryMaster::where('parent_id',0)->get() as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            @hasError(['inputName' => 'parent'])@endhasError
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

@section('customjs')
    <script>

        $('#name').focusout(function() {
            var name = $('#name').val();
            $('#parent > option').each(function(){
                if( name == this.text ) {
                    alert('Sorry! the name you inputed already exist as parent category');
                    $(this).hide();
                    return false;
                } else {
                    $(this).show();
                }
            });

        });

        $('#parent').change(function() {
            var name = $('#name').val();
            $('#parent > option').each(function(){
                if( name == this.text ) {
                    alert('Sorry! the name you inputed already exist as parent category');
                    $(this).hide();
                    return false;
                } else {
                    $(this).show();
                }
            });
        });

    </script>
@endsection
