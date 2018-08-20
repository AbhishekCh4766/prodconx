<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
	
	<head>
	@include('includes.head')
	</head>
	<!-- HEAD END --->	
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
		.col-md-3 {
			margin-top: 20px;
		}
		
		.static-info.align-reverse .value {
			margin-top: 0px !important;
		}
		
	</style>	

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
	
        <div class="page-content-wrapper">
	
		<div class="page-content" style="margin-left:0px !important;">
		
					<div class="page-bar">
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
		
		
                    <!-- BEGIN PAGE HEADER-->

                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Checkout
                        <!--<small>pricing table samples</small>-->
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="portlet light portlet-fit bordered">
                        
                        <div class="portlet-body">
                            <div class="pricing-content-1">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="portlet grey-cascade box">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-cogs"></i>Membership Cart </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> Product </th>
																				<th> Duration </th>
                                                                                <th> Price </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="javascript:;"> {{$membership_plan->title}} </a>
                                                                                </td>
																				<td> {{$membership_plan->duration}}</td>
                                                                                <td> {{$membership_plan->price }}</td>
                                                                            </tr>                                                          </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"> </div>
                                                    <div class="col-md-6">
                                                        <div class="well">
                                                            <div class="row static-info align-reverse">
                                                                <div class="col-md-8 name"> Sub Total: </div>
                                                                <div class="col-md-3 value"> {{$membership_plan->price }}</div>
                                                            </div>
                                                            <div class="row static-info align-reverse">
                                                                <div class="col-md-8 name"> Tax: </div>
                                                                <div class="col-md-3 value"> 0 </div>
                                                            </div>													
                                                            <div class="row static-info align-reverse">
                                                                <div class="col-md-8 name"> Grand Total: </div>
                                                                <div class="col-md-3 value"> {{$membership_plan->price }} </div>
                                                            </div>
                                                           
                                                        </div>
														
														<div class="form-actions noborder" style="text-align:right;" >
															<a  href="{{URL::to('userDashboard')}}"><button type="button" class="btn btn default">Cancel Payment</button></a>														
															<a  href="{{URL::to('payment')}}/{{$membership_plan->id}}"><button type="button" class="btn blue">Make Your Payment</button></a>
														</div>
                                                    </div>
													
                                                </div> 
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
			</div>			
				@include( 'includes.footer' )				 