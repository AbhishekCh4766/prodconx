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
								<div class="rightsidebar">
@include('common.header-menu')
</div>
								
								<?php if($users->facebook_link !="" || $users->twitter_link !="") { ?>	
							<div class="row individual-group-section">
								<div class="col-lg-12 col-xs-12 col-sm-12 groups">
									<div class="friends-section">
										<p class="profile-setting">	Social Links</p>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12 col-sm-12 group-background">
									<?php if($users->facebook_link !="" ) { ?>
									<div class="group-hand">
										  <img src="{{ URL::asset('front-end/images/9.png')}}">
										<span class="profile-setting"><a href="<?php echo $users->facebook_link; ?>" target="_blank" > Facebook </a></span>
									</div>
									
									<?php }	if($users->twitter_link !="" ) { ?>
								
										<div class="yellow-bag">
											<img src="{{ URL::asset('front-end/images/10.png')}}">
											<span class="profile-setting"><a href="<?php echo $users->twitter_link; ?>" target="_blank" > Twitter </a></span>
										</div>
									<?php } ?>	
								</div>
							</div>	
							<?php }	?>
								
							</div>
							</div>
						<div class="col-lg-9 col-xs-9 col-sm-9 projects-common-class rental-common-class 1111"> 
							<div class="row">
								<div class="right-side">
								
								<div class="row personal-info">
								<div class="project-name">
									<h3>My Projects</h3>
									
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
										New Project</button>

											<!-- Modal -->
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Create New Project</h4>
												</div>
												<div class="modal-body">
													<form action="{{URL::to('addprojects')}}" method="POSt" name="add_project_form" enctype="multipart/form-data" >
														<div class="form-group">
														<div class="input-icon">
															<label for="recipient-name" class="control-label">Project Name</label>
															<input id="project_title" name="project_title" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="Project Name…">
															<input type="hidden" name="_token" value="{{ csrf_token() }}">
															</div>
														</div>
														<div class="form-group">
														<div class="input-icon">															
																<img src="http://www.allalgos.com/prodconx/public/projectsimg/noimg.png"  id="preview_img" style="height:100px;width:100px;" />
																 <!-- rename it -->
														</div>
														<input class="browse-button" type="file" class="form-control" accept="image/png, image/jpeg, image/gif" name="image" id="project_pic" />
														</div>		
															
															
														<div class="form-group">
														<div class="input-icon">
															<label for="production-company" class="control-label">Project Description</label>
															
															
															<input  id="location" name="location" class="form-control ng-pristine ng-untouched ng-valid" type="text" ng-model="item.production" placeholder="Production Address...">
															
															
															
															</div>
														</div>
														<div class="form-group">
														<div class="input-icon">
															<label for="message-text" class="control-label">Message:</label>
															
															<textarea id="project_description" name="project_description"  class="contenteditable form-control with-padding-top ng-pristine ng-untouched ng-valid ng-isolate-scope" ng-model="item.address" placeholder="Project Description" g-places-autocomplete="" auto-size=""  style="resize: none;"></textarea>
															
															
															
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
										<?php if(!empty($projects)) { ?>
										@foreach($projects as $project)
											<li>
													<div class="actress">
														<a href="{{URL::to('project')}}/{{$project->id}}">
														
														<div class="image-icon">
														
														<?php if($project->project_image !="" ) { ?>
															<img src="http://allalgos.com/prodconx/public/projectsimg/<?php echo $project->project_image; ?>">
														<?php } else {?>
															<img src="http://www.allalgos.com/prodconx/public/projectsimg/noimg.png" />														
														<?php } ?>
														</div>
														
														<div class="details">
															<p class="dp">{{$project->project_name}}</p>
															<p class="description">{{$project->project_description}}</p>
														</div></a>
														<div class="project-page-dots">
															
																<ul class="edit-remove">
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
												</li>
										@endforeach		<!-- end actress -->
										<?php } else { ?>
												<li>
												<div class="actress">
														No Project Found.
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


$('body').on("change", '#project_pic',function()
			{ 
				var files = !!this.files ? this.files : [];
				if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

				if (/^image/.test( files[0].type)){ // only image file
					var reader = new FileReader(); // instance of the FileReader
					reader.readAsDataURL(files[0]); // read the local file

					reader.onloadend = function(){ // set image data as background of div
						$("#preview_img").attr("src", this.result); 
					}
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