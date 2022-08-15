<form id="logout-front-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<nav id="primary-menu" class="with-arrows style-2 center">

    <div class="container clearfix">

        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

        <ul>

            @php
                $menu = \App\Menu::where('is_active', 1)->whereId(env('SP_MENU'))->first();                
            @endphp
            
            @if(Auth::guest() || Auth::user()->role_id != env('APPROVER_ID'))
                @foreach ($menu->parent_navigation() as $item)
                    @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.supplier-portal.layout.menu-item', ['item' => $item])
                @endforeach
            @endif

            @if (!Auth::guest())

                @php 
                    $count = 0;        
                    $messages = \App\Message::where('to', Auth::user()->email)->where('is_read', 0)->count();                    
                    $curr_logged_user = \App\SupplierModels\ApproverTemplates::where('approver_id', Auth::id())->first();
                    if(Auth::user()->role_id == env('APPROVER_ID')) {
                        
                        $fa = \App\SupplierModels\ApproverSteps::where('status', '!=', 'Reject')
                                ->where('approver_id',Auth::id())
                                ->where('is_current', 1)
                                ->count();
                        $ua = \App\SupplierModels\ApproverSteps::where('is_current', 1)
                                ->where('status', '!=', 'Reject')
                                ->where('approver_id', '!=', Auth::id())
                                ->where('sequence', '<', $curr_logged_user->sequence_no)
                                ->count();                        
                    }

                @endphp

                @if(!Auth::guest() && Auth::user()->role_id == env('APPROVER_ID'))   
                    @if($curr_logged_user->sequence_no == 1)
                    <li><a href="#">Applications</a>
                        <ul>
                            <li><a href="{{ route('approver.applications-pending') }}"> Pending </a></li>
                            <li><a href="{{ route('approver.applications-approved') }}"> Approved </a></li>
                            <li><a href="{{ route('approver.applications-rejected') }}"> Rejected </a></li>
                        </ul>
                    </li>
                    @endif
                    <li><a href="{{ route('approver.dashboard') }}">For Approval @if($fa>0)(<strong>{{$fa}}</strong>)@endif</a></li>  
                    @if($curr_logged_user->sequence_no != 1)
                    <li><a href="{{ route('approver.upcoming-approval') }}">Upcoming Approval @if($ua>0)(<strong>{{$ua}}</strong>)@endif</a></li>
                    @endif
                    <li><a href="#">Suppliers</a>  
                        <ul>
                            <li><a href="{{ route('approver.accredited-suppliers') }}">Accredited</a></li>
                            <li><a href="{{ route('approver.ongoing-suppliers') }}">Ongoing</a></li>  
                            <li><a href="{{ route('approver.rejected-suppliers') }}">Rejected</a></li>
                        </ul>
                    </li>

                    @if(Auth::user()->approver_sequence->sequence_no == 1)
                        <li><a href="{{ route('approver.classic-data') }}"> Upload Data From Classic </a></li>
                    @endif

                    @if(Auth::user()->approver_sequence->sequence_no == 4)
                        <li><a href="{{ route('approver.approval') }}"> Assign Vendor Code </a></li>
                    @endif

                    <li><a href="#">Reports</a>
                        <ul>
                            <li><a href="{{ route('approver.reports-initial-registration') }}"> Initial Registrations </a></li>
                            <li><a href="{{ route('approver.reports-sis-submission') }}"> SIS for Submission </a></li>
                            <li><a href="{{ route('approver.reports-for-approval') }}"> Suppliers For Approval </a></li>
                            <li><a href="{{ route('approver.reports-approved-suppliers') }}"> Approved Suppliers </a></li>
                            <li><a href="{{ route('approver.reports-initial-registration') }}"> Approver Summary </a></li>
                        </ul>
                    </li>

                @endif

                @if(!Auth::guest() && Auth::user()->role_id == env('EVALUATOR_ID'))
                    <li><a href="#">Suppliers</a>  
                        <ul>
                            <li><a href="{{ route('evaluator.accredited-suppliers') }}">Accredited</a></li>
                            <li><a href="{{ route('evaluator.dashboard') }}">Ongoing</a></li>  
                            <li><a href="{{ route('evaluator.rejected-suppliers') }}">Rejected</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Reports</a>
                        <ul>
                            <li><a href="{{ route('evaluator.reports-initial-registration') }}"> Initial Registrations </a></li>
                            <li><a href="{{ route('evaluator.reports-sis-submission') }}"> SIS for Submission </a></li>
                            <li><a href="{{ route('evaluator.reports-for-approval') }}"> Suppliers For Approval </a></li>
                            <li><a href="{{ route('evaluator.reports-approved-suppliers') }}"> Approved Suppliers </a></li>
                            <li><a href="{{ route('evaluator.reports-initial-registration') }}"> Approver Summary </a></li>
                        </ul>
                    </li>
                @endif

                <li><a href="#">My Account @if($messages>0)(<strong>{{$messages}}</strong>)@endif</a>  
                    <ul> 
                        <h6 class="tx-semibold mg-b-5" style="padding: 15px 15px 5px; word-break: break-all;">{{ ucfirst(Auth::user()->username) }}</h6>

                        @if(Auth::user()->role_id == env('APPROVER_ID'))                            
                            <li><a href="{{ route('approver.messages') }}">Messages @if($messages>0)(<strong>{{$messages}}</strong>)@endif</a></li>
                            <li><a href="{{ route('approver.password-reset') }}">Change Password</a></li>
                            <li><a href="{{ asset('manuals/approvers.pdf') }}" target="_blank" >User Manual</a></li>   
                            <li><a href="{{ route('approver.settings') }}" >Settings</a></li>                              
                        @endif

                        @if(Auth::user()->role_id == env('SUPPLIER_ID'))
                            <li><a href="{{ route('sms.auth.profile.view',Auth::id()) }}">My Profile</a></li>  
                            <li><a href="{{ route('sms.auth.profile.edit') }}">Update Profile</a></li> 
                            @if(Auth::user()->is_one_time== 1 && 
                                ( Auth::user()->supplier_details && 
                                    Auth::user()->supplier_details->status == 'Active' && 
                                    Auth::user()->supplier_details->apply_as_permanent_done == 0) )
                            <li><a href="{{ route('sms.auth.profile.permanent') }}">Apply as Regular Supplier</a></li> 
                            @endif
                            <li><a href="{{ route('sms.messages') }}">Messages @if($messages>0)(<strong>{{$messages}}</strong>)@endif</a></li>
                            <li><a href="{{ route('sms.password-reset') }}">Change Password</a></li>                             
                            <li><a href="{{ asset('manuals/suppliers.pdf') }}" target="_blank" >User Manual</a></li>   
                        @endif    
                        @if(Auth::user()->role_id == env('EVALUATOR_ID'))
                            <li><a href="{{ route('evaluator.password-reset') }}">Change Password</a></li>  
                            <li><a href="{{ asset('manuals/evaluators.pdf') }}" target="_blank" >User Manual</a></li>   
                        @endif                    
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-front-form').submit();">Logout</a></li>

                    </ul>  
                </li>
            @else
                <li><a href="{{ route('sp.login') }}">Login</a> </li>
            @endif
        </ul>

        <!-- Top Search
        ============================================= -->
        <div id="top-search">
            <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
            <form action="{{ route('go-search') }}" method="get">
                <input type="text" name="keyword" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
            </form>
        </div><!-- #top-search end -->

    </div>

</nav><!-- #primary-menu end -->

