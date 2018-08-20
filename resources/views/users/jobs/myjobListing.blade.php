@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
					
						

						<div class="col-lg-8 col-xs-8 col-sm-8 jobs-common-class rental-common-class job-posting-common-class middle-section">
							<div class="row">
									<div class="right-side">
									
										<div class="row personal-info">
										
										<div class="heading-search">
											<h3>My Jobs</h3>
											
	                                            <div class="filter-div listing">
	                                            <input class="form-control" type="search" placeholder="Search By Job Title" id="search-here" >
												  <select class="form-control fliter-category" id="sel1">
													<option value="">Select Category</option>
													@foreach($jobCat as $val)
														<option value="{{$val->cat_name}}">{{$val->cat_name}}</option>
													@endforeach	
													
												  </select>

													
													<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">	
												</div>
											
										</div>
										
																			
									<div class="row joblistingstatus" style="display: none;">
										<div class="col-md-12">
											<div class="alert alert-success">
												<span> Job Post Successfully!! </span>
											</div>
										</div>
									</div>
									 <div class="project-section"> 
									 @if (session('message'))
										<div class="alert alert-success">
											<span> {{ session('message') }} </span>
										</div>					
									@endif	
										<ul class="drama searchjobs">
										<?php if(!empty($jobPost)) {  ?>
										@foreach($jobPost as $val)
											<li id="{{$val->id}}">
													<div class="actress box" >
														<a href="viewJob/{{$val->id}}" >
														<div class="details">
														<div class="e-mail-actress" style="width:90%;" ><?php if($val->image){?><span><img src="{{ URL::asset('jobpostimage/')}}/{{$val->image}}" class="img-thumbnail"  width="100" height="100" /> </span> <?php }else{ ?><span><img src="<?php echo asset('front-end/images/logo2.png')?>"/></img></span> <?php } ?><div class="details-text-box"> <p><b>{{$val->job_title}}</b><br/>Job Location : {{$val->job_location}}<br/>Job Cat : {{$val->job_cat}}<br><?php echo $val->job_description; ?></p>
														</div>
												       </div>
														</div>
														</a>
														<ul class="icon-text">
															<li class="like" style="padding: 0px;float: right;width: auto;margin-left: 25px;">
																<input type="hidden" id="job_id" value="{{$val->id}}">

																<a class="share_job" style="cursor: pointer"><i class="fa fa-share-alt"></i> Share this job</a>
															</li>
														</ul>
														<div class="project-page-dots">
															
																<ul class="edit-remove">

																	<li id="delete-li" >
																		<button alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myDeleteModal">Remove Job
																		</button>
																		<a href="{{ url('/editjob') }}/{{$val->id}}"><i class="fa fa-pencil"></i></a>
																	<input type="hidden" id="delete-item" name="delete-item" value="">
																	</li>
																</ul>																
															
														</div>
													</div>
												</li>
											@endforeach	
										<?php } else { ?>

											<li>No Job Found</li>
										<?php } ?>		
											
										</div>
										
									</div>	

								</div>	

						</div>
						          
					</div> <!-- row -->
					<div class="rightsidebar">
						<div class="fixed fixed-two">@include('common.header-menu')</div>
					</div>

					
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
						var route = "searchJobs";
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
								alert("Fail");
								//$('#'+item).remove();
							},
						});				
			}else{
				var search = $('#search-here').val();	
					var token = document.getElementById('token').value;								
						var route = "searchJobs";
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
								alert("Fail");
								//$('#'+item).remove();
							},
						});						
			}
			
		});	

		$(".fliter-category").change(function(){
			search = $(this).val();
			var token = document.getElementById('token').value;								
			var route = "searchJobsByCat";
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
					alert("Fail");
					//$('#'+item).remove();
				},
			});
		});	
		
		$('.share_job').click(function(){
			var job_id = $(this).parent().find('#job_id').val();
			var token = document.getElementById('token').value;					

			var route = "shareJobById";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: job_id
				},
				success: function(data) {
					//$('.searchjobs').empty();
					//$('.searchjobs').html(data);
					//console.log(data);
					$("html, body").animate({ scrollTop: "100px" },1000);
					$('.joblistingstatus').css('display','block');
				}
			});
		});
	</script>		
  </body>
  </html>