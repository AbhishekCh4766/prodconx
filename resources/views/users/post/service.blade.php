@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>.serveimg{width:100%;height:140px;}</style>
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
						
									
										
											
											
									
									<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class Rental-box">
							<div class="row">
									<div class="right-side">
									
									<div class="common-content-inner">
										<div class="company-about-section common-content-section">
										@forelse($serviceDetails as $data)
											<h4>Service </h4>
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-4">
															<img class="img-responsive img-thumbnail serveimg" src="{{ Url::to('/servivespics') }}/{{ $data->image_src }}" alt="Services">
															<div class="row text-center">
																<div class="col-md-12">
																	{{ $data->title }}
																</div>
															</div>
														</div>
														<div class="col-md-8">
															{{ $data->description }}
														</div>
													</div>
												</div>
											</div>
										@empty
											<p>No Data Found!!</p>
										@endforelse
										</div>
									</div>	
								</div>	
								</div>
						
					</div> 
						<div class="col-lg-2">
					
						
							@if($users->user_type_id == 1)
								<div class="row individual-group-section right-address">
									<div class="col-lg-12 col-xs-12 col-sm-12 groups address_heading">
										<div class="friends-section">
											<p class="profile-setting">	Headquarters Location</p>
										</div>
									</div>
									@if($users->address != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<strong>Address:</strong> {{ $users->address }}
									</div>
									@endif

									@if($users->phone != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <a href="tel:{{ $users->phone }}">{{ $users->phone }}</a>
									</div>
									@endif

									@if($users->email != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:{{ $users->email }}">{{ $users->email }}</a>
									</div>
									@endif
									
									@if($users->location != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> {{ $users->location }}
									</div>
									@endif
								</div>
							@elseif($users->user_type_id == 2)
								<div class="row individual-group-section right-address">
									<div class="col-lg-12 col-xs-12 col-sm-12 groups address_heading">
										<div class="friends-section">
											<p class="profile-setting">	Contact Information</p>
										</div>
									</div>
									@if($users->address != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<strong>Address:</strong> {{ $users->address }}
									</div>
									@endif

									@if($users->phone != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <a href="tel:{{ $users->phone }}">{{ $users->phone }}</a>
									</div>
									@endif

									@if($users->email != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:{{ $users->email }}">{{ $users->email }}</a>
									</div>
									@endif
									
									@if($users->location != '')
									<div class="col-lg-12 col-xs-12 col-sm-12 groups">
										<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> {{ $users->location }}
									</div>
									@endif
								</div>
							@endif

				
						</div>
					</div>

					
				</div> <!-- profile-part -->
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
  </body>
  </html>