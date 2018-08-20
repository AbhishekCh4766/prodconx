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
									<a href="dashboard">Dashboard</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span>Edit Department Role</span>
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
                                        <span class="caption-subject font-red sbold uppercase">Edit Department Role</span>
                                    </div>
                                </div>
								
                                <div class="portlet-body">
                                    <!-- BEGIN FORM--> 
									@foreach ($errors->all() as $error)
										<div class="alert alert-danger">
											<button class="close" data-close="alert"></button>
											<span> {{ $error }} </span>
										</div>					
									@endforeach									
									<div class="form-body">
                                   <form action="{{URL::to('updateDepartmentRoles')}}" method="post" id="form_sample_3" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                            <div class="form-group">
											{{ csrf_field() }}
                                                <label class="control-label col-md-3">Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="name" data-required="1" class="form-control" value="{{$departmentRole->rolename}}" /> 
													<input type="hidden" name="role_id" value="{{$departmentRole->id}}" />  
													</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Select Department
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="department_id">
                                                        <option value="">Select...</option>
                                                        @foreach($departments as $department)
														<?php //echo $departmentRole->parent_id. '  =  '.$department->id; die; ?>
														<option value="{{$department->id}}" <?php if($department->id == $departmentRole->parent_id){ ?>selected <?php } ?> >{{$department->name}}</option>
														@endforeach
                                                    </select>
                                                </div>
                                            </div>												
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="is_active">
                                                        <option <?php if($departmentRole->is_active == 1){ ?> selected <?php } ?> value="1">Active</option>
                                                        <option <?php if($departmentRole->is_active == 0){ ?> selected <?php } ?> value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>											
                                            <div class="form-group last">
                                                <label class="control-label col-md-3">Text
                                                </label>
                                                <div class="col-md-9">
                                                    <textarea class="ckeditor form-control" name="text" rows="6" data-error-container="#editor2_error">{{$departmentRole->description}}</textarea>
                                                    <div id="editor2_error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <a href="{{URL::to('departmentRoles')}}"><button type="button" class="btn default">Cancel</button></a>
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