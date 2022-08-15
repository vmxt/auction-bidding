@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')
@endsection

@section('content')

    <section id="page-title" class="page-title-nobg">
        <div class="container clearfix">
            <h1>Profile</h1>
            <span>Philsaga Mining Corporation</span>
            @if(Auth::user()->role_id == env('APPROVER_ID'))
                <ol class="breadcrumb">             
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('approver.dashboard') }}">Approver Portal</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $supplier_details ? $supplier_details->company_name : '' }}</li>                      
                </ol>
            @elseif(Auth::user()->role_id == env('EVALUATOR_ID'))
                <ol class="breadcrumb">             
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('evaluator.dashboard') }}">Evaluator Portal</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $supplier_details ? $supplier_details->company_name : '' }}</li>                      
                </ol>
            @else
                <ol class="breadcrumb">             
                    <li class="breadcrumb-item"><a href="{{ route('sms.auth.profile.view', \Auth()->user()->id) }}">My Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Profile</li>                      
                </ol>
            @endif
        </div>
    </section>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col-12">
                    <div class="heading-block noborder row">                       

                        <div class="alert alert-danger alert-dismissible fade hide" role="alert" id="reqs-div" style="display:none;">
                            <h4 class="alert-heading">Warning!</h4>
                            <p>The Submission to Approval process failed to continue due to incomplete requirements. Below are the list for your compliance. </p>
                            <hr>
                            <ul class="pr-3 pl-3" id="reqs">
                                
                            </ul>
                        </div>
                        
                        @if(Auth::user()->role_id == 8)

                            <div class="text-right">
                                <a href="{{route('sms.auth.print-profile.view', $user->id)}}" class="btn btn-success"> Print Profile </a>
                            </div>

                        @endif

                        @if($supplier_details)
                        <div class="col-12">
                            <div class="row" id="company-header">
                            
                            <div class="col-sm-12">
                                <h3 class="d-block" style="width: 100%;">
                                    
                                    <span class="badge badge-secondary active-mem">
                                        
                                        {{ $supplier_details->status }}                                         
                                        @if( $supplier_details->status == 'On-going Approval' ) 

                                            @php 
                                                $approval = \App\SupplierModels\Approvals::where('supplier_id', request()->email)->latest()->first();  
                                                $curr_approver = \App\SupplierModels\ApproverSteps::where('approval_id', $approval->id)
                                                ->where('is_current', 1)->first();
                                            @endphp
                                            - ( {{ $curr_approver->status }} )
                                        @endif

                                    </span>
                                    
                                </h3> 
                            </div>
                            <br>
                            <div class="col-md-12">
                                @if($user->is_one_time == 1 && $supplier_details->apply_as_permanent == 0 && $supplier_details->apply_as_permanent_done == 0)
                                    <p class="badge badge-md active-mem" style="background-color:purple; color: white; font-size: 16px; margin-bottom: 0; margin-top: 5px;"> ( One Time Supplier ) </p>                                
                                @elseif($user->is_one_time == 1 && $supplier_details->apply_as_permanent == 1 && $supplier_details->apply_as_permanent_done == 0)
                                    <p class="badge badge-md active-mem" style="background-color:purple; color: white; font-size: 16px; margin-bottom: 0; margin-top: 5px;"> ( On going application as regular supplier ) </p>                                
                                @endif
                                <h3 class="d-block">{{ strtoupper($supplier_details->company_name) }} 
                                                                
                                    @if(Auth::user()->role_id == env('SUPPLIER_ID') && 
                                        ( $supplier_details->status == 'Applicant' || 
                                        ( $supplier_details->status == 'On-going Approval' && $supplier_details->is_editable == 1)
                                        ) )
                                        <a href="#" onclick="$('#confirmmodal').modal('show')" class="btn btn-success mt-2 mb-2 btn-to-approve">Submit to Approver</a>
                                    @elseif( Auth::user()->role_id == env('SUPPLIER_ID') && $supplier_details->status != 'On-going Approval'
                                        && $supplier_details->apply_as_permanent == 1
                                        && $supplier_details->is_one_time == 1 
                                        && $supplier_details->apply_as_permanent_done == 0
                                    )
                                        <a href="#" onclick="$('#confirmmodal').modal('show')" class="btn btn-success mt-2 mb-2 btn-to-approve">Submit to Approver</a>                                            
                                    @endif
                                    
                                    @if(auth()->user()->role_id == env('APPROVER_ID'))
                                        @if($supplier_details->is_one_time == 1 && $supplier_details->apply_as_permanent == 0 && $supplier_details->status == 'Active')
                                        <a href="{{ route('approver.deactivate-user', $supplier_details->supplier_id) }}" class="btn btn-success mt-2 mb-2 btn-to-approve">Deactivate Supplier</a>    
                                        @endif
                                    @endif

                                </h3>                       
                                <address class="mt-0">{{ $supplier_details ? strtoupper($supplier_details->address) : '' }}</address>
                                <span class="mt-0 d-block" style="width: 100%">
                                    <strong>BUSINESS STYLE</strong>:  {{ $supplier_details ? strtoupper($supplier_details->business_style):'' }}
                                </span><br>
                                <span class="mt-0 d-block" style="width: 100%">
                                    <strong>TIN</strong>: {{ $supplier_details ? $supplier_details->tin : '' }}                                
                                </span>
                            </div>

                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- <div class="col-md-2 col-4 p-0 d-block d-lg-none d-flex justify-content-end">
                    <a href="#" class="button button-rounded side-panel-trigger bottommargin btn-options"><span class="icon-bars"></span></a>
                </div> -->
                
                <div id="side-panel">

                    <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a></div>

                    <div class="side-panel-wrap">

                        <div class="widget clearfix">

                            <h4>Options</h4>

                            <nav class="nav-tree nobottommargin table-options">
                                <ul>
                                    <li><a href="#"><i class="icon-bolt2"></i>Bids</a>
                                        <ul>
                                            <li><a href="#">Invites</a></li>
                                            <li><a href="#">Submitted</a></li>
                                            <li><a href="#">Won</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-money-bill"></i>Payments  <span class="badge badge-info">10</span><span class="sr-only">pending</span></a>
                                        <ul>
                                            <li><a href="#">Requested</a></li>
                                            <li><a href="#">Upcoming</a></li>
                                            <li><a href="#">Completed</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-briefcase"></i>Transactions</a>
                                        <ul>
                                            <li><a href="#">PO</a></li>
                                            <li><a href="#">Shipments</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-user"></i>Profile</a>
                                        <ul>
                                            <li><a href="#">Update</a></li>
                                            <li><a href="#">Products</a></li>
                                            <li><a href="#">Summary</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-key2"></i>Account</a>
                                        <ul>
                                            <li><a href="#">Update Password</a></li>
                                            <li><a href="#">Logout</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-note"></i>Messages <span class="badge badge-info">10</span><span class="sr-only">unread messages</span></a>
                                        <ul>
                                            <li><a href="#">Inbox</a></li>
                                            <li><a href="#">Compose</a></li>
                                            <li><a href="#">Sent</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-sign-out-alt"></i>Logout</a></li>
                                </ul>
                            </nav>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="@if(Auth::user()->role_id == env('APPROVER_ID') || Auth::user()->role_id == env('EVALUATOR_ID')) col-md-8 @else col-md-12 @endif">
                                
                        <h4 class="bg-dark table-bg-main-title text-light p-3">A. General Information</h4>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                              <tbody>
                                <tr>
                                  <td><strong>Date Established:</strong></td>
                                  <td>{{ $supplier_details ? $supplier_details->date_established : '' }}</td>
                                </tr>
                                <tr>
                                  <td><strong>Company Website:</strong></td>
                                  <td><a href="{{ $supplier_details->website ?? '' }}" target="_blank">{{ $supplier_details ? $supplier_details->website : '' }}</a></td>
                                </tr>
                                <tr>
                                  <td><strong>Type of Organization:</strong></td>
                                  <td>{{ $supplier_details ? strtoupper($supplier_details->organization_type):'' }}</td>
                                </tr>                                
                                <tr>
                                    <td><strong>Business Lines:</strong></td>
                                    <td>
                                        @forelse($supplier_bli as $bli)
                                            @if($loop->last)
                                              {{ strtoupper($bli->name) }}                                            
                                            @else
                                              {{ strtoupper($bli->name) }},                                         
                                            @endif
                                        @empty
                                            No Business Line
                                        @endforelse
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Vendor Code:</strong></td>
                                    <td>
                                        {{ $supplier_details ? strtoupper($supplier_details->code) : '' }}
                                    </td>
                                </tr>
                              </tbody>
                            </table>
                        </div>

                        <h5 class="bg-dark text-light p-2">Officers:</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td> Name </td>
                                        <td> Position </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($supplier_officers as $officer)
                                        <tr>
                                            <td>{{ strtoupper($officer->name) }}</td>
                                            <td>{{ strtoupper($officer->position) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center"> No assigned officer </td>
                                        </tr>
                                    @endforelse                           
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <h5 class="bg-dark text-light p-2">Contact Details:</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td><strong>Customer Service</strong></td>
                                        <td><strong>Sales</strong></td>
                                        <td><strong>Accounting</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Name:</strong></td>

                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->name) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->name) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->name) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Position:</strong></td>
                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->position) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->position) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->position) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email Address:</strong></td>
                                        <td>
                                            @if($supplier_contact_cs)
                                                <a href="mailto:{{$supplier_contact_cs->email}}" target="_blank"> {{ $supplier_contact_cs->email }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($supplier_contact_sales)
                                                <a href="mailto:{{$supplier_contact_sales->email}}" target="_blank">{{ $supplier_contact_sales->email }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($supplier_contact_accounting)
                                                <a href="mailto:{{$supplier_contact_accounting->email}}" target="_blank">{{ $supplier_contact_accounting->email }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Telephone Number:</strong></td>
                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->telephone_no) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->telephone_no) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->telephone_no) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fax Number:</strong></td>
                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->fax_no) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->fax_no) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->fax_no) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mobile Number:</strong></td>
                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->mobile_no) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->mobile_no) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->mobile_no) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Skype Account:</strong></td>
                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->skype) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->skype) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->skype) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Others:</strong></td>
                                        <td>{{ $supplier_contact_cs ? strtoupper($supplier_contact_cs->others) : ''}}</td>
                                        <td>{{ $supplier_contact_sales ? strtoupper($supplier_contact_sales->others) : ''}}</td>
                                        <td>{{ $supplier_contact_accounting ? strtoupper($supplier_contact_accounting->others) : ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <h5 class="bg-dark text-light p-2">Bank Details:</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td><strong> Bank Name </strong></td>
                                        <td><strong> Account Name </strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $supplier_bank_d as $swift_b ) 
                                        <tr>
                                            <td>{{ strtoupper($swift_b->bank_name)  ?? ''}}</td>                                    
                                            <td>{{ strtoupper($swift_b->account_name)  ?? ''}}</td>
                                        </tr>                                   
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center"> No Bank Details </td>
                                        </tr>
                                    @endforelse                                
                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="bg-dark text-light p-3">B. Goods and Services</h4>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">                           
                                <tbody>

                                    <thead>
                                        <tr>
                                            <td><strong> Category </strong></td>
                                            <td><strong> Name </strong></td>
                                            <td><strong> Other Name </strong></td>
                                        </tr>
                                    </thead>

                                    @forelse( $supplier_servicess as $service )

                                        <tr>
                                            <td>{{ strtoupper($service->cat) }}</td>
                                            <td>{{ strtoupper($service->name) }}</td>
                                            <td>{{ strtoupper($service->other_name) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center"> No Goods and Services Selected </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="bg-dark text-light p-3">C. Do you have any access to any form of credit? </h4>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                
                                <thead>
                                    <tr>
                                        <td><strong>Institution</strong></td>
                                        <td><strong>Address</strong></td>
                                        <td><strong>Telephone</strong></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse( $supplier_credits as $credits )

                                        <tr>
                                            <td>{{ strtoupper($credits->institution) }} </td>
                                            <td>{{ strtoupper($credits->address) }} </td>
                                            <td>{{ strtoupper($credits->phone) }}</td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">None (if the user select none)</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>                        
                        
                        <h4 class="bg-dark text-light p-3">D. General Requirement</h4>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td><strong> Name </strong></td>
                                        <td><strong> Attachment </strong></td>
                                        <td><strong> Valid Until </strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $supplier_requirements as $req )
                                        <tr>
                                            <td> {{ strtoupper($req->name) }}</td>                                            
                                            <td> 
                                                @if( $req->attachment &&  $req->attachment != 'null' )
                                                    @php $storage_url = env('APP_URL')."/storage/images/supplier/profile".$req->supplier_id."/supplier-details/attachment/" @endphp
                                                    <a href="{{ $storage_url.$req->attachment }}" target="_blank" > {{ $req->attachment}} </a> 
                                                @endif
                                            </a>
                                            <td> {{ $req->validity ? $req->validity->toDateString() : '' }} </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="3" class="text-center"> No Requirements is selected </td>
                                        </tr>

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="bg-dark text-light p-3">E. Certifications</h4>
                            
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td><strong> Category </strong></td>
                                        <td><strong> Certification Number </strong></td>
                                        <td><strong> Valid Until </strong></td>
                                        <td><strong> Certifying Body </strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier_cqualities as $cquality)
                                        <tr>
                                            <td> Quality Standards </td>
                                            <td> {{ strtoupper($cquality->certification_number) }} </td>
                                            <td> {{ $cquality->certification_validity->toDateString() }} </td>
                                            <td> {{ strtoupper($cquality->certification_body) }} </td>
                                         </tr>
                                    @endforeach
                                    
                                    @foreach($supplier_cenveronmentals as $cquality)
                                        <tr>
                                            <td> Environmental Standards </td>
                                            <td> {{ strtoupper($cquality->certification_number) }} </td>
                                            <td> {{ $cquality->certification_validity->toDateString() }} </td>
                                            <td> {{ strtoupper($cquality->certification_body) }} </td>
                                        </tr> 
                                    @endforeach
                                    
                                    @foreach($supplier_csafety as $cquality)
                                        <tr>
                                            <td> Safety Checks/Standards </td>
                                            <td> {{ strtoupper($cquality->certification_number) }} </td>
                                            <td> {{ $cquality->certification_validity->toDateString() }} </td>
                                            <td> {{ strtoupper($cquality->certification_body) }} </td>
                                        </tr>
                                    @endforeach

                                    @foreach($supplier_cothers as $cquality)
                                        <tr>
                                            <td> Other Standards </td>
                                            <td> {{ strtoupper($cquality->certification_number) }} </td>
                                            <td> {{ $cquality->certification_validity->toDateString() }} </td>
                                            <td> {{ strtoupper($cquality->certification_body) }} </td>
                                        </tr>
                                    @endforeach       

                                    @unless(count($supplier_cqualities) || count($supplier_cenveronmentals) 
                                        || count($supplier_csafety) || count($supplier_cothers) )
                                        <tr>
                                            <td colspan="4" class="text-center"> No Certifications </td>
                                        </tr>
                                    @endunless                         

                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="bg-dark text-light p-3">F. For Timber, Explosives, Chemicals and Other Controlled Commodity Suppliers</h4>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Attachment </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse( $supplier_controlled_commodity as $c_comms )
                                        <tr>
                                            @php $storage_url = env('APP_URL')."/storage/images/supplier/profile".$c_comms->supplier_id."/supplier-details/attachment/" @endphp
                                            <td>{{ strtoupper($c_comms->name) }}</td>
                                            <td>
                                                @if( $c_comms->attachment && $c_comms->attachment != 'null'  )
                                                <a href="{{ $storage_url.$c_comms->attachment }}" target="_blank"> {{ $c_comms->attachment }} </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="2"> No Controlled Commodity </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="bg-dark text-light p-3">G. Current and Past Customers</h4>
                        
                        <h5 class="bg-dark text-light p-2">Major Customer:</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td><strong>Institution</strong></td>
                                        <td><strong>Address</strong></td>
                                        <td><strong>Contact Number</strong></td>
                                        <td><strong>Email Address</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($supplier_mc as $mc)
                                        <tr>
                                            <td>{{ strtoupper($mc->name) }}</td>
                                            <td>{{ strtoupper($mc->address) }}</td>
                                            <td>{{ strtoupper($mc->phone) }}</td>                                            
                                            <td><a href="mailto:{{ $mc->email }}" target="_blank"> {{ $mc->email }} </a></td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="4" class="text-center"> No Major Customer </td>
                                        </tr>

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <h5 class="bg-dark text-light p-2">Customer of Last Three Years:</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td><strong>Institution</strong></td>
                                        <td><strong>Address</strong></td>
                                        <td><strong>Contact Number</strong></td>
                                        <td><strong>Email Address</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($supplier_lty as $lty)
                                        <tr>
                                            <td>{{ strtoupper($lty->name) }}</td>
                                            <td>{{ strtoupper($lty->address) }}</td>
                                            <td>{{ strtoupper($lty->phone) }}</td>                                            
                                            <td><a href="mailto:{{ $lty->email }}" target="_blank"> {{ $lty->email }} </a></td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="4" class="text-center"> No Customer of Last Three Years </td>
                                        </tr>

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="bg-dark text-light p-3">H. Financial Status</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Attachment </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($supplier_financial_stats as $fss)
                                    @php $storage_url = env('APP_URL')."/storage/images/supplier/profile".$fss->supplier_id."/supplier-details/attachment/" @endphp
                                        <tr>
                                            <td>{{ strtoupper($fss->name) }}</td>
                                            <td>
                                                @if( $fss->attachment && $fss->attachment != 'null' )
                                                <a href="{{ $storage_url.$fss->attachment }}" target="_blank"> {{ $fss->attachment }} </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td class="text-center" colspan="2"> No Financial Status </td>
                                        </tr>

                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <h4 class="bg-dark text-light p-3">I. Payment Terms</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    @forelse($supplier_pt as $pt)
                                        <tr>
                                            <td>{{ strtoupper($pt->name) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center"> No Payment Terms </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <h4 class="bg-dark text-light p-3">J. File Attachments</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    @php
                                        $attchmnts = [];
                                        if($supplier_details && !is_null($supplier_details->attachments)) {
                                            $attchmnts = explode(',',$supplier_details->attachments);
                                        }                                    
                                    @endphp

                                    @forelse($attchmnts as $attch)
                                        @php $path = "storage/images/supplier/profile{$supplier_details->supplier_id}/supplier-details/attachment/{$attch}"; @endphp
                                        <tr>
                                            <td><a href="/{{ $path }}" target="_blank"> {{ $attch }} </a></td>
                                        </tr>
                                    @empty
                                        <tr><td class="text-center"> No File Attached </td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        

                    </div>
                    @if(Auth::user()->role_id == env('APPROVER_ID') || 
                        Auth::user()->role_id == env('EVALUATOR_ID'))
                        <div class="col-md-4 col-xs-12">
                            <div class="divider divider-center"><i class="icon-note"></i> History</div>
                            @forelse($approval_history as $history)
                                
                                <div class="card text-white mb-3 @if($history->action == 'Approved') bg-primary @elseif($history->action == 'Hold') bg-secondary  @elseif($history->action == 'Return to previous Approver') bg-warning @elseif($history->action == 'Reject') bg-danger @else bg-primary @endif" style="max-width: 30rem;">

                                    <div class="card-header">

                                        @if(!$loop->last)

                                            <p style="display: inline;">{{$history->user->first_name}}
                                                <span style="float: right;">Response Length: 

                                                    @if($approval_history[$loop->index + 1]->created_at->diffInDays($history->created_at)>0)
                                                        {{$approval_history[$loop->index + 1]->created_at->diffInDays($history->created_at)}} Day(s)
                                                    @elseif($approval_history[$loop->index + 1]->created_at->diffInHours($history->created_at)>0)
                                                        {{$approval_history[$loop->index + 1]->created_at->diffInHours($history->created_at)}} Hour(s)
                                                    @else
                                                        {{$approval_history[$loop->index + 1]->created_at->diffInMinutes($history->created_at)}} Minute(s)
                                                    @endif

                                                </span>
                                            </p>
                                        @else
                                            {{$history->user->first_name}}
                                        @endif

                                    </div>

                                    <div class="card-body">
                                        <p class="m-0">{{$history->action}}
                                        <small style="display: block;">{{$history->created_at->diffForHumans()}}</small></p>
                                        <p>{{$history->remarks}} </p>
                                    </div>

                                </div>
                            @empty
                            @endforelse
                        </div>
                    @endif
                    
                </div>

                @if(Auth::user()->role_id == env('APPROVER_ID') && $supplier_details 
                    && $supplier_details->status == 'On-going Approval')

                    <div class="row">
                        
                        <div class="col-md-12 center">

                            <div class="widget_links">

                                <!-- Modal for approve -->
                                <div class="modal fade" id="approvedModal" tabindex="-1" role="dialog" aria-labelledby="approvedModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> Confirm Action </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to Approve this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success yesApprovedModalBtn">Yes</button>
                                                <button type="button" class="btn btn-secondary approvedModalBtn" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $approver = \App\SupplierModels\ApproverSteps::isCurrentApprover($user,Auth::id());
                                    $approval = \App\SupplierModels\Approvals::where('supplier_id', request()->email)->latest()->first();
                                    $curr_approver = \App\SupplierModels\ApproverSteps::where('approval_id', $approval->id)
                                        ->where('is_current', 1)->first();
                                    $logged_approver = \App\SupplierModels\ApproverSteps::where('approver_id', Auth::id())
                                        ->where('approval_id', $approval->id)
                                        ->first();
                                    $isReject = \App\SupplierModels\ApproverSteps::where('approval_id', $approval->id)
                                        ->where('status', 'Reject')->first();
                                @endphp
                                @if( $approver || in_array($curr_approver? $curr_approver->sequence:1, $logged_approver->override))
                                    
                                    @if(!$isReject && $curr_approver)
                                    <div class="row mb-3">
                                        <div class="col-12 center">  
                                            <div style="display:none;" class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                                                <label class="btn btn-lg btn-outline-success mr-1 ls0 nott approvedModalOption" for="chkNo">
                                                    <input type="radio" class="chk_stat" name="chk" id="chkNo" autocomplete="off" value="approve" onclick="ShowHideDiv()"> Approve 
                                                </label>
                                                <label class="btn btn-lg btn-outline-secondary ls0 nott disapprovedModalOption" for="chkYes">
                                                    <input type="radio" class="chk_stat" name="chk" id="chkYes" autocomplete="off" value="disapprove" onclick="ShowHideDiv()"> Disapprove
                                                </label>
                                            </div>
                                        </div>
                                    </div>       
                                    @endif                                 
                                @endif                                
                                <!-- Modal for disapprove -->
                                <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> Confirm Action </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to <strong>Reject</strong> this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success disapproveOption" data-dismiss="modal">Yes</button>
                                                <button type="button" class="btn btn-secondary noDisapproveOption" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for disapprove -->
                                <div class="modal fade" id="holdModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> Confirm Action </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to <strong>Hold</strong> this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success disapproveOption" data-dismiss="modal">Yes</button>
                                                <button type="button" class="btn btn-secondary noDisapproveOption" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for disapprove -->
                                <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> Confirm Action </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to <strong>Return to previous Approver</strong> this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success disapproveOption" data-dismiss="modal">Yes</button>
                                                <button type="button" class="btn btn-secondary noDisapproveOption" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: none" id="dvtext">
                                    <div class="field_wrapper2 mt-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control required" name="freelance-quote-project-type" id="freelance-quote-project-type">
                                                    <option class="selectedOption" disabled selected value>-- Select One --</option>
                                                    <option value="Reject">Reject (Disapproved this vendor) </option>
                                                    <option value="Hold">Hold (Return to vendor and allow to edit)</option>
                                                    @if($logged_approver->sequence != 1)
                                                    <option value="Return to previous Approver">Return to previous Approver</option>
                                                    @endif                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="field_reason" style="display:none;">
                                    <div class="widget quick-contact-widget form-widget clearfix">
                                        <br>
                                        <h4 class="text-left"><span id="rs_m" style="color: #000000;"> Remarks: </span>*</h4>
                                        <div class="form-result"></div>
                                        <form action="{{route('sms.approver.supplier.disapprove')}}" name="disapprove_form" id="disapprove_form" method="post" class="quick-contact-form nobottommargin">
                                            <input type="hidden" name="approve_supplier_id" id="approve_supplier_id" value="{{$user->id}}">
                                            <input type="hidden" name="dis_status" id="dis_status">
                                            @csrf
                                            <div class="form-process"></div>
                                            <textarea class="required sm-form-control input-block-level short-textarea" id="reason" name="reason" rows="4" cols="30"></textarea>                 
                                            <div class="mt-3">
                                                <button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="add_button btn btn-success">Update</button>
                                            </div>  
                                        </form>

                                    </div>
                                </div>   

                                <form action="{{route('sms.approver.supplier.approve')}}" name="approve_form" id="approve_form" method="post">
                                    @csrf
                                    <input type="hidden" name="approve_supplier_id" id="approve_supplier_id" value="{{$user->id}}">
                                    <input type="hidden" name="approve_reason" id="approve_reason" value="">
                                </form>
                                

                            </div>

                        </div>
                        
                    </div>
                @endif
                <div class="w-100 line d-block d-md-none"></div>

            </div>
            </div>

        </div>

    </section>
    
    <div class="modal fade" id="confirmmodal" tabindex="-1" role="dialog" aria-labelledby="confirmmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmmodalLabel">Submit Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Make sure to review your profile first before submitting to our approvers as you wont be able to edit your profile during the approval process.
                    Are you sure you want to submit your profile now? 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button data-link="{!!route('sms.auth.profile.submit',$user->id)!!}" id="yes-proceed" 
                        class="btn btn-primary"><span id="y-p">Yes! Proceed</span></button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('pagejs')

    
    <script>
    
        var submit_route = "{!! route('sms.auth.profile.submit',$user->id) !!}";
        var _role = "{!! auth()->user()->role_id !!}";
        var _is_one_time = {!! $user->is_one_time !!};
        var _apply_for_permanent = {!! $user->supplier_details ? $user->supplier_details->apply_as_permanent : null !!};

        $('#freelance-quote-project-type').on('change',function(){
            $('#dis_status').val($(this).val());            
        });

        $(document).on('click', '#yes-proceed', function() {

            $('#y-p').text('Loading....');
            $('#yes-proceed').prop('disabled', true);
            window.location = $(this).data('link');

        });

        jQuery(document).ready( function(){
            $('.datepicker').datepicker({
                autoclose: true
            });

            $('#feedback-form').on( 'formSubmitSuccess', function(){
                $('.feedback-form-success-modal').magnificPopup('open');
            });
            
            // $("#upload-file, #upload-file1, #upload-file2, #upload-file3, #upload-file4, #upload-file5, #upload-file6, #upload-file7, #upload-file8, #upload-file9, #upload-file10, #upload-file11, #upload-file12, #upload-file13").fileinput({
            //     required: true,
            //     browseClass: "btn btn-secondary",
            //     browseIcon: "",
            //     removeClass: "btn btn-danger",
            //     removeLabel: "",
            //     removeIcon: "<i class='icon-trash-alt1'></i>",
            //     showUpload: false
            // });

            $('#quick-contact-form-submit').click(function(e) {
                e.preventDefault();
                
                if ( $('.chk_stat:checked').val() == 'approve' ) {

                    $('#approvedModal').modal('show');                    

                    return false;

                }

                if( $('#freelance-quote-project-type').val() == 'Reject' ) {
                    $('#rejectModal').modal('show');
                } else if( $('#freelance-quote-project-type').val() == 'Hold' ) {
                    $('#holdModal').modal('show');
                } else if( $('#freelance-quote-project-type').val() == 'Return to previous Approver' ) {
                    $('#returnModal').modal('show');
                }

                return false;


            });

            $('.yesApprovedModalBtn').click(function(e){

                $('#approve_reason').val($('#reason').val());

                $('#approve_form').submit();

            });

            $('.disapproveOption').click(function(e){

                $('#disapprove_form').submit();

            });

            if(_is_one_time == 1 && _apply_for_permanent == 0) {

                if( Object.entries(checkList1()).length > 0 ) {
                    console.log('sulod checklist 1');
                    disabledSubmitBtn();
                }

            } else {

                if( Object.entries(checkList()).length > 0 ) {
                    console.log('sulod checklist');
                    disabledSubmitBtn();

                }
            }

        })

        function ShowHideDiv() {
            var dvtext = document.getElementById("dvtext");
            dvtext.style.display = chkYes.checked ? "block" : "none";
            $('.field_reason').show();                      
        }

        function checkList() {

            let req = {
                'tin'                               : 'TIN is required' ,
                'date_established'                  : 'Date Established is required' ,
                'customers_lty'                     : 'atleast 3 Customers for three years are required' ,
                'major_customers'                   : 'atleast 3 Major Customers are required' , 
                'officer'                           : 'atleast 1 Officer is required' ,
                'contact_details'                   : 'atleast 1 Contact Person is required' ,
                'bank_details'                      : 'atleast 1 Bank Details is required' ,    
                'services'                          : 'atleast 1 or more Services is required' ,
            };

            let _global = {
                'business registration documents'   : 'Business Documents is required' ,
                'general information sheet'         : 'General Information Sheet is required' ,
                'company profile'                   : 'Company Profile is required' ,
                'sample charge invoice'             : 'Sample Charge Invoice is required'
            }

            let _local = {
                'bir'                           : 'BIR is required' ,
                'mayors permit'                 : 'Mayors Permit is required' ,
                'dti'                           : 'DTI is required' ,
                'sample official receipt'       : 'Sample Receipt is required',
                'company profile'               : 'Company Profile is required' ,
                'general information sheet'     : 'General Information Sheet is required'
            }
                    
            let tin = "{!! $supplier_details ? $supplier_details->tin : '' !!}";
            let date_established = "{!! $supplier_details ? $supplier_details->date_established : null !!}";
            let supplier_country = "{!! $supplier_details ? $supplier_details->country : null !!}";
            let supplier_bof = "{!! $supplier_details ? $supplier_details->organization_type : null !!}";
            let supplier_lty = {!! $supplier_lty ? $supplier_lty : "[]" !!};
            let supplier_mc = {!! $supplier_mc ? $supplier_mc : "[]" !!};
            let supplier_officers = {!! $supplier_officers ? $supplier_officers : "[]" !!};
            let supplier_contact_accounting = {!! $supplier_contact_accounting ? $supplier_contact_accounting : "null" !!};   
            let supplier_contact_sales = {!! $supplier_contact_sales ? $supplier_contact_sales : "null" !!};
            let supplier_contact_cs = {!! $supplier_contact_cs ? $supplier_contact_cs : "null" !!};
            let supplier_requirements = {!! $supplier_requirements ? $supplier_requirements : "null" !!};
            let supplier_bank_d = {!! $supplier_bank_d ? $supplier_bank_d : "[]" !!};
            let supplier_application = {!! $supplier_application !!};
            let supplier_services = {!! $supplier_servicess ? $supplier_servicess : "[]" !!};

            if(supplier_bof != 'sole proprietorship') { 
                delete _local['dti']; 
                _local.sec = 'SEC is required';
            }

            if(supplier_bof != 'corporation') { 
                delete _local['general information sheet']; 
                delete _global['general information sheet']; 
            }

            if(supplier_application.territory == 'Local') {
                req.general_requirements = _local;                
                if(tin!='') {
                    delete req['tin'];
                }
            } else {
                if(supplier_country == 'PH' || supplier_country == 'Philippines') {
                    req.general_requirements = _local;
                    if(tin!='') {
                        delete req['tin'];
                    }
                } else {
                    req.general_requirements = _global;
                    delete req['tin'];
                }
            }   

            if(supplier_services.length > 0){
                delete req['services'];
            }

            if(date_established!='') {
                delete req['date_established'];
            }

            if(supplier_officers.length>0) {
                delete req['officer'];
            }

            if( supplier_contact_accounting !='' && supplier_contact_accounting != null  && supplier_contact_accounting.name != null && supplier_contact_accounting.position != null && 
                (supplier_contact_accounting.email != null || supplier_contact_accounting.mobile_no != null || supplier_contact_accounting.telephone_no != null) ) {
                delete req['contact_details'];
            } 

            if( supplier_contact_cs !='' && supplier_contact_cs != null && supplier_contact_cs.name != null && supplier_contact_cs.position != null && 
                (supplier_contact_cs.email != null || supplier_contact_cs.mobile_no != null || supplier_contact_cs.telephone_no != null) ) {
                delete req['contact_details'];
            } 

            if( supplier_contact_sales !='' && supplier_contact_sales !=null && supplier_contact_sales.name != null && supplier_contact_sales.position != null && 
                (supplier_contact_sales.email != null || supplier_contact_sales.mobile_no != null || supplier_contact_sales.telephone_no != null) ) {
                delete req['contact_details'];
            } 

            if(supplier_lty.length>2){
                delete req['customers_lty'];
            }

            if(supplier_mc.length>2){
                delete req['major_customers'];
            }

            if(supplier_requirements.length>0) {
                for(var x = 0; x < supplier_requirements.length; x++) {
                    delete req['general_requirements'][supplier_requirements[x].name.toLowerCase()];
                }
            }

            if(supplier_bank_d.length>0) {
                delete req['bank_details'];
            }

            if(Object.entries(req['general_requirements']).length == 0){
                delete req['general_requirements'];
            }

            return req;

        }

        function checkList1() {
            
            let req = {};

            let _global = {
                'business registration documents'   : 'Business Documents is required' ,
                'general information sheet'         : 'General Information Sheet is required' ,
                'company profile'                   : 'Company Profile is required' ,
                'sample charge invoice'             : 'Sample Charge Invoice is required'
            }

            let _local = {
                'sample official receipt'           : 'Sample Receipt is required' ,  
                'sample sales invoice'              : 'Sample Sales Invoice is required' ,                
                'sample charge invoice'             : 'Sample Charge Invoice is required'
            }

            let supplier_requirements = {!! $supplier_requirements ? $supplier_requirements : "null" !!};
            let supplier_application = {!! $supplier_application !!};
            let supplier_country = "{!! $supplier_details ? $supplier_details->country : null !!}";

            if(supplier_country == 'PH' || supplier_country == 'Philippines') {
                req.general_requirements = _local;      
            } else {
                req.general_requirements = _global;
            }

            if(supplier_requirements.length>0) {
                for(var x = 0; x < supplier_requirements.length; x++) {
                    delete req['general_requirements'][supplier_requirements[x].name.toLowerCase()];
                }
            }

            if(Object.entries(req['general_requirements']).length == 0){
                delete req['general_requirements'];
            }

            return req;
            
        }

        function disabledSubmitBtn() {

            let req = '';

            if(_is_one_time == 1 && _apply_for_permanent == 0) {
                req = this.checkList1();
            } else {
                req = this.checkList();
            }

            console.log(req);
            // if(Object.entries(req).length == 0){
            //     window.location.href = e;
            //     return false;
            // }

            let html = "";
            $('#reqs').empty();
            for (var key in req) {
                if(key == 'general_requirements') {
                    for (var key1 in req[key]) {
                        html+= '<li> '+req[key][key1]+'</li>';
                    }
                } else {
                    html+= '<li> '+req[key]+'</li>';
                }

            }

            $('.btn-to-approve').attr('disabled', true).addClass('disabled');
            // $('#confirmmodal').modal('hide');

            if( _role == <?php echo env('SUPPLIER_ID'); ?>) {
                $('#reqs').append(html);
                $('#reqs-div').removeClass('hide').addClass('show').css('display', 'block');
            }
        }



    </script>

@endsection


