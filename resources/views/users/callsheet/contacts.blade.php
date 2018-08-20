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
						
						<div class="col-lg-8 col-xs-8 col-sm-8 contacts-common-class rental-common-class">
							<div class="row">
								<div class="right-side">
									<!---@include('common.header-menu')-->
									<div class="row personal-info">
										<div class="project-name">
											<p><a href="{{URL::to('projects')}}" >Project</a> > <a href="{{URL::to('project')}}/{{$prjectName->id}}" > {{ $prjectName->project_name }}</a> > <a href="{{URL::to('team')}}/{{$callsheetID->project_id}}" > Callsheet </a> > Contacts </p>
											
											<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
												Add Contact</button>-->

													<!-- Modal -->
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<?php if(!empty($projectContacts)) { ?>
															<h4 class="modal-title" id="myModalLabel">Select call sheet recipients</h4>
														</div>
														<div class="modal-body">
															
															
															<form action="{{URL::to('savecallsheetmember')}}" method="POSt" name="add_project_form1" >
															<table style="border-collapse: collapse;margin-bottom:20px;">
															<tr>
															<th></th>
															<th>Name</th>
															<th>Email</th>
															</tr>
															@foreach($projectContacts as $val)

															
															<tr style>
															<td style="width:8%;"><input type="checkbox" name="user_id[]" value="{{$val->id}}" /></td>
															<td style="width:33%;text-align: left;">{{$val->first_name}} {{$val->last_name}}</td>
															<td style="width:33%;text-align: left;">{{$val->email}}</td>
															</tr>

															@endforeach
															</table>
														<div class="modal-footer">
														<input type="hidden" value="{{ csrf_token() }}" name="_token" />
														<input type="hidden" value="{{Request::segment(2)}}" name="callsheet_id" />
															<input type="submit" class="btn btn-default"  value="Add contact " />
															<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
														</div>															
															</form>
															<?php } else { ?>
																<h4 class="modal-title" id="myModalLabel">No Contacts added to project.</h4>
															<?php } ?>
														</div>

													</div>
												</div>
											</div>
										</div>
									
								    <!-- <div class="row project-section-name">
										<div class="col-lg-8 col-sm-8 col-xs-12 project-name">
											<p>My Projects</p>
										</div>
										
										<div class="col-lg-4 col-sm-4 col-xs-12 input-box">
											<div class="input-group">
												  <input type="text" class="form-control" placeholder="Search for...">
												  <span class="input-group-btn">
													<button class="btn btn-default" type="button">Go!</button>
												  </span>
											</div>
										</div>
									</div> -->
										@if (session('status'))
										<div class="alert alert-success">
											<button class="close" data-close="alert"></button>
											<span> {{ session('status') }} </span>
										</div>					
										@endif										
									 <div class="project-section project-section-inr"> 
										<ul class="contact-cal-shhet">
										<?php if(!empty($data) ){ ?>
										@foreach($data as $val)
											<li>
											<div class="details">
													<div class="actress">
														<div class="name-details-contact-main-box">
														<div class="name-details-contact">
															<h3>{{$val->first_name}} {{$val->last_name}}</h3>
															</div>
															<div class="sent-details-contact-main-bx">
															<div class="sent-details-contact">
															<?php if ($val->is_sent == 0 ) { ?>
															<img src="{{ URL::asset('front-end/images/x1.png')}}"><p id="unsent"> Unsent</p>
															<? } else { ?>
															<img src="{{ URL::asset('front-end/images/sent.png')}}"><p> Sent</p>
															<?php } ?>
															</div>
															<div class="confirm-details-contact">
															<?php if ($val->confirm == 0 ) { ?>
															<img src="{{ URL::asset('front-end/images/x1.png')}}"><p> Not Confirm</p>
															<? } else { ?>
															<img src="{{ URL::asset('front-end/images/sent.png')}}"><p> Confirm</p>
															<?php } ?>
                                                             </div>
														 </div>
														 </div>
														<div class="project-page-dots">
																<ul class="edit-remove">
																	<li id="send-callsheet-li" >
																	
																	<button alt="{{$val->email}}" user_id="{{$val->id}}"  username="{{$val->first_name}}{{$val->last_name}}" callsheet="{{Request::segment(2)}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myCallsheetModal1">Send Callsheet</button>

																	<input type="hidden" value="<?php echo $callsheetID->project_id; ?>" id="team" name="team" />
																	{{csrf_field()}}
																	
																	</li>
																	
																	
																	<!-- <li id="delete-li" ><button alt="{{$val->id}}" type="button" class="btn btn-primary btn-lg">Remove</button> -->

																	<a title="Remove" onclick="return confirm('Are you sure you want to remove this contact?');" href="{{ url('removecallsheetcontact') }}/{{$val->cid}}/{{$val->callsheet_id}}" class="text-default"><i class="fa fa-trash"></i></a>
																		
																	</li>
																</ul>
														</div>
														</div>
													</div>
												</li>
												
												@endforeach
										<?php } else { ?>
												<li>
												<div class="actress">
														No Contact Found.
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
@include('common.header-menu')
</div>
                         </div>
						</div>
						
					</div> <!-- row -->

	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
	<div class="modal fade" id="myCallsheetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Callsheet Email</h4>
				</div>
				<div class="modal-body">
					<form action="javascript:;" method="POSt" name="add_project_form" >
						<div class="form-group">
							<div class="input-icon">
								<label for="recipient-name" class="control-label">Email Send successfully !!! </label>
							</div>
						</div>
																
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>														
																	<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
						</div>															
					</form>
				</div>

			</div>
		</div>	
	</div>		
				
			</div> 

	
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
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
$( "#edit-li button" ).click(function() {
        var alt = $(this).attr("alt")
		var token = document.getElementById('token').value;
		alert(token);
		var team = document.getElementById('team').value;		
			var route = "../geteditcontactcallsheet";
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
			var route = "../deletecallSheetMember";
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
$("#send-callsheet-li button").click(function (){

			//var token = document.getElementById('token').value;
			var token = $( "input[name='_token']" ).val();
			var email = $( this ).attr( "alt" );
			//var email = 'vivek.allalgos@gmail.com';
			var callsheet = $( this ).attr( "callsheet" );
			var username = $( this ).attr( "username" );			
			var user_id = $( this ).attr( "user_id" );
			
			var team = $('#team').val();
			
			//var route = "../mailSend";
			$.ajax({
				url: '{{url("mailSend")}}',
				type: 'POST',
				dataType: 'html',
				data: {
					email: email,
					callsheet:callsheet,
					username : username,
					user_id  : user_id,
					team     : team,
					_token   : token
				},
				success: function(data) {
						$('#unsent').text('Sent');
					},
				error: function(data) {
					
				},
			});
	
	
});
</script>

  </body>
  </html>