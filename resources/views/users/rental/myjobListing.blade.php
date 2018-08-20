@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <body>
  	<style>
  		.e-mail-actress > p{
  			padding:0px !important;
  			margin-left: 5px;
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
								<div class="common-right-section">
								@include('common.header-menu')
								
								
								
							</div>	
							</div>
						</div>
						
						
						<div class="col-lg-9 col-xs-9 col-sm-9 rental-common-class">
							<div class="row">
									<div class="right-side">
									@include('common.header-menu')

										<div class="row personal-info">
										
										<div class="heading-search">
											<h3>My Rental Items</h3>
												<input class="form-control" type="search" placeholder="Search" id="search-here" >
												<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
										</div>
										
									@if (session('message'))
										<div class="alert alert-success">
											<span> {{ session('message') }} </span>
										</div>					
									@endif											
										
									 <div class="project-section"> 
										<ul class="drama searchjobs">
										
										
										<?php //echo '<pre>'; print_r($rental_job);die; ?>
										
										<?php if(!empty($rental_job)) { ?>
										@foreach($rental_job as $val)

											<li>
												<a href="viewRental/{{$val->id}}" >
													<div class="actress">
														<div class="details">
															<div class="rental-items-image"><img src="{{ URL::asset('rentalgallary')}}/<?php echo $val->image[0]->image; ?>" /></div>
															<div class="e-mail-actress">
																<p>
																	<span style="width: 100%; float: left;"><b style="float: left; width: 65%;">{{$val->item_name}}</b><font style="float: right; width: 33%; text-align: right;">Price: ${{$val->price}}</font></span>
																	<br/>
																	Item Location : {{$val->location}}
																	<br/>
																	<?php //echo $val->item_desc; ?>
																</p>
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
					
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
			
					
				</div> <!-- profile-part -->
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
	<script>

		$('body').on('click','#delete-li button', function(e) {				
					var alt = $(this).attr("alt")
					var token = document.getElementById('token').value;
						var route = "deleteJob";
						$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'html',
							data: {
								data: alt
							},
							success: function(data) {
								$('#myDeleteModal').html(data);
								$('#delete-item').val(alt);
								},
							error: function(data) {
								alert("Fail");
							},
						});
			});	
		$('body').on('click','#submit-job', function(e) {
					var item = document.getElementById('delete-item').value;
					var token = document.getElementById('token').value;					
						var route = "deleteMyJob";
						$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'html',
							data: {
								data: item
							},
							success: function(data) {
								$('#'+item).remove();
								},
							error: function(data) {
								alert("Fail");
								//$('#'+item).remove();
							},
						});
		});				
	</script>
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
  </body>
  </html>