@include('common.head')
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
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


<div class="col-lg-8 col-xs-8 col-sm-8 projects-common-class rental-common-class 1111"> 
<div class="row">
<div class="right-side">

<div class="row personal-info">
<div class="project-name"> 
<h3><p><a href="{{URL::to('projects')}}" >Project</a> > <a href="{{URL::to('project')}}/{{Request::segment(2)}}" >@if(isset($projectname->project_name)){{$projectname->project_name }} @endif </a> > Location</h3>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
										Add Location</button>

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
<p  class="success-alert" style="display: none"></p>	


			 <div  id="example" class="edit-remove" > 
										
										
											
													

														@foreach($user_location  as $k=> $location)										
														<div class="actress" data-id="{{$k}}">


														<div class="actress-bx">
														<div class="img-project_location">
														<h3>{{$location->project_location}}</h3>
														
														</div>														
														<div class="img-parking">
														<p>{{$location->parking}}</p>
														
														</div>
														<div class="img-notes">
														<p>{{$location->notes}}</p>
														</div>
														<div class="img-nearest_hospital">
														<p>{{$location->nearest_hospital}}</p>
														
														</div>
														</div>
														<div class="project-page-dots">
														
																<ul class="edit-remove">
																	<li id="edit-li" ><button id="edit_button" alt="{{$location->id}}" type="button" class="btn btn-primary btn-lg edit-location" data-toggle="modal" data-target="#myEditModal">Edit </button>
																	<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">	
																	<input type="hidden" value="{{Request::segment(2)}}" id="team" name="team" />																</li>
																	
																	
											<li id="delete-li" ><button alt="{{$location->id}}" type="button"  class="btn btn-primary btn-lg confirmation" data-toggle="modal" data-target="#myDeleteModal" >Remove</button>
																		
																	</li>
																</ul>	
           <!-- 
				<a href="javascript:;" class="edit-location"  alt="{{$location->id}}" >Edit</a>&nbsp; <a href="{{ URL::to('deleteUserlocation')}}/{{$location->id}}" class="delete-location" onclick="return confirm('Are you sure you want to delete ');" >Delete</a></td>			
																 -->	
																
														</div>
													</div>
											
												
												@endforeach
												<!-- 										
												<div class="actress">
												
													</div> -->
													</div>
												
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
</div> <!-- row -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content" style="text-align: left;">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Create New Location</h4>
</div>
<div class="modal-body">
<form class="form-horizontal location-form" action="{{URL::to('saveUserlocation/{$id}')}}" method="POST" name="add_project_form1" >


<div class="form-group">
<div class="input-icon">
<input type="hidden" name="project_id" value="{{ Request::Segment(2) }}">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">				
</div>
</div>


<div class="form-group">
<div class="input-icon">
	<label> Location Name</label>
<input name="project_location" id="project_location" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Project Location" required>															
</div>
</div>	

<div class="form-group">
<div class="input-icon">
		<label>Parking</label>
<input name="parking" id="parking" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="parking" required>															
</div>
</div>														

<div class="form-group">
<div class="input-icon">
		<label>Notes</label>
<input name="notes" id="notes" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Notes " required>															
</div>
</div>

<div class="form-group">
<div class="input-icon">
		<label>Nearest Hospital</label>
<input name="nearest_hospital" id="nearest_hospital" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Nearest Hospital " required>															
</div>
</div>


<div class="modal-footer">
<input type="submit" class="btn btn-default"  value="Add location " />
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>		       
</div>					
</form>
</div>

</div>

</div>				
</div>				

<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
</div>	


</div> <!--  mid-page  -->


</div>
</div>

<!--edit modal-->
<!-- Modal -->
<div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="text-align: left;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Location</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
		<div class="input-icon">
			<label>Project Location</label>
		<input name="project_location" id="edit_project_location" class="form-control" type="text" placeholder="Project Location">															
		</div>
		</div>	

		<div class="form-group">
		<div class="input-icon">
			<label>Parking</label>
		<input name="parking" id="edit_parking" class="form-control" type="text" placeholder="parking">															
		</div>
		</div>														

		<div class="form-group">
		<div class="input-icon">
			<label>Notes</label>
		<input name="notes" id="edit_notes" class="form-control" type="text" placeholder="Notes ">															
		</div>
		</div>

		<div class="form-group">
		<div class="input-icon">
			<label>Nearest Hospital</label>
		<input name="nearest_hospital" id="edit_nearest_hospital" class="form-control" type="text" placeholder="Nearest Hospital ">															
		</div>
		</div>
      <div class="modal-footer">
      	<input type="hidden" id="location_id" value="">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updateLocationData">Submit</button>
      </div>

    </div>
  </div>
</div>


<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
<script type="text/javascript">
	

$( "#example  .edit-location" ).click(function() {
        var alt = $(this).attr("alt")
		var token = document.getElementById('_token').value;	
			var route = "{{url('getedituserlocation')}}";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				data: {
					alt:alt
				},
				success: function(data) {
					$('#edit_project_location').val(data.project_location);
					$('#edit_parking').val(data.parking);
					$('#edit_notes').val(data.notes);
					$('#edit_nearest_hospital').val(data.nearest_hospital);
					$('#location_id').val(data.id);
					$('.editModal').modal(); 
				},
			});
});

$('.updateLocationData').click(function(){
	var epl = $('#edit_project_location').val();
	var eparking = $('#edit_parking').val();
	var enotes = $('#edit_notes').val();
	var enearest = $('#edit_nearest_hospital').val();
	var loc_id = $('#location_id').val();
	var token = document.getElementById('_token').value;
	var route = "updateLocationData";
   // alert(route);
	$.ajax({
		url: route,
		headers: {
			'X-CSRF-TOKEN': token
		},
		type: 'POST',
		dataType: 'json',
		data: {
			epl:epl,eparking:eparking,enotes:enotes,enearest:enearest,loc_id:loc_id
		},
		success: function(data) {
			
			$('.editModal').modal('hide');
			location.reload();
		},
	});
});


// $( "#delete-li button" ).click(function() {
// 	//alert();
//         var id = $(this).attr("alt");
//          $(".success-alert").html('Location Deleted Successfully.');
// 		var token = document.getElementById('token').value;
// 			var route = "{{ URL::to('deleteUserlocation')}}";
// 			$.ajax({
// 				url: route,
// 				headers: {
// 					'X-CSRF-TOKEN': token
// 				},
// 				type: 'GET',
// 				dataType: 'json',
// 				data: {
// 					id: id
// 				},
// 					success: function(data) {
// 					$('#myDeleteModal').html(data);
// 					},
// 				error: function(data) {
// 					alert("Fail");
// 				},
// 			});
// });
</script>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
         var check = confirm("Are you sure you want to Delete this Location");
        if (check == true) {
        	@foreach($user_location  as  $location)										
           window.location = '{{ URL::to('deleteUserlocation')}}/{{$location->id}}';
            @endforeach
        }
        else {
            return false;
        }
    });
</script>
<script>
$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
$(".success-alert").slideUp(500);
});
</script>


<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<!-- <script type="text/javascript">

$(document).ready(function() {
$('#example').DataTable();
} );
</script> -->

</body>
</html>