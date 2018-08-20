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
									<a href="{{URL::to('dashboard')}}">Dashboard</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span>Add Content</span>
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
                                        <span class="caption-subject font-red sbold uppercase">Add Content</span>
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
                                   <form action="{{URL::to('contents')}}" id="form_sample_3" class="form-horizontal" method="POST">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="name" data-required="1" class="form-control" value="{{Request::old('name')}}" />
													{{ csrf_field() }}	
													</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="description" data-required="1" class="form-control" value="{{Request::old('description')}}" /> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Short Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="short_description" data-required="1" class="form-control" value="{{Request::old('short_description')}}" /> </div>
                                            </div>										
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Meta Title
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="meta_title" data-required="1" class="form-control" value="{{Request::old('meta_title')}}" /> </div>
                                            </div>	
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Meta Keyword
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="meta_keyword" data-required="1" class="form-control" value="{{Request::old('meta_keyword')}}" /> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Meta Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="meta_description" data-required="1" class="form-control" value="{{Request::old('meta_description')}}" /> </div>
                                            </div>												
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <a href="{{URL::to('content')}}"><button type="button" class="btn default">Cancel</button></a>
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