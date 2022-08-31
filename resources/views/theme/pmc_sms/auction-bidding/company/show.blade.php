@extends('theme.pmc_sms.main.main')
@section('content')
    @include('partials.page-title', [
        'title' => 'View Edit Company',
        'subtitle' => 'A Short Page Title Tagline'
    ])

    <section id="content">
        <div class="content-wrap">
            <div class="container">
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
            
                <div class="row">
                    <div class="col-12">

                        <img src="{{ asset('theme/pmc_sms/auction-bidding/images/icons/avatar.jpg') }}" class="alignleft img-circle img-thumbnail my-0" alt="Avatar">

                        <div class="heading-block border-0 pb-3">
                            <h2>{{ $company->name }} 
                                <a href="{{ route('company.edit', $company->id) }}" name="fitness-form-submit" class="btn btn-success">Edit Profile</a>
                            </h2>

                            <ul style="list-style:none;">
                                <b><li>Head Office:</b> {{ $company->office_address }}</li>
                                <b><li>Contact Person:</b> {{ $company->contact_person }}</li>
                                <b><li>Contact Number:</b> {{ $company->contact_number }}</li>
                                <b><li>Mobile Number:</b> {{ $company->mobile_number }}</li>
                                <b><li>Email Address:</b> {{ $company->email_address }}</li>
                            </ul>
                        </div>

                        <div class="clear"></div>

                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="tabs tabs-alt clearfix" id="tabs-profile">

                                    <ul class="tab-nav clearfix">
                                        <li><a href="#tab-branch">Branches</a></li>
                                        <li><a href="#tab-accounts">User Accounts</a></li>
                                        <li><a href="#tab-prods">Product List</a></li>
                                        <li><a href="#tab-audits">Audit Logs</a></li>
                                    </ul>

                                    <div class="tab-container">

                                        <div class="tab-content clearfix" id="tab-branch">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addBranchModal" name="fitness-form-submit" class="btn btn-primary mb-3">Add Branch</a>
                                            
                                            <div class="table-responsive">
                                                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-nowrap">
                                                            <th>Branch Name</th>
                                                            <th>Region</th>
                                                            <th>City</th>
                                                            <th>Full Address</th>
                                                            <th>Landline</th>
                                                            <th>Mobile Number</th>
                                                            <th>Email Address</th>
                                                            <th>Contact Person</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($company->branches as $branch)
                                                            <tr>
                                                                <td>{{ $branch->name }}</td>
                                                                <td>{{ $branch->region }}</td>
                                                                <td>{{ $branch->city }}</td>
                                                                <td>{{ $branch->full_address }}</td>
                                                                <td>{{ preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $branch->landline) }}</td>
                                                                <td>{{ $branch->mobile_number }}</td>
                                                                <td>{{ $branch->email_address }}</td>
                                                                <td>{{ $branch->contact_person }}</td>
                                                                <td><div class="badge {{ $branch->status == 'open' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($branch->status) }}</div></td>
                                                                <td>
                                                                    <form id="delete-form-{{ $branch->id }}" action="{{ route('branch.destroy', $branch->id) }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                    <a 
                                                                        href="{{ route('branch.destroy', $branch->id) }}" 
                                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $branch->id }}').submit();">
                                                                        <i class="icon-remove"></i>
                                                                    </a>
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editBranchModal{{ $company->id }}"><i class="icon-pencil2"></i></a>
                                                                    
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="editBranchModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form class="row mb-0" id="" action="{{ route('branch.update', $branch->id) }}" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')

                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">Edit Branch: {{ $branch->name }}</h4>
                                                                                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="form-widget">

                                                                                        <div class="form-result"></div>

                                                                                            <div class="row">

                                                                                                <div class="col-12">
                                                                                                        <div class="form-process">
                                                                                                            <div class="css3-spinner">
                                                                                                                <div class="css3-spinner-scaler"></div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <input type="hidden" name="company_id" value="{{ $company->id }}">

                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Branch Name:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="name" id="" class="form-control required" value="{{ $branch->name }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Region:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="region" id="" class="form-control required" value="{{ $branch->region }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">City:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="city" id="" class="form-control required" value="{{ $branch->city }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Full Address:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="full_address" id="" class="form-control required" value="{{ $branch->full_address }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Landline:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="landline" id="" class="form-control required" value="{{ $branch->landline }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Mobile Number:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="mobile_number" id="" class="form-control required" value="{{ $branch->mobile_number }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Email Address:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="email" name="email_address" id="" class="form-control required" value="{{ $branch->email_address }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12 form-group">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-3 col-form-label">
                                                                                                                    <label for="">Contact Person:</label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-9">
                                                                                                                    <input type="text" name="contact_person" id="" class="form-control required" value="{{ $branch->contact_person }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                        <button type="submit" class="btn btn-primary">Update Branch</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr class="text-center">
                                                                <td colspan="10">No record found.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-content clearfix" id="tab-accounts">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addUserModal" name="fitness-form-submit" class="btn btn-primary mb-3">Add User Account</a>

                                            <div class="table-responsive">
                                                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-nowrap">
                                                            <th>Account Name</th>
                                                            <th>Role</th>
                                                            <th>Email Address</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($company->users as $user)
                                                        <tr>
                                                            <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                                            <td>{{ $user->role->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td><div class="badge {{ $user->active === 1 ? 'bg-success' : 'bg-danger' }}">{{ $user->active === 1 ? 'Active' : 'Inactive' }}</div></td>
                                                            <td>
                                                                <a href="#"><i class="icon-remove"></i></a>
                                                                <!-- Button trigger modal -->
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#myModal2"><i class="icon-pencil2"></i></a>
                                                                
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Add user</h4>
                                                                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-widget">

                                                                                <div class="form-result"></div>

                                                                                    <div class="row">

                                                                                        <div class="col-12">
                                                                                            <form class="row mb-0" id="" action="" method="post" enctype="multipart/form-data">
                                                                                                <div class="form-process">
                                                                                                    <div class="css3-spinner">
                                                                                                        <div class="css3-spinner-scaler"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-3 col-form-label">
                                                                                                            <label for="">User's Name:</label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-9">
                                                                                                            <input type="text" name="" id="" class="form-control required" value="">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-3 col-form-label">
                                                                                                            <label for="">Role:</label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-9">
                                                                                                            <input type="email" name="" id="" class="form-control required" value="">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 form-group">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-3 col-form-label">
                                                                                                            <label for="">Email Address:</label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-9">
                                                                                                            <input type="email" name="" id="" class="form-control required" value="">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="button" class="btn btn-primary">Add User</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                            <tr class="text-center">
                                                                <td colspan="5">No record found.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-content clearfix" id="tab-prods">

                                            <div class="table-responsive">
                                                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-nowrap">
                                                            <th>Product Name</th>
                                                            <th>Last Order Date</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Product 1</td>
                                                            <td>12-Jan-2015</td>
                                                            <td>250</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Product 2</td>
                                                            <td>12-Jan-2015</td>
                                                            <td>250</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-content clearfix" id="tab-audits">

                                            <div class="table-responsive">
                                                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-nowrap">
                                                            <th>User Account</th>
                                                            <th>Activity</th>
                                                            <th>Date/Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>Logged In</td>
                                                            <td>12-Jan-2015 00:15</td> 
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>Create</td>
                                                            <td>12-Jan-2015 00:15</td> 
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>25-August-2019</td>
                                                            <td>12-Jan-2015 00:15</td> 
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Branch Create Modal -->
    <div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="row mb-0" id="" action="{{ route('branch.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Branch</h4>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-widget">

                        <div class="form-result"></div>

                            <div class="row">

                                <div class="col-12">
                                    <div class="form-process">
                                        <div class="css3-spinner">
                                            <div class="css3-spinner-scaler"></div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="company_id" value="{{ $company->id }}">

                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Branch Name:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Region:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="region" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">City:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="city" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Full Address:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="full_address" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Landline:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="landline" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Mobile Number:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="mobile_number" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Email Address:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="email" name="email_address" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="">Contact Person:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="contact_person" id="" class="form-control required" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Branch</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Create Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="row mb-0" id="" action="" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add user</h4>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-widget">

                        <div class="form-result"></div>

                            <div class="row">

                                <div class="col-12">
                                    
                                        <div class="form-process">
                                            <div class="css3-spinner">
                                                <div class="css3-spinner-scaler"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group">
                                            <div class="row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="">User's Name:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="" id="" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group">
                                            <div class="row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="">Role:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="email" name="" id="" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group">
                                            <div class="row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="">Email Address:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="email" name="" id="" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection