@include('common.head')
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5ad8645822309d0013d4ef2c&product=custom-share-buttons"></script>
<style>
.st-custom-button[data-network] {
   background-color: #0adeff;
   display: inline-block;
   padding: 5px 10px;
   cursor: pointer;
   font-weight: bold;
   color: #fff;

   &:hover, &:focus {
      text-decoration: underline;
      background-color: #00c7ff;
}
</style>
<body>
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
							

								<div class="col-lg-8 col-xs-8 col-sm-8 jobs-common-class rental-common-class job-posting-common-class middle-section">
									<div class="row">
										<div class="right-side" style="padding: 0;">
											<div class="row personal-info">
												@if (session('message'))
													<div class="alert alert-success">
														<span> {{ session('message') }} </span>
													</div>					
												@endif											
												<div class="job-portal">
													<div class="row">
														<div class="col-lg-12 col-xs-12 col-sm-12 backend">
															<h3>{{$data->job_title}}</h3>
														</div>

														<div class="col-lg-12 col-xs-12 col-sm-12 job-description">
															<h4>Job Description</h4>
															<p><?php echo $data->job_description; ?></p>
															<ul class="contact-job"><p>Contact Details</p>
																<li class="phone-job">{{$data->contact_phone}}</li>
																<li class="address-job">{{$data->job_location}}</li>
																<li class="e-mail-job">{{$data->contact_email}}</li>
															</ul>
															<h4 style="margin-top: 20px;">Share this job:</h4>
															<!-- <div data-network="twitter" class="st-custom-button"><i class="fa fa-twitter" aria-hidden="true"></i></div>
															<div data-network="facebook" class="st-custom-button"><i class="fa fa-facebook" aria-hidden="true"></i></div> 
															<div data-network="googleplus" class="st-custom-button"><i class="fa fa-google-plus" aria-hidden="true"></i></div> 
															<div data-network="whatsapp" class="st-custom-button"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
															<div data-network="linkedin" class="st-custom-button"><i class="fa fa-linkedin" aria-hidden="true"></i></div> -->
															<div data-network="twitter" class="st-custom-button"><img src="../front-end/images/Twitter.png"></div>
															<div data-network="facebook" class="st-custom-button"><img src="../front-end/images/Facebook.png"></div> 
															<div data-network="googleplus" class="st-custom-button"><img src="../front-end/images/Google+.png"></div> 
															<div data-network="whatsapp" class="st-custom-button"><img src="../front-end/images/WhatsApp.png"></div>
															<div data-network="linkedin" class="st-custom-button"><img src="../front-end/images/Linkedin.png"></div> 
														</div>
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
						
					</div> <!-- row -->
				</div> 
			</div> <!--  mid-page  -->
		</div>
	</div>
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
<script src="{{ URL::asset('assets/pages/scripts/job-post.min.js')}}" type="text/javascript"></script>	
</body>
</html>