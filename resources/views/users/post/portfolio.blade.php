@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <body>
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
					
						</div>
						
							<!-- 	<div class="banner-image">
									<img src="{{ URL::asset('/assets/logo/sample1.jpg')}}" style="height: 400px; width: 1000px;">
								
										
						<div class="profile_pic">
							<img src="{{ URL::asset('profilepics')}}/{{ $user_data->profile_pic }}" style="width: 200px; border-radius: 100px; border: 1px solid #ddd; ">
						</div>					
				             </div>	 -->
								
									
						<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class Rental-box user-profile-page">
							<div class="row">
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
											    <table class="form-horizontal" >
											   


												<div class="form-group">
													
																<input type="hidden" name="_token" value="{{csrf_token()}}" />
															</div>
														</span>
													</div>	
												</div>
												<?php 	if(Session::get('user_type_id') == 2 ) { ?>	
												<div class="form-group">
													<label class="col-lg-3 control-label">First name:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" value="{{$user_data->first_name}}" readonly="">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Last name:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" value="{{$user_data->last_name}}" type="text" readonly name="last_name">
													  <input class="form-control" value="" type="hidden" name="company_name" readonly>													  
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Job Title:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" value="{{$user_data->job_title}}" type="text" name="job_title" readonly>										  
													</div>
												</div>												
												<?php } else { ?>
												<div class="form-group">
													<label class="col-lg-3 control-label">Company Name:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" value="{{$user_data->company_name}}" type="text" name="company_name" readonly>
													 
													</div>
												</div> 
												<div class="form-group">
													<label class="col-lg-3 control-label">Job Title:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" value="{{$user_data->job_title}}" type="text" name="job_title" readonly>										  
													</div>
												</div>											
												<?php } ?>
												<div class="form-group">
													<label class="col-lg-3 control-label">Email:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" value="{{$user_data->email}}" type="text" readonly />
													</div>
												</div>
												<?php //echo'<pre>';print_r($user_data);die; ?>	
												<div class="form-group">
													<label class="col-lg-3 control-label">Location:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control" id="job_location"  type="text" value="{{$user_data->location }}" name="location" readonly />
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Website:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control"  type="text" value="{{$user_data->website }}" name="website" readonly />
													</div>
												</div>												
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Facebook:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control"  type="text" value="{{$user_data->facebook_link}}" name="facebook_link" readonly />
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Twitter:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control"  type="text" value="{{$user_data->twitter_link}}" name="twitter_link" readonly />
													</div>
												</div>
												<div class="form-group">
														<label class="col-lg-3 control-label">Address:</label>
														<div class="col-lg-8 nopaddingright">
														  <textarea class="form-control" rows="3" name="address" readonly>{{$user_data->address}}</textarea>
														</div>
													</div>

													<div class="form-group">
													<label class="col-lg-3 control-label">Phone:</label>
													<div class="col-lg-8 nopaddingright">
													  <input class="form-control"  type="text" value="{{$user_data->phone}}" name="phone" readonly />
													</div>
												</div>

												@if(Session::get('user_type_id') == 1)
													<div class="form-group">
														<label class="col-lg-3 control-label">About Us:</label>
														<div class="col-lg-8 nopaddingright">
														  <textarea class="form-control" rows="3" name="about_us" readonly>{{$user_data->about}}</textarea>
														</div>
													</div>
												@endif	
												
												
													</table> 
											    </div>

												@if(Session::get('user_type_id') == 2)
											    <div role="tabpanel" class="tab-pane fade" id="profile">
											    	@forelse($exp_details as $details)
											    	<div class="row">
												    	<div class="col-md-12">
												    		<div class="list-group mylistgroup">
														  		<span class="list-group-item"> <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> {{$details->company_name}} <br>
														  		{{$details->start_year}} - {{$details->end_year}} , {{$details->location}}
														  		
														  		</span>
														  														
														  	</div>
												    	</div>
											    	</div>

													@empty
													   <h3>No Data Found</h3>
													@endforelse
													
													
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
															    	
															  	</span>
														  	</div>
														</div>
														
													</div>
													@empty
													    <h3>No Data Found</h3>
													@endforelse
													  
													  
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
															   
															  </span>
															</div>
														</div>
														
													</div>	
													@empty
													   <h3>No Data Found</h3>
													@endforelse
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
														      		<span class="serve_title"><a href="{{ URL::to('getservice') }}/{{ $user_data->username }}/{{ $servedetails->id }}">{{$servedetails->title}}</a></span>
														      		
														      	</div>
														      </div>

														    </span>
											    		</div>
											    	@empty
														   <h3>No Data Found</h3>
													@endforelse
											    	</div>
									
						      </div>
									@endif
										
		
                   

					</div>
					
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
      </div>
      
    </div>
    </div>

					
				</div> <!-- profile-part -->
				
			</div> <!--  mid-page  -->

					<div class="rightsidebar">
						<div class="fixed fixed-two">
							@if($user_data->user_type_id == 1)
								<div class="row individual-group-section right-address">
									<div class="col-lg-2 col-xs-2 col-sm-2 groups address_heading">
										<div class="friends-section">
											<p class="profile-setting">	Headquarters Location</p>
										</div>
									</div>
									@if($user_data->address != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<strong>Address:</strong> {{ $user_data->address }}
									</div>
									@endif

									@if($user_data->phone != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <a href="tel:{{ $user_data->phone }}">{{ $user_data->phone }}</a>
									</div>
									@endif

									@if($user_data->email != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:{{ $user_data->email }}">{{ $user_data->email }}</a>
									</div>
									@endif
									
									@if($user_data->location != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> {{ $user_data->location }}
									</div>
									@endif
								</div>
							@elseif($user_data->user_type_id == 2)

								<div class="row individual-group-section right-address ">
									<div class="col-lg-12 col-xs-12 col-sm-12 groups address_heading">
										<div class="friends-section">
											<p class="profile-setting">	Contact Information</p>
										</div>
									</div>
									@if($user_data->address != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups ">
										<strong>Address:</strong> {{ $user_data->address }}
									</div>
									@endif

									@if($user_data->phone != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <a href="tel:{{ $user_data->phone }}">{{ $user_data->phone }}</a>
									</div>
									@endif

									@if($user_data->email != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:{{ $user_data->email }}">{{ $user_data->email }}</a>
									</div>
									@endif
									
									@if($user_data->location != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> {{ $user_data->location }}
									</div>
									@endif
								</div>
							@endif
						</div>	
                   </div>
		</div>
	</div>
  