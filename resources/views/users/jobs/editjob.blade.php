@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js"></script>

        <link rel="stylesheet" href="{{ URL::asset('front-end/css/fastselect.min.css')}}">
        <script src="{{ URL::asset('front-end/js/fastselect.standalone.js')}}"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTXU3v_gvBRPJrBhhAne80PKLL3kM38-Y&libraries=places"></script>
        <style>

            .fstElement { font-size: 1.2em; }
            .fstToggleBtn { min-width: 16.5em; }

            .fstMultipleMode { display: block; }
            .fstMultipleMode .fstControls { width: 100%; }
			.attireMainNav{ display:none !important;}
			.checkbox label input[type="checkbox"]{
				display: block !important;
				height: 0px;
				width: 0px;
			}
        </style>

		
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
									
							
								<div class="col-lg-8 col-xs-8 col-sm-8 add-a-job-section jobs-common-class middle-section">
									<div class="row">
											<div class="right-side">
											
												<div class="row personal-info">
											@if (session('message'))
												<div class="alert alert-success">
													<span> {{ session('message') }} </span>
												</div>					
											@endif											
													<h3>Add Job</h3>
												
													<form class="form-horizontal register-form"  method="POST" action="{{URL::to('updatejob')}}/{{ $details->id }}" enctype="multipart/form-data" >
														{{ csrf_field() }}
														<div class="form-group">
															<label class="col-lg-3 control-label">Job Title</label>
															<div class="col-lg-8">
															  <input class="form-control"  type="text" name="job_title"  value="{{ $details->job_title }}">
															</div>
														</div>											
														<!-- <div class="form-group add-job-category">
															<label class="col-lg-3 control-label">Job Category</label>
															<div class="col-lg-8">
															<input type="hidden" name="_token" value="{{csrf_token()}}" />
															<select class="multipleSelect1 form-control" multiple name="category[]">
																@foreach($jobCat as $cat)
																<option value="{{$cat->cat_name}}" >{{$cat->cat_name}}</option>
																@endforeach	
															</select>
																	<script>
														
																		$('.multipleSelect1').fastselect();
														
																	</script>
															</div>
														
														</div> -->
														<div class="form-group">
															<label class="col-lg-3 control-label">Item Photo</label>
															<div class="col-lg-8">
																<div id="filediv"><input name="file" type="file" id="file"/></div><br/>
																@if($details->image != '')
																	<img src="{{ asset('/jobpostimage') }}/{{ $details->image }}" alt="Job Image" style="width: 150px;height: 150px;">
																@endif 
															</div>
														</div>
														<div class="form-group" style="display:none" >
															<label class="col-lg-3 control-label">Job Status</label>
															<div class="col-lg-8">
															<select class="multipleSelect1 form-control"  name="is_active">
																<option <?php if($details->status == 1){ echo 'selected'; } ?> value="1" >Active</option>
																<option <?php if($details->status == 0){ echo 'selected'; } ?> value="0" >Inactive</option>
															</select>
															</div>
														</div>									
														<div class="form-group">
															<label class="col-lg-3 control-label">Contact Name</label>
															<div class="col-lg-8">
															  <input class="form-control"  type="text" name="contact_name" value="{{ $details->contact_name }}">
															</div>
														</div>		
														<div class="form-group">
															<label class="col-lg-3 control-label">Phone Number</label>
															<div class="col-lg-8">
															  <input class="form-control"  type="text" name="phone_no" value="{{ $details->contact_phone }}">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Contact Email</label>
															<div class="col-lg-8">
															  <input class="form-control"  type="text" name="contact_email" value="{{ $details->contact_email }}">
															</div>
														</div>													
														<div class="form-group">
															<label class="col-lg-3 control-label">Job Location</label>
															<div class="col-lg-8">
															  <input class="form-control" type="text" name="job_location" value="{{ $details->job_location }}" id="job_location">
															</div>
														</div> 													
														<!-- <div class="form-group">
															<label class="col-lg-3 control-label">Postal code</label>
															<div class="col-lg-8">
															  <input class="form-control" type="text" name="postal_code">
															</div>
														</div> --> 												
														<div class="form-group">
															<label class="col-lg-3 control-label">Job Description</label>
															<div class="col-lg-8">
															  <textarea class="form-control" rows="8" id="comment" name="job_decription">{{ $details->job_description }}</textarea>
															</div>
														</div>

														<div class="form-group">
															<div class="col-lg-8 col-lg-offset-3">
																<div class="checkbox">
																	<label>
																	  <input <?php if($details->post_to_profile == 1){ echo 'checked'; } ?>  type="checkbox" name="post_to_profile"> Post to Profile
																	</label>
																</div>
															</div>
														</div> 
																							
														<div class="form-group personal-info-buttons">
															<label class="col-md-3 control-label"></label>
															<div class="col-md-8">
																<input class="btn btn-primary" value="Save Changes" type="submit">
																<span></span>
																<a href="{{URL::to('userDashboard')}}" class="btn btn-default" >Cancel</a>
															</div>
														</div>
														
													</form>
													
												</div>
												 
											</div>	
										</div>	
								</div>
								<div class="rightsidebar">
									<div class="fixed fixed-two">@include('common.header-menu')</div>
								</div>
							</div>	
					</div> <!-- row -->
					
				</div> 
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/job-post.min.js')}}" type="text/javascript"></script>	
    <script>
    	function initialize() {
		  var input = document.getElementById('job_location');
		  new google.maps.places.Autocomplete(input);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
  </html>