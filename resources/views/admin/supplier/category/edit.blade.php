@extends('admin.layouts.app')

@section('pagetitle')
    Category Management
@endsection

@section('content')
<div class="container pd-x-0">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('dashboard')}}">CMS</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('supplier-categories.index')}}">Supplier Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Supplier Category</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Edit Supplier Category</h4>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <form autocomplete="off" action="{{ route('supplier-categories.update', $supplier->id) }}" method="post">
                @method('PUT')
                @csrf

                <div class="row row-sm">
                    <div class="col-sm-6">
                        <div class="form-group">

                            <label for="formGroupExampleInput" class="d-block">Name <i class="tx-danger">*</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="250" name="name" value="{{$supplier->name}}" id="name">
                            @hasError(['inputName' => 'name'])@endhasError
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Description <i class="tx-danger">*</i></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description">{!!$supplier->description!!}</textarea>
                            @hasError(['inputName' => 'description'])@endhasError
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="d-block">Parent Category</label>
                            <select class="custom-select select2" name="parent" id="parent">
                                <option value="">- Select -</option>
                                @forelse(\App\SupplierModels\SupplierCategoryMaster::where('parent_id',0)->get() as $s)
                                    @if($supplier->id != $s->id)
                                        <option value="{{$s->id}}" @if($supplier->parent_id == $s->id) selected="selected" @endif>{{$s->name}}</option>
                                    @endif
                                @empty
                                @endforelse
                            </select>
                            @hasError(['inputName' => 'parent'])@endhasError
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-sm btn-primary tx-uppercase">Update Category</button>
                <a href="{{ route('supplier-categories.index') }}" class="btn btn-outline-secondary btn-sm tx-uppercase">Cancel</a>
                
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
                    $(this).hide();
                    return false;
                } else {
                    $(this).show();
                }
            });
        });


    </script>
@endsection
