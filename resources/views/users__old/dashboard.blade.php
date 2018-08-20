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
		
	</style>	

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
	
        <div class="page-content-wrapper">
	
		<div class="page-content" style="margin-left:0px !important;">
		
					<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="javascript:;">Welcome</a>
                            </li>
                            <li>
                                <span><?php echo $users->first_name.' '.$users->last_name; ?></span>
                            </li>
                        </ul>
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
                    <h3 class="page-title"> Pricing Tables
                        <!--<small>pricing table samples</small>-->
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="portlet light portlet-fit bordered">
						@if (session('message'))
							<div class="alert alert-success">
								<button class="close" data-close="alert"></button>
								<span> {{ session('message') }} </span>
							</div>					
						@endif	
                        <div class="portlet-body">
                            <div class="pricing-content-1">
                                <div class="row">
									<?php $i = 1 ?>
									@foreach($memberships as $membership)	
                                    <div class="col-md-3">
                                        <div class="price-column-container border-active">
											<?php if($i==5) $i=1; if($i == 1 ) {?>
										   <div class="price-table-head bg-blue">
                                                <h2 class="no-margin">{{$membership->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-blue"></div>
											
											<?php } if($i == 2) { ?>
										   <div class="price-table-head bg-green">
                                                <h2 class="no-margin">{{$membership->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-green"></div>
											
											
											<?php } if ($i == 3) { ?>
										   <div class="price-table-head bg-red">
                                                <h2 class="no-margin">{{$membership->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-red"></div>									
											
											
											
											<?php } if ($i == 4) { ?>
                                           
										   <div class="price-table-head bg-purple">
                                                <h2 class="no-margin">{{$membership->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-purple"></div>
											<?php } ?>
                                            <div class="price-table-pricing">
                                                <h3>
                                                    <span class="price-sign">$</span>{{$membership->price}}</h3>
													@if ($membership->title == 'Gold' || $membership->title == 'gold')
													 <div class="price-ribbon">Popular</div>
													@endif
                                            </div>
                                            <div class="price-table-content">
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-refresh"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">{{$membership->duration}}</div>
                                                </div>
                                            </div>
                                            <div class="arrow-down arrow-grey"></div>
                                            <div class="price-table-footer">
                                                <a href="{{URL::to('checkout')}}/{{$membership->id}}"> <button type="button" class="btn grey-salsa btn-outline sbold uppercase price-button">Checkout</button></a>
                                            </div>
                                        </div>
                                    </div>
									<?php $i++; ?>
									@endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
			</div>			
				@include( 'includes.footer' )				 