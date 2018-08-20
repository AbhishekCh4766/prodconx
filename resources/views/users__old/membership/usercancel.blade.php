<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
	
	<head>
	@include('includes.head')
	
		<style>
		@media (min-width: 992px)
		.page-content-wrapper .page-content {
			margin-left: 0px !important; 
			margin-top: 0;
			min-height: 600px;
			padding: 25px 20px 10px;
		}
		
		.page-content-wrapper .page-content {
			margin-left: 0px !important; 
		}
		
	</style>	
	
	
	</head>
	<!-- HEAD END --->	
		

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-content-wrapper">
	
		<div class="page-content" style="margin-left:0px !important;">		
       <div class="row">
	   
	   					<div class="page-bar">
								<a style="margin-left:12px;margin-bottom:10px;margin-top:5px;" href="{{URL::to('userDashboard') }}" class="btn btn-lg blue">
                                    <i class="fa fa-long-arrow-left"></i> Back 
								</a>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> My Account
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="{{URL::to('userDashboard') }}">
                                            <i class="fa fa-home"></i>Home</a>
                                    </li>									
                                    <li>
                                        <a href="{{URL::to('getMyProfile') }}">
                                            <i class="icon-user"></i>My Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('userOrder') }}">
                                            <i class="fa fa-briefcase"></i>My Plan</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('request') }}">
                                            <i class="fa fa-search"></i>Seacrh</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('getFriend') }}">
                                            <i class="fa fa-odnoklassniki"></i>Friends</a>
                                    </li>									
                                    <li>
                                        <a href="{{URL::to('userLogout')}}">
                                            <i class="icon-key"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>	
						@if (session('message'))
							<div class="alert alert-success">
								<button class="close" data-close="alert"></button>
									<span> {{ session('message') }} </span>
							</div>					
						@endif						
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
							<div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-body">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs nav-tabs-lg">
                                            <li class="active">
                                                <a href="#tab_1" data-toggle="tab"> Details </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="portlet grey-cascade box">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                  Last Payment Cancelled.</div>

                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
				</div>
			</div>	
						
				@include( 'includes.footer' )				 