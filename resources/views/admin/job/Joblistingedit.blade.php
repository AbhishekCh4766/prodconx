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
									<span>Edit Job</span>
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
                                        <span class="caption-subject font-red sbold uppercase">Edit Job</span>
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
                                   <form action="{{URL::to('joblisting')}}/{{$job->id}}" id="form_sample_3" class="form-horizontal" method="POST" >
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                         
										   <div class="form-group">
                                                <label class="control-label col-md-3">Job Title
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="job_title" data-required="1" class="form-control" value="{{$job->job_title}}" /> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Created By
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="name" data-required="1" class="form-control" value="{{$job->first_name}} {{$job->last_name}}" /> </div>
                                            </div>  											
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Contact Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="contact_name" data-required="1" class="form-control" value="{{$job->	contact_name}}" /> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Phone Number
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="phone_no" data-required="1" class="form-control" value="{{$job->contact_phone}}" /> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Contact Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="contact_email" data-required="1" class="form-control" value="{{$job->contact_email}}" /> </div>
                                            </div>		
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Job Location
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="job_location" data-required="1" class="form-control" value="{{$job->job_location}}" /> </div>
                                            </div>	
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Postal Code
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                    <input type="text" name="postal_code" data-required="1" class="form-control" value="{{$job->job_postal}}" /> </div>
                                            </div>											
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="is_active">
                                                        <option <?php if($job->status == 1){ ?> selected <?php } ?> value="1">Active</option>
                                                        <option <?php if($job->status == 0){ ?> selected <?php } ?> value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>											
                                            <div class="form-group last">
                                                <label class="control-label col-md-3">Text
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-9">
                                                    <textarea class="ckeditor form-control" name="text" rows="6" data-error-container="#editor2_error">{{$job->job_description}}</textarea>
                                                    <div id="editor2_error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <a href="{{URL::to('joblisting')}}"><button type="button" class="btn default">Cancel</button></a>
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