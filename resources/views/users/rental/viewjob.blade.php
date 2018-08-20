@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/normalize.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.min.css"/>

    <link rel="stylesheet" href="{{ URL::asset('front-end/css/document.css')}}"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

    <script type="text/javascript" src="{{ URL::asset('front-end/js/document.js')}}"></script>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5ad8645822309d0013d4ef2c&product=custom-share-buttons"></script>		
  <body>
  <!-- top-bar -->
  <style>
  	.job-description li {
	    list-style: inherit !important;
	}
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
						<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class">
							<div class="row">
									<div class="right-side">
									
										<div class="row personal-info">
									@if (session('message'))
										<div class="alert alert-success">
											<span> {{ session('message') }} </span>
										</div>					
									@endif											

										
											<div class="job-portal">
													
															<div class="row">
														
																	<div class="col-lg-12 col-xs-12 col-sm-12 backend">
																	<h3>{{$rental_job->item_name}}</h3>
																	</div>

																	<div id="owl-demo" class="owl-carousel owl-theme">
																		<?php 																
																		for($i=0;$i<count($rental_job->image);$i++){
																		?>	       																										<div class="item"><img class="img-thumbnail" src="{{ URL::asset('rentalgallary')}}/<?php echo $rental_job->image[$i]->image; ?>"></div>

																			
																		<?php } ?>

																	</div>																		

																		<div class="col-lg-12 col-xs-12 col-sm-12 job-description">
																		<h4>Item Description</h4>
																		<p>{!! $rental_job->item_desc !!}</p>
																		<ul class="contact-job"><p>Contact Details</p>
																		<li class="address-job">{{$rental_job->contact_name}}</li>
																		<li class="phone-job">{{$rental_job->contact_number}}</li>
																		<li class="e-mail-job">{{$rental_job->contact_email}}</li>
																		</ul>
																		<h4 style="margin-top: 20px;">Share this product:</h4>
														<div data-network="twitter" class="st-custom-button">Twitter</div>
									                    <div data-network="facebook" class="st-custom-button">Facebook</div> 
									                    <div data-network="googleplus" class="st-custom-button">GooglePlus</div> 
									                    <div data-network="whatsapp" class="st-custom-button">Whatsapp</div>
									                    <div data-network="linkedin" class="st-custom-button">Linkedin</div> 
																		</div>
																			<div class="col-lg-12 col-xs-12 col-sm-12 submit-job">
																			<!--<button type="submit" form="form1" value="Submit">Apply</button> -->
																			</div>
															</div>
 													
											</div>
											
										</div>
										 
									</div>	
								</div>
									
						</div>
				
					</div>
					<div class="rightsidebar">
@include('common.header-menu')
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