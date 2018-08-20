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
									<a href="{{URL::to('/dashboard')}}">Dashboard</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span>Email Template</span>
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
								<!-- BEGIN EXAMPLE TABLE PORTLET-->
								<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption font-dark">
											<i class="icon-settings font-dark"></i>
											<span class="caption-subject bold uppercase"> Manage Email Template</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="table-toolbar">
											<div class="row">
												<div class="col-md-6">
													<div class="btn-group">
														<a href="{{URL::to('emailTemplates/create') }}" ><button id="sample_editable_1_new" class="btn sbold green"> Add New
															<i class="fa fa-plus"></i>
														</button></a>
													</div>
												</div>
											</div>
										</div>
										@if (session('status'))
										<div class="alert alert-success">
											<button class="close" data-close="alert"></button>
											<span> {{ session('status') }} </span>
										</div>					
										@endif											
										<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
											<thead>
												<tr>
													<th>
														<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
															<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
															<span></span>
														</label>
													</th>
													<th> Name </th>
													<th>Subject</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>

											
											<tbody>
											@foreach($emails as $email)
												<tr class="odd gradeX">
													<td>
														<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
															<input type="checkbox" class="checkboxes" value="1" />
															<span></span>
														</label>
													</td>
													<td> {{$email->name}} </td>
													<td> {{$email->subject}} </td>
													<td>
														@if ($email->is_active == 1 )
														<span class="label label-sm label-success"> Active </span>
														@elseif ($email->is_active == 0)
														<span class="label label-sm label-warning"> Inactive </span>
														@else
														<span class="label label-sm label-danger"> Blocked </span>
														@endif
													</td>																									
													<td>
														<div class="btn-group">
															<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
																<i class="fa fa-angle-down"></i>
															</button>
															<ul class="dropdown-menu" role="menu">
																<!--<li>
																	<a href="javascript:;">
																		<i class="icon-docs"></i> View </a>
																</li>-->
																<li>
																	<a href="showEmailTemplate/{{$email->id}}">
																		<i class="fa fa-edit"></i> Edit </a>
																</li>
																<!--<li>
																	<a href="javascript:;">
																		<i class="icon-user"></i> Delete </a>
																</li>-->
																<li class="divider"> </li>
															</ul>
														</div>
													</td>
												</tr>
												@endforeach
												
											</tbody>
										</table>
									</div>
								</div>
								<!-- END EXAMPLE TABLE PORTLET-->
							</div>
						</div>
					<!-- my -->
					</div>
				</div>
			</div>
		</div>	
						
				@include( 'includes.footer' )				 