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
                    <!-- BEGIN PAGE HEADER-->

                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Pricing Tables
                        <!--<small>pricing table samples</small>-->
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="portlet light portlet-fit bordered">
                        
                        <div class="portlet-body">
                            <div class="pricing-content-1">
                                <div class="row">
									<?php $i = 1 ?>								
								@foreach($plans as $plan)
                                    <div class="col-md-3">
                                        <div class="price-column-container border-active">
											<?php if($i==5) $i=1; if($i == 1 ) {?>
										   <div class="price-table-head bg-blue">
                                                <h2 class="no-margin">{{$plan->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-blue"></div>
											
											<?php } if($i == 2) { ?>
										   <div class="price-table-head bg-green">
                                                <h2 class="no-margin">{{$plan->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-green"></div>
											
											
											<?php } if ($i == 3) { ?>
										   <div class="price-table-head bg-red">
                                                <h2 class="no-margin">{{$plan->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-red"></div>									
											
											
											
											<?php } if ($i == 4) { ?>
                                           
										   <div class="price-table-head bg-purple">
                                                <h2 class="no-margin">{{$plan->title}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-purple"></div>
											<?php } ?>

                                            <div class="price-table-pricing">
                                                <h3>
                                                    <span class="price-sign">$</span>{{$plan->price}}</h3>
													@if ($plan->title == 'Gold' || $plan->title == 'gold')
													 <div class="price-ribbon">Popular</div>
													@endif                                                
                                            </div>
                                            <div class="price-table-content">
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-refresh"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">{{$plan->duration}}</div>
                                                </div>
                                            </div>
                                            <div class="arrow-down arrow-grey"></div>
                                            <div class="price-table-footer">
                                                <a href="{{URL::to('login')}}"> <button type="button" class="btn grey-salsa btn-outline sbold uppercase price-button">Sign In</button></a>
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