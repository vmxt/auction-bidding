@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/select-boxes.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/components/bs-filestyle.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/pmc_sms/supplier-portal/css/custom.css') }}" type="text/css" />
@endsection

@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix"> 

                <div class="col-md-12">

                <div class="filter-buttons mg-b-10">
                    <div class="d-md-flex bd-highlight">
                        <div class="bd-highlight mg-r-10 mg-t-10">
                            <h2>Results</h2>
                        </div>
                        <div class="ml-auto bd-highlight mg-t-10">
                            <form class="form-inline" id="searchForm">
                                <div class="search-form mg-r-10">
                                    <input name="keyword" type="search" id="keyword" class="form-control"  placeholder="Keyword">  
                                    <button class="btn btn-success" id="btnSearch"><i data-feather="search"></i>Search</button>
                                    <a href="javascript(0);" class="btn btn-primary" id="btnAdvnceSearch" data-toggle="modal" data-target="#advnceSearchDiv"><i data-feather="search"></i>Advance Search</a>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="table-list mg-b-10">
                        <div class="table-responsive-lg">
                            <table class="table mg-b-0 table-light table-hover table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th scope="col" width="25%">Company Name</th>
                                    <th scope="col" width="18%">Business Type</th>
                                    <th scope="col" width="18%">Status</th>
                                    <th scope="col" width="14%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse( $suppliers as $supplier )
                                        <tr>
                                            <td>{{ $supplier->company_name }}</td>
                                            <td>{{ $supplier->business_type }}</td>
                                            <td>{{ $supplier->status }}</td>
                                            <td><a target="_blank" href="{{route('sms.auth.profile.view',$supplier->supplier_id)}}" class="btn btn-success">Profile</a></td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mg-t-5">
                        
                    </div>
                </div>

                <div class="col-md-6" style="display:none;">
                    <div class="text-md-right float-md-right mg-t-5">
                        
                    </div>
                </div>

            </div>

            </div>
        </div>
    </section>

    <!-- Modal -->
<div class="modal fade" id="advnceSearchDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advance Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="searchForm">
                <input type="hidden" name="advance_search" value="true">
                <div class="form-group">
                    
                    <label for="company_name"> Company Name </label>
                    <input name="company_name" type="search" id="company_name" class="form-control">  
                    
                </div>              

                <div class="form-group">
                    
                    <label for="business_lines"> Business Lines </label>
                    <input name="business_lines" type="search" id="business_lines" class="form-control">  
                    
                </div>

                <div class="form-group">
                    
                    <label for="contact_person"> Contact Person </label>
                    <input name="contact_person" type="search" id="contact_person" class="form-control">  
                    
                </div>                

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
      </div>      
    </div>
  </div>
</div>

@endsection

@section('pagejs')
    <script src="{{ asset('theme/pmc_sms/supplier-portal/js/components/select-boxes.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/pmc_sms/supplier-portal/include/fileupload/image-uploader.min.js') }}"></script>
@endsection

