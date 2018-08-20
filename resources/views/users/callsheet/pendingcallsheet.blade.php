@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>
		

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
							<div class="common-right-section">
								
								
								
								
							</div>
						</div>
						
						<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class job-posting-common-class boxProject">
							<div class="row">
								<div class="right-side">
										<!---@include('common.header-menu')--->
										<div class="project-name">
											<p><a href="javascript:;" >Pending CallSheets</a></p>
										
										</div>
										@if (session('status'))
										<div class="alert alert-success">
											<button class="close" data-close="alert"></button>
											<span> {{ session('status') }} </span>
										</div>					
										@endif										
									 <div class="project-section"> 
									<ul class="drama">
										
										<?php if(!empty( $callsheet ) ) {  ?>
										@foreach($callsheet as $val)
											<li>
													<div class="actress">
														
														<div class="details">
														<div class="calendar-box">
															
															<?php 
															
															$date_month = explode("-",$val->date);
															
															if($date_month[1] == 1)
																$month = 'JAN';
															if($date_month[1] == 2)
																$month = 'FEB';	
															if($date_month[1] == 3)
																$month = 'MAR';	
															if($date_month[1] == 4)
																$month = 'APR';	
															if($date_month[1] == 5)
																$month = 'MAY';	
															if($date_month[1] == 6)
																$month = 'JUN';	
															if($date_month[1] == 7)
																$month = 'JUL';	
															if($date_month[1] == 8)
																$month = 'AUG';	
															if($date_month[1] == 9)
																$month = 'SEP';	
															if($date_month[1] == 10)
																$month = 'OCT';	
															if($date_month[1] == 11)
																$month = 'NOV';	
															if($date_month[1] == 12)
																$month = 'DEC';	
															?>
															
															<h3><?php echo $date_month[2]; ?></h3>
															<p><?php echo $month; ?></p>
															</div>
															<div class="e-mail-actress"><p>{{$val->title}}<br>
															<?php echo 'Created '.date('F j, Y',strtotime($val->created_at));?></p></div>

															
																<div class="button-img1">
														<input type="button" value="Confirm" alt="{{$val->id}}" name="confirm_button" id="confirm_button" />
														</div>
														
														<input type="hidden" name="token" value="{{csrf_token()}}" id="token" />												
														<div class="project-page-dots">
															<div class="dropdown">
																<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<img src="{{URL::asset('front-end/images/dots.png')}}">
																</button>
																<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
																	<li id="edit-li" ><button id="edit_button"  alt="{{$val->id}}" team="{{$val->project_id }}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myEditModal">View CallSheet</button>
																	<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
																</ul>
															</div>	
														</div>														
													</div>
											</li>
												@endforeach
										<?php } else { ?>
												<li>
												<div class="actress">
														No Pending CallSheet Found.
													</div>
												</div>
												</li>		
										<?php } ?>
												
										</ul>
									</div>
									
								</div>	

							</div>

							</div>
					      <div class="rightsidebar">
@include('common.header-menu')
</div>
						</div>
						
					</div> <!-- row -->
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
			</div> <!--  mid-page  -->

	
		</div>
	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	

<style>
.modal-footer {
	display:none;
} 
</style>

<script>

$( ".details #confirm_button" ).click(function() {
		$(this).val('Please wait..');
		
		var callsheet_id = $(this).attr('alt');
		var token = document.getElementById('token').value;

			var route = "callsheetConfirm";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				context: this,
				data: {
					callsheet_id:callsheet_id
				},
				success: function(data) {
					
						$(this).val('Done');
						$(this).prop("disabled",true);

					},
				error: function(data) {
					alert("Fail");
				},
			});
});
$( "#edit-li button" ).on("click", function() { 
        var alt = $(this).attr("alt");
		var token = document.getElementById('token').value;
		var team = $(this).attr("team")	;	

			var route = "geteditcontact";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: alt,
					team:team
				},
				success: function(data) {
					$('#myEditModal').html(data);
					},
				error: function(data) {
					alert("Fail");
				},
			});
});
</script>

		
  </body>
  </html>