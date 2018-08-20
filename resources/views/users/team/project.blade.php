@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>
  
  
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
										
					
						
						<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class bx">
							<div class="row"> 
								<div class="right-side">
								<div class="row personal-info">
								
								<div class="project-name">
									<p><a href="{{URL::to('projects')}} ">Projects </a> >  {{$projectname->project_name}} </p>

									
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
									 <ul class="project-unorder-list" style="width:100%;background:#FFF;height:200px;text-align:center;padding-top:50px;color:#4B5359;font-size:30px; font-weight:300;line-height:1.8;">
									 <li>
									 <div class="img-project-listq">
									 	<?php if($projectname->project_image !="" ) { ?>
											<img src="http://allalgos.com/prodconx/public/projectsimg/{{$projectname->project_image}}">
										<?php } else {?>
											<img src="http://www.allalgos.com/prodconx/public/projectsimg/noimg.png" />														
										<?php } ?>

									 	<!-- <img class="img-thumbnail" src="http://allalgos.com/prodconx/public/projectsimg/{{$projectname->project_image}}" /> -->
									 </div>
									 <p>{{$projectname->location}}</p>
									 </li>
									 
									 <li>
									 <h4>{{$projectname->project_name}}</h4>
									 <p>{{$projectname->project_description}}</p></li>
									 </ul>
									 <a href="{{URL::to('projectContacts')}}/{{Request::segment(2)}}" >
									 <ul class="project-unoder-list-second" style="width:49%;background:#FFF;float:left;height:250px;text-align:center;padding-top: 50px;font-size: 16px;font-weight: 400;color: #575f66; line-height: 24px; text-transform: uppercase;">
									 <li class="unoder-project-image"> <h3>PROJECT CONTACTS</h3></li>
									<li class="secong-project-images">
									 <div class="text-center"><span class="fontello users"></span> <span class="count ng-binding" ><?php echo $countContacts; ?></span> </div></li>									 
									 
									 </ul>
									 </a>

									<a href="{{URL::to('team')}}/{{Request::segment(2)}}" >
									 <ul class="project-unoder-list-second " style="width:49%;background:#FFF;float:left; margin-left:10px;height:250px;text-align:center;padding-top: 50px;font-size: 16px;font-weight: 400;color: #575f66; line-height: 24px; text-transform: uppercase;">
										 <li class="second-li"><h3>CallSheets</h3></li>
									<li class="secong-project-images">
									 <div class="text-center"><span class="fontello users"></span> <span class="count ng-binding" ><?php echo $countCallSheet; ?></span> </div></li>									 
									 
									 </ul>
									 </a>
									 
							
								  <a href="{{URL::to('location')}}/{{Request::segment(2)}}" >
									<ul class="call-un-order-second">
									<div class="call-sheet-unorder-list" style="width:49%;background:#FFF;float:right;height:250px;margin-left:10px;text-align:center;padding-top: 50px;font-size: 16px;font-weight: 400;color: #575f66; line-height: 24px;text-transform: uppercase;"> 
									 
									 <li class="second-li"><h3>Locations</h3></li>

                                    <li class="thrid-li">
									<div class="text-center"><span class="fontello today"></span> <span class="count ng-binding" > <?php echo $countLocations; ?></span></div> </li></div>
									
									 </ul>
								    </a>
								
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

	          </div>

	      </div>

	  </div>
	  </div>


	                           
						
					 <!-- row -->
                    
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

</script>
<script>
	$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
	    $(".success-alert").slideUp(500);
	});
</script>
