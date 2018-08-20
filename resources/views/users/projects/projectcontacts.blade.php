@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>

  
    <link rel="stylesheet" href="http://allalgos.com/prodconx/public/front-end/css/bootstrap-chosen.css" />
  <style>
  .chosen-container-single .chosen-single span{text-align:left !important;}
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
								<div class="col-lg-8 col-xs-8 col-sm-8 projects-common-class rental-common-class">
									<div class="row">
										<div class="right-side">
											<!--@include('common.header-menu')-->
											<div class="row personal-info">
										<div class="project-name add-project-contact">
											<p><a href="{{URL::to('projects')}}" >Project</a> > <a href="{{URL::to('project')}}/{{Request::segment(2)}}" >{{$prjectName->project_name }} </a> > Contacts </p>
											
											<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
												Add Contact</button>

													<!-- Modal -->
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Add Project Contact</h4>
														</div>
														<div class="modal-body">
														<form class="form-horizontal contact-form" action="{{URL::to('savemember')}}" method="POST" name="add_project_form1" >
																<div class="form-group">
																<div class="input-icon">
																	<label for="recipient-name" class="control-label">Email</label>
																	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
																	<input type="hidden" value="{{Request::segment(2)}}" id="team_id" name="team_id" />
																	
													<div  class="form-group" id="custom_client_type">

															<select data-placeholder="Find Friend" id="contact_email" name="contact_email" class="form-control chosen-select" tabindex="2" required >
																<option value=""></option>
																
																<?php for($i=0;$i<count($friends);$i++) { ?>
																	
																	
																	<option data-contact="<?php echo $friends[$i]->contact_user_id; ?>" data-status="<?php echo $friends[$i]->id; ?>" value="<?php echo $friends[$i]->email; ?>" ><?php echo ucwords($friends[$i]->name); ?> </option>
																	
																	
																<?php }?>
																
																											  
															</select>
															<input type="hidden" name="contact_id" id="contact_id" value="" />
													</div>																
																	
																</div>
																</div>
																<div id="editMyContact">

																</div>			

																											
											</form>
														
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
												<div class="row">
													<div class="col-md-12">
														<div class="alert alert-success success-alert">
															<button class="close" data-close="alert"></button>
															<span> {{ session('status') }} </span>
														</div>
													</div>
												</div>
																	
												@endif										
											 <div class="project-section"> 
												<ul>
												<?php if(!empty($data)){ 


												?>
												@foreach($data as $val)
													<li>
															<div class="actress">

																<!--<div class="image-icon"> -->
																<?php //if($val->profile_pic !="" ) {?>
																<!--<img src="{{ URL::asset('/profilepics')}}/ " /> -->
																<?php //}else { ?>
																<!--<img src="{{ URL::asset('front-end/images/man-icon.png')}}"> -->
																<?php //} ?>											
																<!--</div>-->												
																
																<div class="actress-bx">
																<div class="img-first">
																<h3>{{$val->first_name}} {{$val->last_name}}</h3>
																
																</div>														
																<div class="img-email">
																<p>{{$val->email}}</p>
																
																</div>
																<div class="img-phone">
																<p>
																@if($val->phone)
																	{{$val->phone}}
																@else
																	-
																@endif</p>
																</div>
																</div>
																<div class="project-page-dots">
																	
																		<ul class="edit-remove">
																			<!-- <li id="edit-li" ><button id="edit_button" alt="{{$val->pc_id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myEditModal">Edit </button>
																			<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">	
																			<input type="hidden" value="{{Request::segment(2)}}" id="team" name="team" /></li> -->
																			
																			
																			<!-- <li id="delete-li" ><button alt="{{$val->pc_id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myDeleteModal">Remove</button></li> -->
																			<li>
																				<a onclick="return confirm('Are you sure you want to delete this contact?');" href="{{ url('deleteprojectcontact') }}/{{$val->project_contact_id}}/{{Request::segment(2)}}" class="text-danger" title="Delete"><i class="fa fa-trash"></i>
																				</a>
																			</li>
																		</ul>
																		
																</div>
															</div>
													</li>
														
														@endforeach
												<?php } else { ?>
														<li>
														<div class="actress">
																No Contact Found.
															</div>
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
				
	              
			</div> <!--  mid-page  -->
             
		</div>
              
	</div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	

<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	

<script src="http://allalgos.com/prodconx/public/front-end/js/select.js" ></script>

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
			var route = "../deleteContact";
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
	
			var token = document.getElementById('token').value;	
			var email = $( this ).attr( "alt" );
			var callsheet = $( this ).attr( "callsheet" );
			var username = $( this ).attr( "username" );		
			var project_id = "<?php echo Request::segment(2) ?>";	
			
			var route = "../mailSend";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					email: email,
					callsheet:callsheet,
					username : username,
					project_id: project_id
				},
				success: function(data) {
					
					},
				error: function(data) {
					
				},
			});
	
	
});
		$('body').on('change','#department', function (e) {
			var department_id = $(this).val();
			var token = $('#_token').val();		
			var route = "../getdeptRole";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					department_id : department_id
				},
				success: function(data) {
					$("#deptRole").empty();
					$("#editContactRole").empty();
					$("#editContactRole").append(data);					
					$('#deptRole').append(data);
					
					},
				error: function(data) {
					
				},
			});
		});

		$('body').on('change','#edit_department', function (e) {
			var department_id = $(this).val();
			var token = $('#_token').val();				
			var route = "../getdeptRole";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					department_id : department_id
				},
				success: function(data) {
					$("#editContactRole").empty();
					$("#editContactRole").append(data);					
					
					},
				error: function(data) {
					
				},
			});
		});

		$('body').on('change','#contact_email', function (e) {
			var contact_email = $(this).val();
			//var contact_id = $( this ).attr( "contact_id" );
			var contact_id = $("#contact_email option:selected").data('status');
			var contact_user_id = $("#contact_email option:selected").data('contact');
			
			$("#contact_id").val(contact_id);
			
			var token = $('#_token').val();				
			var route = "getContact";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					contact_id : contact_id,
					contact_user_id : contact_user_id,
					contact_email : contact_email
				},
				success: function(data) {
					$("#editMyContact").empty();
					$("#editMyContact").append(data);		
					
					},
				error: function(data) {
					alert('Fail');
					
				},
			});
		});
		
</script>
    <script>
      $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });
    </script>
<script>
	$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
	    $(".success-alert").slideUp(500);
	});
</script>
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/team.min.js')}}" type="text/javascript"></script>
</body>
</html>