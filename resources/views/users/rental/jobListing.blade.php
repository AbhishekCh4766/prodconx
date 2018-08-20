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
						
						<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class Rental-box">
							<div class="row">
									<div class="right-side">
									
										<div class="row personal-info">
										
											<div class="heading-search">
												<h3>Rental Item Listing</h3>
												<input class="form-control" type="search" placeholder="Search" id="search-here" >
												<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                                 <!--<input class="search-button-heading"id="submit" type="submit" value="">-->											
												
											</div>
										<div class="row">
											<div class="col-md-12">
												@if (session('message'))
												<div class="alert alert-success success-alert">
													<span> {{ session('message') }} </span>
												</div>					
												@endif
											</div>
										</div>
																				
									 <div class="project-section"> 
										<ul class="drama searchjobs">
										<?php if(!empty($rental_job)) { ?>
										@foreach($rental_job as $val)

											<li>
												<a href="viewRental/{{$val->id}}" >
													<div class="actress">
														<div class="details">
															<div class="rental-items-image">
																<img class="img-thumbnail rental-thumb" src="{{ URL::asset('rentalgallary')}}/<?php echo $val->image[0]->image; ?>" />
															</div>
															<div class="e-mail-actress"><p><b>{{$val->item_name}}</b><br/>Item Location : {{$val->location}}<br/><?php //echo $val->item_desc; ?></p>
															</div>
														</div>
													</div>
												</a>	
											</li>	
											@endforeach	
										<?php } else { ?>
										

											<li>No Item Found</li>
										<?php } ?>		
										</ul>	
										</div>
										 
									</div>	
								</div>	
						</div>
						
					</div> <!-- row -->
					<div class="rightsidebar">
						<div class="fixed fixed-two">@include('common.header-menu')</div>
					</div>
					
					</div>
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

	
		</div>
	</div>
	
	<script>
		$("#search-here").keyup(function(e){ 
			var code = e.which; // recommended to use e.which, it's normalized across browsers
			if(code==13){
					var search = $('#search-here').val();	
					var token = document.getElementById('token').value;								
						var route = "searchRental";
						$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'html',
							data: {
								data: search
							},
							success: function(data) {
								$('.searchjobs').empty();
								$('.searchjobs').html(data);
								},
							error: function(data) {
								//alert("Fail");
								//$('#'+item).remove();
							},
						});				
			}else{
				var search = $('#search-here').val();	
					var token = document.getElementById('token').value;								
						var route = "searchRental";
						$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'html',
							data: {
								data: search
							},
							success: function(data) {
								$('.searchjobs').empty();
								$('.searchjobs').html(data);
								},
							error: function(data) {
								//alert("Fail");
								//$('#'+item).remove();
							},
						});						

			}
			
		});		
	</script>	
	<script>
		$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
		    $(".success-alert").slideUp(500);
		});
	</script>
  </body>
  </html>