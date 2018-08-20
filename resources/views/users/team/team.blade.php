@include('common.head')
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/10b4771377.js"></script>
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
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
						
						<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class">
							<div class="row">
								<div class="right-side">
									<div class="row personal-info">
										<div class="project-name">
											<p><a href="{{URL::to('projects')}} " >Project</a> > <a href="{{URL::to('project')}}/{{Request::segment(2)}}" > {{$projectname->project_name}} </a> > Call Sheets</p>
											<a class="btn btn-default pull-right" href="{{URL::to('addCallsheet')}}/{{Request::segment(2)}}">Add CallSheet</a>
											<!-- Modal -->
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Add CallSheet</h4>
												</div>
												<div class="modal-body">
													<form action="{{URL::to('savecallsheet')}}" method="POSt" name="add_project_form1" >
														<div class="form-group">
														<div class="input-icon">
															<label for="recipient-name" class="control-label">CallSheet Title</label>
															<input id="callsheet_title" name="callsheet_title" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="CallSheet Title">
															<input type="hidden" name="_token" value="{{ csrf_token() }}">
															<input type="hidden" value="{{Request::segment(2)}}" id="team_id" name="team_id" />
														</div>
														</div>
														<div class="form-group">
														<div class="input-icon">
															<label for="callsheet_description" class="control-label">CallSheet Description</label>
														
															<textarea class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="callsheet_description" id="callsheet_description" placeholder="CallSheet Description"></textarea>
	
														</div>
														</div>	
														
														
														<div class="form-group">
														<div class="input-icon">
															<label for="recipient-name" class="control-label">Near by Hospital</label>

														    <input id="near_by_hospital" name="near_by_hospital"  type="text" class="form-control"  placeholder="Near by Hospital">
																	
														</div>
														</div>
														
														<div class="form-group">
														<div class="input-icon">
															<label for="recipient-name" class="control-label">CallSheet Date</label>
														
															<input  id="callsheet_date" name="callsheet_date" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" placeholder="CallSheet Date" data-date-format="yyyy-mm-dd" />
	
														</div>
														</div>	
														
														<div class="form-group">
														<div class="input-icon">
															<label for="recipient-name" class="control-label">CallSheet Time</label>

														    <input id="callsheet_time" name="callsheet_time"  type="text" class="form-control timepicker timepicker-no-seconds"  placeholder="CallSheet Time">
																	
														</div>
                      
														</div>		
														<div class="form-group">
														<div class="input-icon">
															<label for="recipient-name" class="control-label">CallSheet Type</label>
															<input id="callsheet_type" name="callsheet_type" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="CallSheet Type" />
	
														</div>
														</div>															
												<div class="modal-footer">
													<input type="submit" class="btn btn-default"  value="Add CallSheet " />
													<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
												</div>															
													</form>
												</div>

											</div>
										</div>
									</div>
								</div>
								@if (session('status'))
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-success success-alert">
											<button class="close" data-close="alert"></button>
											<span> {{ session('status') }} </span>
										</div>
									</div>
								</div>					
								@endif

									 <div class="project-section project-section_bx">


									 	<!-- Upcoming Call sheets -->
									 	<ul class="drama">
											<div class="alert alert-info">
											  Upcoming Call sheet(s)
											  <?php
											  		$today = date('Y-m-d');
											  ?>
											</div>
										<?php if(!empty( $data ) ) { $i = 0 ; //dd($data);?>
										@foreach($data as $val)
											@if($val->date >= $today)
											<li>
													<div class="actress">
														<a href="{{URL::to('contacts')}}/{{$val->id}}">
														<div class="details">
														<div class="details_main_bx1">
															<div class="calendar-box">
															
															<?php 
															
															$date_month = explode("-",$val->date);
															
															if(isset($date_month[1])){
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
															}
															?>
															
															<h3><?php echo $date_month[2]; ?></h3>
															<p><?php echo $month; ?></p>
															</div>
															<div class="e-mail-actress"><p>{{$val->title}}<br>
															<?php echo 'Created '.date('F j, Y',strtotime($val->created_at));?></p></div>
																
															
															</div>
															 
															<div class="details_main_bx1">
														
														
														<div class="button-img">
														<button class="button">View Recipients</button>
														</div> 
															<div class="confirmed"><p>Confirmed
															<?php echo $totalConfirm[$i]['count']; ?> out of <?php echo $totalContacts[$i]['count']; ?></p>
														</div>
														</div>
														</div>
														</a>
														<div class="project-page-dots">
															
															
																<ul class="edit-remove" aria-labelledby="dropdownMenu1">
																																	
																	<!--<li id="view-li" ><button alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myPreviewModal">View</button></li> -->
																	
																	<!-- <li id="view-li" ><a title="Notification" class="pull-right" href="{{URL::to('callsheet_notification')}}/{{Request::segment(2)}}/{{$val->id}} "><span class="glyphicon glyphicon-bell gray-text" aria-hidden="true"></span></a></li> -->

																	<li id="view-li" ><a title="View" class="pull-right" href="{{URL::to('viewcallsheet')}}/{{Request::segment(2)}}/{{$val->id}} "><span class="glyphicon glyphicon-eye-open gray-text" aria-hidden="true"></span></a></li>
																	
																	<li id="view-li" ><a title="Edit" class="pull-right" href="{{URL::to('getCallsheetDatas')}}/{{Request::segment(2)}}/{{$val->id}} "><span class="glyphicon glyphicon-pencil gray-text" aria-hidden="true"></span></a></li>
																
																	<!--<li id="edit-li" ><button id="edit_button" alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myEditModal">Edit </button>
																	<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
																		
																	<input type="hidden" value="{{Request::segment(2)}}" id="team" name="team" />																	</li> -->

																<!--	<li id="delete-li" ><button alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myDeleteModal">Remove</button>
																		
																	</li> -->
																	<li id="view-li" ><a href="{{URL::to('deletegrtcallsheets')}}/{{Request::segment(2)}}/{{$val->id}}"  data-method="delete" onclick="return confirm('Are you sure to delete?')"> <span class="glyphicon glyphicon-remove gray-text" aria-hidden="true"></span></a></li>
																</ul>
															
														</div>
													
													</div>
												</li>
												<?php $i++ ?>
												@endif
												@endforeach
										<?php } else { ?>
												<li>
												<div class="actress">
														No CallSheet Found.
													</div>
												
												</li>		
										<?php } ?>
												
										</ul>


									 	<!-- Archived Call sheets -->
										<ul class="drama">
											<div class="alert alert-info">
											  Archived Call sheet(s)
											  <?php
											  		$today = date('Y-m-d');
											  ?>
											</div>
										<?php if(!empty( $data ) ) { $i = 0 ; //dd($data);?>
										@foreach($data as $val)
											@if($val->date < $today)
											<li>
													<div class="actress">
														<a href="{{URL::to('contacts')}}/{{$val->id}}">
														<div class="details">
														<div class="details_main_bx1">
															<div class="calendar-box">
															
															<?php 
															
															$date_month = explode("-",$val->date);
															
															if(isset($date_month[1])){
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
															}
															?>
															
															<h3><?php echo $date_month[2]; ?></h3>
															<p><?php echo $month; ?></p>
															</div>
															<div class="e-mail-actress"><p>{{$val->title}}<br>
															<?php echo 'Created '.date('F j, Y',strtotime($val->created_at));?></p></div>
																
															
															</div>
															 
															<div class="details_main_bx1">
														
														
														<div class="button-img">
														<button class="button">View Recipients</button>
														</div> 
															<div class="confirmed"><p>Confirmed
															<?php echo $totalConfirm[$i]['count']; ?> out of <?php echo $totalContacts[$i]['count']; ?></p>
														</div>
														</div>
														</div>
														</a>
														<div class="project-page-dots">
															
															
																<ul class="edit-remove" aria-labelledby="dropdownMenu1">
																																	
																	<!--<li id="view-li" ><button alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myPreviewModal">View</button></li> -->
																	<!-- <li id="view-li" ><a title="Notification" class="pull-right" href="{{URL::to('callsheet_notification')}}/{{Request::segment(2)}}/{{$val->id}} "><span class="glyphicon glyphicon-bell gray-text" aria-hidden="true"></span></a></li> -->
																	
																	<li id="view-li" ><a title="View" class="pull-right" href="{{URL::to('viewcallsheet')}}/{{Request::segment(2)}}/{{$val->id}} "><span class="glyphicon glyphicon-eye-open gray-text" aria-hidden="true"></span></a></li>
																	
																	<li id="view-li" ><a title="Edit" class="pull-right" href="{{URL::to('getCallsheetDatas')}}/{{Request::segment(2)}}/{{$val->id}} "><span class="glyphicon glyphicon-pencil gray-text" aria-hidden="true"></span></a></li>
																
																	<!--<li id="edit-li" ><button id="edit_button" alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myEditModal">Edit </button>
																	<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
																		
																	<input type="hidden" value="{{Request::segment(2)}}" id="team" name="team" />																	</li> -->

																<!--	<li id="delete-li" ><button alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myDeleteModal">Remove</button>
																		
																	</li> -->
																	<li id="view-li" ><a href="{{URL::to('deletegrtcallsheets')}}/{{Request::segment(2)}}/{{$val->id}}"  data-method="delete" onclick="return confirm('Are you sure to delete?')"> <span class="glyphicon glyphicon-remove gray-text" aria-hidden="true"></span></a></li>
																</ul>
															
														</div>
													
													</div>
												</li>
												<?php $i++ ?>
												@endif
												@endforeach
										<?php } else { ?>
												<li>
												<div class="actress">
														No CallSheet Found.
													</div>
												
												</li>		
										<?php } ?>
												
										</ul>
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
				</div>
			</div> <!-- row -->
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
	
	
	<!-- call sheet preview--->
	
	<div class="modal fade main-call-sheet" id="myPreviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												


		</div>
	</div>		
	</div>		
				<!-- end call sheet preview--->
			</div> <!--  mid-page  -->

	
		


	    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>

        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>

        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>

        <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

		
<script type="text/javascript">
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='add_project_form']").validate({
				
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
	  project_title:"required",
      location: "required",
      project_description: "required",

    },
    // Specify validation error messages
    messages: {
	  project_title:"Please enter project title",		
      project_description: "Please enter your project description",
      location: "Please enter your location",	  
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
  highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }

  });
});
</script>		
<script>
$( "#edit-li button" ).on("click", function() { 
        var alt = $(this).attr("alt")
		var token = document.getElementById('token').value;
		var team = document.getElementById('team').value;		
			var route = "../geteditcontact";
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

$( "#delete-li button" ).click(function() {
        var alt = $(this).attr("alt");
		var token = document.getElementById('token').value;
		var team = document.getElementById('team').value;
			var route = "../deletecallSheet";
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
					$('#myDeleteModal').html(data);
					},
				error: function(data) {
					alert("Fail");
				},
			});
});
$( "#view-li button" ).click(function() {
        var alt = $(this).attr("alt");
		var token = document.getElementById('token').value;
		var team = document.getElementById('team').value;
			var route = "../previewCallSheet";
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
					$('#myPreviewModal').html(data);
					},
				error: function(data) {
					alert("Fail");
				},
			});
});

			

</script>
<script>
	$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
	    $(".success-alert").slideUp(500);
	});
</script>
  </body>
  </html>