@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
						@include('common.innerleft-menu')	
						
						<div class="col-lg-9 col-xs-9 col-sm-9">
							<div class="row">
								<div class="right-side">
								
										
										
										<div class="project-name">
											<p><a href="javascript:;" >Call Sheets</a></p>
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
														<input type="button" value="Confirm" name="confirm_button" id="confirm_button" />
														</div>
														
														<input type="hidden" name="token" value="{{csrf_token()}}" id="token" />														
														<input type="hidden" name="callsheet_id" value="{{$callsheet_id}}" id="callsheet_id" />
														<input type="hidden" name="owner_id" value="{{$owner_id}}" id="owner_id" />													
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
						
					</div> <!-- row -->
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>


	    <script src="{{ URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

        <script src="{{ URL::asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script>

$( "#confirm_button" ).click(function() {
		$(this).val('Please wait..');
		var token = document.getElementById('token').value;
		var callsheet_id = document.getElementById('callsheet_id').value;
		var owner_id = document.getElementById('owner_id').value;
			var route = "callsheetConfirm";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				data: {
					callsheet_id:callsheet_id,
					owner_id:owner_id
				},
				success: function(data) {
					
						$('#confirm_button').val('Done');
					
					
					},
				error: function(data) {
					alert("Fail");
				},
			});
});

</script>

		
  </body>
  </html>