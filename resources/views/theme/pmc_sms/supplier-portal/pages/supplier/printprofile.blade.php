@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.'.env('SP_TEMPLATE').'.main')

@section('pagecss')

    <style type="text/css">
        #top-bar , 
        #header , 
        #page-title , 
        #footer {
            display: none;
        }
    </style>
    <script src="html2pdf.bundle.min.js"></script>

@endsection

@section('content')

    <section id="content">
         
        <div class="content-wrap">

            <div class="container clearfix">

               
                
                <div class="col-lg-12 col-md-10 col-8">
                    <div class="heading-block noborder">

                        <div class="alert alert-danger alert-dismissible fade hide" role="alert" id="reqs-div">
                            <ul class="p-0 m-0" style="list-style: none;" id="reqs">
                                
                            </ul>
                        </div>

                        <div class="text-right">
                            <a href="#" class="btn btn-success" onclick="printFile()"> Print </a>
                            <a href="#" class="btn btn-primary" onclick="downloadFile()"> Download as Pdf </a>
                        </div>

                    </div>
                </div>

                <div class="row" id="printable-wrapper">                          

                    <div class="col-md-12">
                        
                        @if($supplier_details)
                            <h3 class="text-center d-block">{{ $supplier_details->company_name }} <span class="badge badge-secondary active-mem">{{ $supplier_details->status }}</span></h3>  
                            <p class="mt-0 text-center">{{ $supplier_details ? $supplier_details->address : '' }}</p>
                            <p class="mt-0 text-center"><strong>TIN</strong>: {{ $supplier_details ? $supplier_details->tin : '' }}</p>
                        @endif

                        <h4 class="bg-dark table-bg-main-title text-light p-3">A. General Information</h4>
                        
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
                              <td>{{ $supplier_details ? $supplier_details->organization_type:'' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Business Lines:</strong></td>
                                <td>
                                    @forelse($supplier_bli as $bli)
                                        @if($loop->last)
                                          {{ ucwords($bli->name) }}                                            
                                        @else
                                          {{ ucwords($bli->name) }},                                         
                                        @endif
                                    @empty

                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Vendor Code:</strong></td>
                                <td>
                                    {{ $supplier_details ? $supplier_details->code : '' }}
                                </td>
                            </tr>
                          </tbody>
                        </table>
                        
                        <h5 class="bg-dark text-light p-2">Officers:</h5>
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                                @forelse($supplier_officers as $officer)
                                    <tr>
                                        <td>{{$officer->name}}</td>
                                        <td>{{$officer->position}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td> No assigned officer </td>
                                    </tr>
                                @endforelse                           
                                
                            </tbody>
                        </table>
                        
                        <h5 class="bg-dark text-light p-2">Contact Details:</h5>
                        <table class="table table-bordered table-striped"  width="100%">
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

                                    <td>{{$supplier_contact_cs->name ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->name ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Position:</strong></td>
                                    <td>{{$supplier_contact_cs->position ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->position ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->position ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email Address:</strong></td>
                                    <td>{{$supplier_contact_cs->email ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->email ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telephone Number:</strong></td>
                                    <td>{{$supplier_contact_cs->telephone_no ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->telephone_no ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->telephone_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fax Number:</strong></td>
                                    <td>{{$supplier_contact_cs->fax_no ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->fax_no ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->fax_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile Number:</strong></td>
                                    <td>{{$supplier_contact_cs->mobile_no ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->mobile_no ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->mobile_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Skype Account:</strong></td>
                                    <td>{{$supplier_contact_cs->skype ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->skype ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->skype ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Others:</strong></td>
                                    <td>{{$supplier_contact_cs->others ?? ''}}</td>
                                    <td>{{$supplier_contact_sales->others ?? ''}}</td>
                                    <td>{{$supplier_contact_accounting->others ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <h5 class="bg-dark text-light p-2">Bank Details:</h5>
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>

                                @foreach( $supplier_bank_d_swift as $swift_b ) 
                                    <tr>
                                        <td><strong>Bank Name:</strong></td>
                                        <td>{{ $swift_b->bank_name  ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Account Name:</strong></td>
                                        <td>{{ $swift_b->account_name  ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Swift Code:</strong></td>
                                        <td>{{ $swift_b->code  ?? ''}}</td>
                                    </tr>
                                @endforeach

                                @foreach( $supplier_bank_d_iban as $iban_b ) 
                                    <tr>
                                        <td><strong>Bank Name:</strong></td>
                                        <td>{{ $iban_b->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Account Name:</strong></td>
                                        <td>{{ $iban_b->account_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>IBAN Code:</strong></td>
                                        <td>{{ $iban_b->code }}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                        <h4 class="bg-dark text-light p-3">B. Goods and Services</h4>
                        
                        <table class="table table-bordered table-striped" width="100%">                           
                            <tbody>

                                <thead>
                                    <tr>
                                        <td> Service Name </td>
                                        <td> Service Category </td>
                                    </tr>
                                </thead>

                                @foreach( $supplier_servicess as $service )

                                    <tr>
                                        <td>{{ ucwords($service->name) }}</td>
                                        <td>{{ ucwords($service->cat) }}</td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        
                        <h4 class="bg-dark text-light p-3">C. Do you have any access to any form of credit? </h4>
                        
                        <table class="table table-bordered table-striped" width="100%">
                            
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
                                        <td>{{ $credits->institution }} </td>
                                        <td>{{ $credits->address }}</td>
                                        <td>{{ $credits->phone }}</td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">None (if the user select none)</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        
                        
                        <h4 class="bg-dark text-light p-3">D. General Requirement</h4>
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                                @foreach( $supplier_requirements as $req )
                                    <tr>
                                        <td> {{ ucwords($req->name) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <h4 class="bg-dark text-light p-3">E. Certifications</h4>
                        
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                                <tr>
                                    <td>Quality Standards
                                        <ul class="pl-5 m-0">
                                            @foreach($supplier_cqualities as $cquality)
                                                <li>{{ ucwords($cquality->details) }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>Environmental Standards
                                        <ul class="pl-5 m-0">
                                            @foreach($supplier_cenveronmentals as $cquality)
                                                <li>{{ ucwords($cquality->details) }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>Safety Standards
                                        <ul class="pl-5 m-0">
                                            @foreach($supplier_csafety as $cquality)
                                                <li>{{ ucwords($cquality->details) }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>Other Standards
                                        <ul class="pl-5 m-0">
                                            @foreach($supplier_cothers as $cquality)
                                                <li>{{ ucwords($cquality->details) }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <h4 class="bg-dark text-light p-3">F. For Timber, Explosives, Chemicals and Other Controlled Commodity Suppliers</h4>
                        
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                                @foreach( $supplier_controlled_commodity as $c_comms )
                                    <tr>
                                        <td>{{ ucwords($c_comms->name) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <h4 class="bg-dark text-light p-3">G. Current and Past Customers</h4>
                        
                        <h5 class="bg-dark text-light p-2">Major Customer:</h5>
                        <table class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <td><strong>Insitution</strong></td>
                                    <td><strong>Address</strong></td>
                                    <td><strong>Telephone</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier_mc as $mc)
                                    <tr>
                                        <td>{{ $mc->name }}</td>
                                        <td>{{ $mc->address }}</td>
                                        <td>{{ $mc->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <h5 class="bg-dark text-light p-2">Customer of Last Three Years:</h5>
                        <table class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <td><strong>Insitution</strong></td>
                                    <td><strong>Address</strong></td>
                                    <td><strong>Telephone</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier_lty as $lty)
                                    <tr>
                                        <td>{{ $lty->name }}</td>
                                        <td>{{ $lty->address }}</td>
                                        <td>{{ $lty->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <h4 class="bg-dark text-light p-3">H. Financial Status</h4>
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                                @foreach($supplier_financial_stats as $fss)
                                    <tr>
                                        <td>{{ ucwords($fss->name) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h4 class="bg-dark text-light p-3">I. File Attachments</h4>
                        <table class="table table-bordered table-striped" width="100%">
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
                                @endforelse
                            </tbody>
                        </table>

                        

                    </div>
                   
                    <div class="col-md-12">
                        <div class="divider divider-center"><i class="icon-note"></i> History</div>
                        @forelse($approval_history as $history)
                            
                            <div class="card text-white mb-3 @if($history->action == 'Approved') bg-primary @endif @if($history->action == 'Hold') bg-secondary  @endif" style="max-width: 50rem; display: block; margin: 0 auto;">

                                <div class="card-header">

                                    @if(!$loop->last)

                                        <p style="display: inline;">{{$history->user->first_name}}
                                            <span style="float: right;">Response Length: 

                                                @if($approval_history[$loop->index + 1]->created_at->diffInDays($history->created_at)>0)
                                                    {{$approval_history[$loop->index + 1]->created_at->diffInDays($history->created_at)}} Day/s
                                                @elseif($approval_history[$loop->index + 1]->created_at->diffInHours($history->created_at)>0)
                                                    {{$approval_history[$loop->index + 1]->created_at->diffInHours($history->created_at)}} Hour/s
                                                @else
                                                    {{$approval_history[$loop->index + 1]->created_at->diffInMinutes($history->created_at)}} Minutes
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
                   
                    
                </div>

                
            </div>
           
        </div>

    </section>
        
@endsection

@section('pagejs')
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script type="text/javascript">
        
        function printFile() {
            window.print();
        }

        function downloadFile() {

            const element = document.getElementById("printable-wrapper");
            console.log(element);
            // Choose the element and save the PDF for our user.
            html2pdf()
              .from(element)
              .save();

        }

    </script>

@endsection


