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
		#image-holder img {
			height:100px;
			width:100px;
			
		}
		
	</style>	

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <div class="page-content-wrapper">
		<div class="page-content" style="margin-left:0px !important;">

                    <div class="portlet light portlet-fit bordered">
                        
                        <div class="portlet-body">
                            <div class="pricing-content-1">
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
								
								
									<form class="register-form" action="{{URL::to('myProfile')}}" method="post" enctype="multipart/form-data" >
										<h3>My Profile</h3>
										<p>You can update profile here: </p>
										<div class="form-group">
											<label class="control-label visible-ie8 visible-ie9">First Name</label>
											<div class="input-icon">
												<i class="fa fa-font"></i>
												<input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="first_name" id="first_name" value="{{$users->first_name}}" /> 
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												</div>
										</div>
										<div class="form-group">
											<label class="control-label visible-ie8 visible-ie9">Last Name</label>
											<div class="input-icon">
												<i class="fa fa-font"></i>
												<input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="last_name" id="last_name" value="{{$users->last_name}}" /> </div>
										</div>

										<div class="form-group">
											<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
											<label class="control-label visible-ie8 visible-ie9">Phone</label>
											<div class="input-icon">
												<i class="fa fa-phone"></i>
												<input class="form-control placeholder-no-fix" type="text" size="13" placeholder="Phone" name="phone" id="phone" value="{{$users->phone}}" /> </div>
										</div>
										<div class="form-group">
											<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
											<label class="control-label visible-ie8 visible-ie9">Birth Date</label>
											<div class="input-icon">
												<i class="fa fa-table"></i>
												<input class="form-control date-picker" name="birth_date" placeholder="Birth Date" size="16" type="text" value="" value="{{$users->birth_date}}" />
											</div>
										</div>													
										<div class="form-group">
											<label class="control-label visible-ie8 visible-ie9">Profile Pic</label>
											<div class="controls">
												<div class="input-icon">
													<input type="file" name="image" id="fileUpload" />	
													<div id="image-holder"> </div>		
											</div>
											</div>	
										</div>	

										<div class="form-actions">
											<a href="{{URL::to('userDashboard') }}"> <button id="register-back-btn" type="button" class="btn red btn-outline"> Back </button></a>
											<button type="submit" id="register-submit-btn" class="btn green pull-right"> Update </button>
										</div>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
			</div>	

			
				@include( 'includes.footer' )	
		<script>
		$("#fileUpload").on('change', function () {
		 
				if (typeof (FileReader) != "undefined") {
		 
					var image_holder = $("#image-holder");
					image_holder.empty();
		 
					var reader = new FileReader();
					reader.onload = function (e) {
						$("<img />", {
							"src": e.target.result,
							"class": "thumb-image"
						}).appendTo(image_holder);
		 
					}
					image_holder.show();
					reader.readAsDataURL($(this)[0].files[0]);
				} else {
					alert("This browser does not support FileReader.");
				}
			});
		</script>				