<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
	
	<head>
	@include('includes.head')
	</head>
	<!-- HEAD END --->	
		

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
       @include( 'includes.header' )
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
			@include('includes.navigation')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
	<div class="page-content">
						<!-- BEGIN PAGE HEADER-->
						<!-- BEGIN PAGE BAR -->
						<div class="page-bar">
							<ul class="page-breadcrumb">
								<li>
									<a href="{{ URL::to('/dashboard')}}">Dashboard</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span>Edit User</span>
								</li>
							</ul>
						</div>
						<!-- END PAGE BAR -->
						<!-- END PAGE HEADER-->
						<!--
						<div class="m-heading-1 border-green m-bordered">
							
						</div>
						-->
						<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Edit User</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->  
									<div class="form-body">
                                    <form id="form_sample_1" class="form-horizontal" action="{{ URL::to('/updateUser')}}/<?=$userDetails->id?>" method="POST">
                                      
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">First Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="first_name" data-required="1" class="form-control" value="{{ $userDetails->first_name }}" /> 													
													</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Last Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="last_name" data-required="1" class="form-control" value="{{ $userDetails->last_name }}" /> 
													
													</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Username
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="username" data-required="1" class="form-control" value="{{ $userDetails->username }}" /> 													
													</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="email" data-required="1" class="form-control" value="{{ $userDetails->email }}" /> 													
													</div>
                                            </div>										
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Select
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="is_active">
                                                        <option <?php if($userDetails->is_active == 1){ ?> selected <?php } ?> value="1">Active</option>
                                                        <option <?php if($userDetails->is_active == 0){ ?> selected <?php } ?> value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input type="submit" class="btn green" value="Submit" />
                                                    <a href="{{ URL::to('/usersList')}}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
                                                </div>
                                            </div>
                                        </div>											
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>
					<!-- my -->
					</div>
				</div>
			</div>
		</div>	
						
				@include( 'includes.footer' )				 