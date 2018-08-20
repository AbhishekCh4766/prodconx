@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTXU3v_gvBRPJrBhhAne80PKLL3kM38-Y&libraries=places"></script>
  <body>
  <style>
  	.glyphicon-pencil{
  		 margin-right: 20px;
  	}
  </style>
  <!-- top-bar -->
    <div class="post-page main-page">
		
			@include('common.header')

			@include('common.left-menu')

			<div class="mid-page">
			<div class="container">
				<div class="profile-part">
					<div class="row">

						<div class="row_inr_box"> 
							<div class="post-page-right-section_bx">
								@include('common.innerleft-menu')
											
								
							
					
							<div class="modal fade" id="myModal" role="dialog"></div>

						
						
							<div class="col-lg-8 col-xs-8 col-sm-8 profile-common-class">
								<div class="row">
										<div class="right-side">
										
											<div class="row personal-info">
												@if (session('message'))
													<div class="alert alert-success all-success">
														<span> {{ session('message') }} </span>
													</div>					
												@endif											
												<h3>Profile</h3>
												
											<div>
										

												  <!-- Nav tabs -->
												  <ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">PERSONAL INFO</a></li>
													@if(Session::get('user_type_id') == 2)
													<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">EXPERIENCE</a></li>
													<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">EDUCATION</a></li>
													<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">SKILLS</a></li>
													@else
													<li role="presentation"><a href="#services" aria-controls="services" role="tab" data-toggle="tab">SERVICES</a></li>
													@endif
												  </ul>

												  <!-- Tab panes -->
												  <div class="tab-content profile_tabs">
													<div role="tabpanel" class="tab-pane fade in active" id="home">
													<form class="form-horizontal"  method="POST" action="{{URL::to('updateProfile')}}" enctype="multipart/form-data">
													@if(Session::get('delete-experience') != '')
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<div class="alert alert-success all-success">
																	{{Session::get('delete-experience')}}
																</div>
															</div>
														</div>
													</div>
													@elseif(Session::get('delete-education') != '')
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<div class="alert alert-success all-success">
																	{{Session::get('delete-education')}}
																</div>
															</div>
														</div>
													</div>
													@elseif(Session::get('delete-skills') != '')
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<div class="alert alert-success all-success">
																	{{Session::get('delete-skills')}}
																</div>
															</div>
														</div>
													</div>
													@elseif(Session::get('delete-service') != '')
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<div class="alert alert-success all-success">
																	{{Session::get('delete-service')}}
																</div>
															</div>
														</div>
													</div>
													@endif


													<div class="form-group">
														<label class="col-lg-3 control-label" for="InputFirstName">Your Photo</label>
														<div class="col-lg-9">
															<input type="text" class="form-control image-preview-filename" disabled="disabled" style="display:none;"> 
															<span class="input-group-btn">
																image-preview-clear button
																<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
																	<span class="glyphicon glyphicon-remove"></span> Clear
																</button>
																image-preview-input
																<div class="btn btn-default ">
																	
																	<input class="browse-button" type="file" accept="image/png, image/jpeg, image/gif" name="image"/>
																	<input type="hidden" name="_token" value="{{csrf_token()}}" />
																</div>
															</span>
														</div>	
													</div>
													<?php 	if(Session::get('user_type_id') == 2 ) { ?>	
													<div class="form-group">
														<label class="col-lg-3 control-label">First name:</label>
														<div class="col-lg-9">
														  <input class="form-control" value="{{$users->first_name}}" type="text" name="first_name" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-lg-3 control-label">Last name:</label>
														<div class="col-lg-9">
														  <input class="form-control" value="{{$users->last_name}}" type="text" name="last_name">
														  <input class="form-control" value="" type="hidden" name="company_name">													  
														</div>
													</div>
													<div class="form-group">
														<label class="col-lg-3 control-label">Job Title:</label>
														<div class="col-lg-9">
														  <input class="form-control" value="{{$users->job_title}}" type="text" name="job_title">										  
														</div>
													</div>												
													<?php } else { ?>
													<div class="form-group">
														<label class="col-lg-3 control-label">Company Name:</label>
														<div class="col-lg-9">
														  <input class="form-control" value="{{$users->company_name}}" type="text" name="company_name">
														  <input class="form-control" value="" type="hidden" name="first_name">
														  <input class="form-control" value="" type="hidden" name="last_name">
														</div>
													</div> 
													<div class="form-group">
														<label class="col-lg-3 control-label">Job Title:</label>
														<div class="col-lg-9">
														  <input class="form-control" value="{{$users->job_title}}" type="text" name="job_title">										  
														</div>
													</div>											
													<?php } ?>
													<div class="form-group">
														<label class="col-lg-3 control-label">Email:</label>
														<div class="col-lg-9">
														  <input class="form-control" value="{{$users->email}}" type="text" readonly />
														</div>
													</div>
													<?php //echo'<pre>';print_r($users);die; ?>	
													<div class="form-group">
														<label class="col-lg-3 control-label">Location:</label>
														<div class="col-lg-9">
														  <input class="form-control" id="job_location"  type="text" value="{{$users->location }}" name="location" />
														</div>
													</div>
													
													
													<div class="form-group">
														<label class="col-lg-3 control-label">Website:</label>
														<div class="col-lg-9">
														  <input class="form-control"  type="text" value="{{$users->website }}" name="website" placeholder="http://google.com" />
														</div>
													</div>												
													
													<div class="form-group">
														<label class="col-lg-3 control-label">Facebook:</label>
														<div class="col-lg-9">
														  <input class="form-control"  type="text" value="{{$users->facebook_link}}" name="facebook_link" />
														</div>
													</div>
													
													
													<div class="form-group">
														<label class="col-lg-3 control-label">Twitter:</label>
														<div class="col-lg-9">
														  <input class="form-control"  type="text" value="{{$users->twitter_link}}" name="twitter_link" />
														</div>
													</div>
													<div class="form-group">
															<label class="col-lg-3 control-label">Address:</label>
															<div class="col-lg-9">
															  <textarea class="form-control" rows="3" name="address">{{$users->address}}</textarea>
															</div>
														</div>

														<div class="form-group">
														<label class="col-lg-3 control-label">Phone:</label>
														<div class="col-lg-9">
														  <input class="form-control"  type="text" value="{{$users->phone}}" name="phone" />
														</div>
													</div>

													@if(Session::get('user_type_id') == 1)
														<div class="form-group">
															<label class="col-lg-3 control-label">About Us:</label>
															<div class="col-lg-9">
															  <textarea class="form-control" rows="3" name="about_us">{{$users->about}}</textarea>
															</div>
														</div>
													@endif	
													
													<div class="form-group personal-info-buttons">
														<label class="col-md-3 control-label"></label>
														<div class="col-md-9">
															<input class="btn btn-primary" value="Save Changes" type="submit">
															<span></span>
															<a href="{{URL::to('userDashboard')}}" class="btn btn-default" >Cancel</a>
														</div>
													</div>
													
														</form> 
													</div>

													@if(Session::get('user_type_id') == 2)
													<div role="tabpanel" class="tab-pane fade" id="profile">
														@forelse($exp_details as $details)
														<div class="row">
															<div class="col-md-12">
																<div class="list-group mylistgroup">
																	<span class="list-group-item"> <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> {{$details->company_name}} <br>
																	{{$details->start_year}} - {{$details->end_year}} , {{$details->location}}
																	<a href="{{URL::to('edit_exp',$details->id)}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit"></span></a>	
																	<a href="{{URL::to('delete_exp',$details->id)}}"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Delete"></span></a>	
																	</span>
																													
																</div>
															</div>
														</div>

														@empty
															<p class="alert alert-danger">No Data Found!!</p>
														@endforelse
														
														<div class="row">
															<div class="col-md-12">
																<a href="{{URL::to('profile_experience')}}" class="btn btn-default pull-right">Add Experience</a>
															</div>
														</div>
													</div>


													<div role="tabpanel" class="tab-pane fade" id="messages">
														<div class="list-group">
														@forelse ($edu_details as $edudetails)
														<div class="row">
															<div class="col-md-12">
																<div class="list-group mylistgroup">
																	<span class="list-group-item"> <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>
																		{{$edudetails->title}} <br/>
																		{{$edudetails->start_year}} - {{$edudetails->end_year}} , {{$edudetails->location}}
																		<a href="{{URL::to('delete_education',$edudetails->id)}}"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Delete"></span></a>
																		<a href="{{URL::to('edit_education',$edudetails->id)}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit"></span></a>
																	</span>
																</div>
															</div>
															
														</div>
														@empty
															<p class="alert alert-danger">No Data Found!!</p>
														@endforelse
														  
														  
														</div>
														<div class="row" >
															<div class="col-md-12">
																<a href="{{URL::to('profile_education')}}" class="btn btn-default pull-right">Add Education</a>
															</div>
														</div>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="settings">
														
														<div class="list-group">
														@forelse ($skills_details as $skilldetails)
														<div class="row">
															<div class="col-md-12">
																<div class="list-group mylistgroup">
																  <span class="list-group-item">
																	<span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> {{$skilldetails->skill_name}}
																	<br/>
																	<span>{{$skilldetails->skill_desc}}</span>
																	<a href="{{URL::to('delete_skills',$skilldetails->id)}}"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Delete"></span></a>
																	<a href="{{URL::to('edit_skills',$skilldetails->id)}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit"></span></a>
																  </span>
																</div>
															</div>
															
														</div>	
														@empty
															<p class="alert alert-danger">No Data Found!!</p>
														@endforelse
														</div>
														<div class="row">
															<div class="col-md-12">
																<a href="{{URL::to('profile_skills')}}" class="btn btn-default pull-right">Add Skills</a>
															</div>
														</div>
													</div>
													@else
													<div role="tabpanel" class="tab-pane fade" id="services">
														<div class="row text-center">
														@forelse ($service_details as $servedetails)
															<div class="col-md-4">

																<span class="thumbnail service_thumb">
																  <img src="{{URL::to('/servivespics/',$servedetails->image_src)}}" alt="{{$servedetails->title}}">
																  
																  <div class="row">
																	<div class="col-md-12">
																		<span class="serve_title"><a href="{{ URL::to('getservice') }}/{{ $users->username }}/{{ $servedetails->id }}">{{$servedetails->title}}</a></span>
																		<div class="row hidediv">
																			<div class="col-md-6">
																				<a href="{{URL::to('edit_service',$servedetails->id)}}"><button class="btn btn-default btn-edit btn-block" data-toggle="tooltip" data-placement="bottom" title="Edit">
																					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
																				</button></a>
																			</div>
																			<div class="col-md-6">
																				<a href="{{URL::to('delete_service',$servedetails->id)}}" onclick="return confirm('Are you sure you want to delete this service?');"><button class="btn btn-default btn-delete btn-block" data-toggle="tooltip" data-placement="bottom" title="Delete">
																					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
																				</button></a>
																			</div>
																		</div>
																	</div>
																  </div>

																</span>
															</div>
														@empty
															<p class="alert alert-danger">No Services Found!!</p>
														@endforelse
														</div>
														<div class="row">
															<div class="col-md-12">
																<a href="{{URL::to('profile_services')}}" class="btn btn-default pull-right">Add Service</a>
															</div>
														</div>
													</div>
													@endif
												  </div>

												</div>
												
											</div>
											 
										</div>	
									</div>	
							</div>
							<div class="rightsidebar">
								<div class="fixed fixed-two">@include('common.header-menu')</div>
							</div>
						</div>	
					</div>
				</div>
 
				</div> <!-- profile-part -->
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
<script>
	$(".all-success").fadeTo(2000, 500).slideUp(500, function(){
	    $(".all-success").slideUp(500);
	});
	$('[data-toggle="tooltip"]').tooltip();
</script>
<script>
    	function initialize() {
		  var input = document.getElementById('job_location');
		  new google.maps.places.Autocomplete(input);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
</script>
  </body>
  </html>