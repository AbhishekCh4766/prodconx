@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js"></script>
<!-- <script src="https://www.kataateeb.com/assets/global/plugins/ckeditor/ckeditor.js"></script> -->
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
	CKEDITOR.replace('job_decription');
</script>
        <link rel="stylesheet" href="{{ URL::asset('front-end/css/fastselect.min.css')}}">
        <script src="{{ URL::asset('front-end/js/fastselect.standalone.js')}}"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTXU3v_gvBRPJrBhhAne80PKLL3kM38-Y&libraries=places"></script>
        <script src="{{ URL::asset('front-end/js/script.js')}}"></script>
        <link rel="stylesheet" href="{{ URL::asset('front-end/css/multiupload.css')}}">		
        <style>

            .fstElement { font-size: 1.2em; }
            .fstToggleBtn { min-width: 16.5em; }

            .fstMultipleMode { display: block; }
            .fstMultipleMode .fstControls { width: 100%; }
			.attireMainNav{ display:none !important;}
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
							</div>
						</div>
					
						
						
						<div class="col-lg-9 col-xs-9 col-sm-9 add-a-job-section rental-common-class" style="width: 77%;">
							<div class="row">
									<div class="right-side">
									@include('common.header-menu')
										<div class="row personal-info">
									@if (session('message'))
										<div class="alert alert-success myalert">
											<span> {{ session('message') }} </span>
										</div>					
									@endif											
											<h3>Add Rental Item</h3>
										
											<form class="form-horizontal rental-form"  method="POST" action="{{URL::to('saveRental')}}" enctype="multipart/form-data">
																				
												<div class="form-group">
													<label class="col-lg-3 control-label">Rental Item</label>
													<div class="col-lg-8">
													  <input class="form-control"  type="text" name="company_name" >
													</div>
												</div>	
												<div class="form-group">
													<label class="col-lg-3 control-label">Description</label>
													<div class="col-lg-8">
													  <textarea class="form-control ckeditor" rows="8" id="job_decription" name="job_decription"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Item Photos</label>
													<div class="col-lg-8">
														<div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
											   
														<input type="button" id="add_more" class="upload" value="Add More Image"/>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-lg-3 control-label">Price</label>
													<div class="col-lg-8">
													  <input class="form-control"  type="text" name="company_price" >
													</div>
												</div>		
												<div class="form-group">
													<label class="col-lg-3 control-label">Location</label>
													<div class="col-lg-8">
													  <input class="form-control" id="job_location" type="text" name="job_location">
													</div>
												</div>												
												<div class="form-group">
													<label class="col-lg-12 control-label" style="color: #0360e0;font-size:20px;">Contact details</label>
												</div>													
												<div class="form-group">
													<label class="col-lg-3 control-label">Contact Name</label>
													<div class="col-lg-8">
													  <input class="form-control"  type="text" name="contact_name" >
													</div>
												</div>													
												<div class="form-group">
													<label class="col-lg-3 control-label">Contact Number</label>
													<div class="col-lg-8">
													  <input class="form-control"  type="text" name="contact_no" >
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Contact Email</label>
													<div class="col-lg-8">
													  <input class="form-control"  type="text" name="contact_email" >
													</div>
												</div>	
												<div class="form-group">
													<label class="col-lg-3 control-label">Website</label>
													<div class="col-lg-8">
													  <input class="form-control"  type="text" name="website" placeholder="Http://google.com">
													  <input type="hidden" value="{{ csrf_token() }}" name="_token" />
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
						
					</div> <!-- row -->
					
				</div> 
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/add-rental-post.min.js')}}" type="text/javascript"></script>
    <script>
    	function initialize() {
		  var input = document.getElementById('job_location');
		  new google.maps.places.Autocomplete(input);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
  </html>