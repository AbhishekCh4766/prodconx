@include('common.head')
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('date/datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('date/timepicker.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/10b4771377.js"></script>
<script src="{{ asset('date/datepicker.min.js') }}"></script>
<script src="{{ asset('date/timepicker.js') }}"></script>

<body>
    <div class="post-page main-page">
	@include('common.header')
	@include('common.left-menu')

		<div class="mid-page addCallsheet-main">
			<div class="container">
				<div class="profile-part">
					<div class="row">
					<div class="addCallsheet-bx">
					<form class="addCallsheet-bx-form" action="{{ URL::to('/addScheduleToCallsheet')}}" method="POST" name="add_project_form" >
					<h3><span>3.</span> Schedule</h3>
						{{csrf_field()}}
					<div class="wrapper">
						<div class="form-group cols-sm-6">
							<label for="email" class="cols-sm-2 control-label">Time</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
									<input type="time" class="form-control timepicker" name="schedule_time[]" id="time" required="" placeholder="7:00am" />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6 rightside">
							<label for="username" class="cols-sm-2 control-label">Scene</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" required="" name="schedule_scene[]" id="schedule_scene"  placeholder="Enter Scene" />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="email" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="schedule_desc[]" id="schedule_desc" required="" placeholder="Enter Description" />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6 rightside">
							<label for="username" class="cols-sm-2 control-label">D/N</label>
							<select class="form-control" name="schedule_dn[]">
							  <option value="1">Day</option>
							  <option value="2">Night</option>
							</select>
						</div>

						<div class="form-group cols-sm-6">
							<label for="email" class="cols-sm-2 control-label">Cast</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="schedule_cast[]" id="schedule_cast"  placeholder="Enter Cast" />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6 rightside">
							<label for="username" class="cols-sm-2 control-label">Location</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="schedule_location[]" id="schedule_location"  placeholder="Enter Location" />
								</div>
							</div>
						</div>

						

					</div>

					<div class="row">
						<div class="col-md-12 append">

						</div>
					</div>

					<div class="row" style="margin-top:40px;">
						<div class="col-md-12">
							<button type="button" class="btn btn-primary pull-right addmore">Add More</button>
						</div>
					</div>
			
		
			</div> <!--  mid-page  -->
		</div>
	</div>
	</div>
			<div class="select-type-bx bottom-bx footer navbar-fixed-bottom">
					<div class="container">
					<div class="row">
					<div class="inr-bottom-bx">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
					<div class="btn btn-default">
					<a href="{{ URL::to('/team/')}}/{{Request::segment(2)}}"> Cancel</a>
					
					</div>
					
					
					</div>
					<!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<div class="select-cencl-buton list">
					<ul>
					
					<li class="active"><a href="#">General </a></li>
									
					
					<li><a href="#">Recipients </a></li>
						
					
					<li><a href="#"> Customize </a></li>
					
					
					</ul>
					
					</div>
					
					
					</div> -->
					<div class="col-lg-2 col-lg-offset-8 col-md-2 col-md-offset-8 col-sm-2 col-sm-offset-8 col-xs-12">
					<div class="next">
					<input type="hidden" class="call_type" value="{{$project_id}}" name="project_id">
					<input type="hidden" class="call_type" value="{{$callsheet_id}}" name="callsheet_id">
					<input type="submit" value="Next" id="next" class="btn btn-default" />
					
					</div>
					
					
					</div>
					
					</div>
					</div>
					</div>
					
					</div>
					</form>
	</div>
	
	<script>
		$('.timepicker').timepicker();
		$(document).on('click', '.timepicker1', function() {
		  $( this ).timepicker();
		 });

		$(document).on('click', '.removeme', function() {
		  $( this ).parent().parent().parent().parent().parent().remove();
		 });
	</script>
	<script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
      	format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
      });
    });

    $('.addmore').click(function(){
    	var data = '<div class="wrapper"><div class="form-group cols-sm-6"><label for="email" class="cols-sm-2 control-label">Time</label><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span><input type="time" class="form-control timepicker1" name="schedule_time[]" id="time"  placeholder="7:00am" /></div></div></div><div class="form-group cols-sm-6 rightside"><label for="username" class="cols-sm-2 control-label">Scene</label><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span><input type="text" class="form-control" name="schedule_scene[]" id="schedule_scene"  placeholder="Enter Scene" /></div></div></div><div class="form-group cols-sm-6"><label for="email" class="cols-sm-2 control-label">Description</label><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span><input type="text" class="form-control" name="schedule_desc[]" id="schedule_desc"  placeholder="Enter Description" /></div></div></div><div class="form-group cols-sm-6 rightside"><label for="username" class="cols-sm-2 control-label">D/N</label><select class="form-control" name="schedule_dn[]"><option value="1">Day</option><option value="2">Night</option></select></div><div class="form-group cols-sm-6"><label for="email" class="cols-sm-2 control-label">Cast</label><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span><input type="text" class="form-control" name="schedule_cast[]" id="schedule_cast"  placeholder="Enter Cast" /></div></div></div><div class="form-group cols-sm-6 rightside"><label for="username" class="cols-sm-2 control-label">Location</label><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span><input type="text" class="form-control" name="schedule_location[]" id="schedule_location"  placeholder="Enter Location" /></div><div class="form-group"><div class="cols-sm-10"><button type="button" class="btn btn-danger pull-right removeme">Remove</button></div></div></div></div></div>';
    	$('.append').append(data);
    });
  </script>
  

  </body>
  </html>