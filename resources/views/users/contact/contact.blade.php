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
							

								<div class="col-lg-8 col-xs-8 col-sm-8 friends-common-class">
									<div class="row">
										<div class="right-side">

											<div class="row personal-info">
												<div class="project-name">
													<h3>My Contact</h3>
													<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
													Add New Contact</button>
												</div>

												<div class="row project-section-name" style="margin-top: 10px;" >
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
														
													<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
														<thead>
															<tr>
																<th>Name</th>
																<th>Email</th>
																<th>Phone No.</th>
																<th>Action</th>
															</tr>
														</thead>
														<tfoot>
															<tr>
																<th>Name</th>
																<th>Email</th>
																<th>Phone No.</th>
																<th>Action</th>
															</tr>
														</tfoot>
														<tbody>
															@foreach($user_contact as $contact)
															<tr>
																<td>{{$contact->name}}</td>
																<td>{{$contact->email}}</td>
																<td>{{$contact->phone}}</td>
																<td class="edit-delete"><a href="javascript:;" class="edit-contact" data-toggle="modal" data-target="#myEditModal" alt="{{$contact->id}}" >Edit</a>&nbsp; <a href="{{ URL::to('deleteUserContact')}}/{{$contact->id}}" class="delete-contact" onclick="return confirm('Are you sure you want to delete this user from contact?');" >Delete</a></td>
															</tr>
															@endforeach   
														</tbody>
													</table>
													
													<div class="col-lg-2 col-sm-2 col-xs-2 input-box">

														
													</div>
												</div> 

											</div>
										</div>

									</div>	
								</div>	


							</div>
						</div> <!-- row -->

						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create New Contact</h4>
						</div>
						<div class="modal-body">
						<form class="form-horizontal contact-form" action="{{URL::to('saveUserContact')}}" method="POST" name="add_project_form1" >


						<div class="form-group">
						<div class="input-icon">
						<input name="contact_name" id="contact_name" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Full Name" required="">
						<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">															
						</div>
						</div>

						<div class="form-group">
						<div class="input-icon">
						<input name="contact_email" id="contact_email" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="email" placeholder="Email Address" required="">															
						</div>
						</div>

						<div class="form-group">
						<div class="input-icon">
						<input name="contact_phone" id="contact_phone" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Phone Number" required="">															
						</div>
						</div>														

						<div class="form-group">
						<div class="input-icon">

						<div class="checkbox-tick">
						 <label for="">Role</label>
							@foreach($roles_id as $role)
							
							<input type="checkbox" value="{{$role->id}}" name="role[]" />{{$role->role_name}} 																
							
							@endforeach
						 </div>
						</div>
						</div>		

						<div class="form-group">
						<div class="input-icon">
						<select id="department" name="department" class="form-control">
						<option value="" >Select Department</option>	
							@foreach($departments as $department)

								<option value="{{$department->id}}">{{$department->name}}</option>	
							
							@endforeach
						</select>	

						</div>
						</div>
						<div id="deptRole" ></div>
						<div class="modal-footer">
						<input type="submit" class="btn btn-default"  value="Add contact " />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>		       
						</div>					
						</form>
						</div>
											
						</div>

						</div>				
						</div>				

						<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									
						</div>	

						<div class="rightsidebar">
							<div class="fixed fixed-two">@include('common.header-menu')</div>
						</div>
					</div> <!--  mid-page  -->

	
				</div>

			</div>
		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
<script type="text/javascript">

$('body').on('change','#department', function (e) {
var department_id = $(this).val();
var token = $('#_token').val();		
var route = "getdeptRole";
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
	var route = "getdeptRole";
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
		
		

$( "#example .edit-delete .edit-contact" ).click(function() {
        var alt = $(this).attr("alt")
		var token = document.getElementById('_token').value;	
			var route = "geteditusercontact";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					contact_id:alt
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
<script>
$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
$(".success-alert").slideUp(500);
});
</script>

<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$('#example').DataTable();
} );
</script>

</body>
</html>