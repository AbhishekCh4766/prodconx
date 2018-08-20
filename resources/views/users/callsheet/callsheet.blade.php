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
						@include('common.innerleft-menu')	
						<div class="col-lg-9 col-xs-9 col-sm-9">
							<div class="row">
								@include('common.header-menu')
								<div class="project-name">
									<p>My Callsheet</p>
									
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
										New Callsheet</button>

											<!-- Modal -->
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Create New CallSheet</h4>
												</div>
												<div class="modal-body">
													<form action="{{URL::to('addprojects')}}" method="POSt" name="add_project_form" >
														<div class="form-group">
														<div class="input-icon">
															<label for="callsheet_title" class="control-label">CallSheet Title</label>
															<input id="callsheet_title" name="callsheet_title" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="CallSheet Title…">
															<input type="hidden" name="_token" value="{{ csrf_token() }}">
															</div>
														</div>
														<div class="form-group">
														<div class="input-icon">
															<label for="callsheet_description class="control-label">CallSheet Description</label>
															<input id="callsheet_description" name="project_description" class="form-control ng-pristine ng-untouched ng-valid" type="text" ng-model="item.production" placeholder="Callsheet Description...">
															</div>
														</div>
														
														<div class="form-group">
														<div class="input-icon">
															<label for="message-text" class="control-label">Date:</label>

															</div>
														</div>
														<div class="form-group">
														<div class="input-icon">
															<label for="message-text" class="control-label">Time:</label>

															</div>
														</div>														
												<div class="modal-footer">
													<input type="submit" class="btn btn-default"  value="Create project " />
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
						
						<div class="col-lg-9 col-xs-9 col-sm-9">
							<div class="row">
								<div class="right-side">
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
										</div></div> -->
										@if (session('status'))
										<div class="alert alert-success">
											<button class="close" data-close="alert"></button>
											<span> {{ session('status') }} </span>
										</div>					
										@endif										
									
									 <div class="project-section"> 
										<ul>
										@foreach($projects as $project)
											<li>
													<div class="actress">
														<a href="{{URL::to('team')}}/{{$project->id}}"><div class="image-icon">
															<img src="http://allalgos.com/prodconx/public/front-end/images/dp1.png">
															<!-- <div class="all-details"></div> -->
														</div>
														<div class="details">
															<p class="dp">{{$project->project_name}}</p>
															<p class="description">{{$project->project_description}}</p>
														</div></a>
														<div class="project-page-dots">
															<div class="dropdown">
																<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<img src="{{URL::asset('front-end/images/dots.png')}}">
																</button>
																<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
																	
																	<li id="edit-li" ><button id="edit_button" alt="{{$project->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myEditModal">Edit project</button>
																	<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
																		
																	</li>

																	<li id="delete-li" ><button alt="{{$project->id}}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myDeleteModal">Remove project</button>
																		
																	</li>

																	
																	<!-- <li role="separator" class="divider"></li> 
																	<li><a href="#">Separated link</a></li>-->
																</ul>
															</div>	
														</div>
													</div>
												</li>
										@endforeach		<!-- end actress -->
												
										</ul>
									</div>
									
								</div>	
							</div>	
						</div>
						
					</div> <!-- row -->
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
				
			</div> <!--  mid-page  -->

	
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
			var route = "geteditProject";
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
					$('#myEditModal').html(data);
					},
				error: function(data) {
					alert("Fail");
				},
			});
});

$( "#delete-li button" ).click(function() {
        var alt = $(this).attr("alt")
		var token = document.getElementById('token').value;
			var route = "deleteProject";
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
					},
				error: function(data) {
					alert("Fail");
				},
			});
});

</script>

  </body>
  </html>