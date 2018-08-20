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
  <!-- top-bar -->
    <div class="post-page main-page">
		
			@include('common.header')

			@include('common.left-menu')

			<div class="mid-page addCallsheet-main">
			<div class="container">
				<div class="profile-part">
					<div class="row">
					<div class="addCallsheet-bx">
					<form class="addCallsheet-bx-form" action="{{ URL::to('/updatecallsheet')}}/{{$project[0]->id}}/{{Request::segment(2)}}" method="POST" name="add_project_form" >
					<h3><span>1.</span> Enter Details</h3>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Call Sheet Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="callsheet_title" id="name"  placeholder="Call Sheet Title…" value="<?php echo $project[0]->title; ?>" required />
									{{csrf_field()}}
									<input type="hidden"  name="team_id" id="team_id" value="{{Request::segment(2)}}" />
									<input type="hidden"  name="callsheet_id" id="callsheet_id" value="<?php echo $project[0]->id; ?>" />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="email" class="cols-sm-2 control-label">date</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></i></span>
									<input type="date" data-toggle="datepicker" class="form-control" name="callsheet_date" id="datepicker1"  placeholder="Sat, Aug 19, 2017" value="<?php echo $project[0]->date; ?>" required />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6 rightside">
							<label for="username" class="cols-sm-2 control-label">time</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
									<input type="time" class="form-control timepicker" name="callsheet_time" id="time"  placeholder="7:00am" value="<?php echo $project[0]->time; ?>" required />
								</div>
							</div>
						</div>
						<div class="form-group cols-sm-6">
							<label for="name" class="cols-sm-2 control-label">Director Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="director_name" value="<?php echo $project[0]->director_name; ?>" id="director_name"  placeholder="Enter Name" required />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="name" class="cols-sm-2 control-label">Phone No.</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $project[0]->phone; ?>"  placeholder="Enter Phone No." required />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="name" class="cols-sm-2 control-label">Producer Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="producer_name" id="producer_name"  placeholder="Enter Name" value="<?php echo $project[0]->producer_name; ?>" required />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="name" class="cols-sm-2 control-label">Phone No.</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="producer_phone" id="producer_phone"  placeholder="Enter Phone No." value="<?php echo $project[0]->producer_phone; ?>" required />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="name" class="cols-sm-2 control-label">Assitant Director Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="adirector_name" id="adirector_name"  placeholder="Enter Name" value="<?php echo $project[0]->adirector_name; ?>" required />
								</div>
							</div>
						</div>

						<div class="form-group cols-sm-6">
							<label for="name" class="cols-sm-2 control-label">Phone No.</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="adirectorphone" id="adirectorphone"  placeholder="Enter Phone No." value="<?php echo $project[0]->adirector_phone; ?>" required />
								</div>
							</div>
						</div>

						<div class="form-group ">
							<label for="name" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									 <textarea class="form-control" rows="3"   name="location" id="exampleTextarea"  placeholder="Enter Address" required><?php echo $project[0]->location; ?></textarea>

									
								</div>
							</div>
						</div>

						<!-- <div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Import schedule from</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
									<input  type="text" class="form-control" name="textarea" id="textarea"  placeholder="Import schedule from stripboard (optional)…"/>
								</div>
							</div>
						</div> -->

					

						<!--<div class="form-group ">
							<a href="http://deepak646.blogspot.in" target="_blank" type="button" id="button" class="btn btn-primary btn-lg btn-block login-button">Register</a>
						</div>-->
						
					
					<div class="select-type-bx">
					<h3><span> 2.</span> Select Type </h3>
					 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 chooseType" id="shootday">
					  <div class="select-type-inr <?php 
					  		if($project[0]->type == 'shootday')
					  			echo 'active';
					  ?>">
					  <a href="javascript:void(0)">
					  <span><i class="fa fa-bullseye" aria-hidden="true"></i></span>

					  <h2>Shoot Day</h2>
					  
					  </a>
					 
					 
					
					</div>
					</div>
					
					 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 chooseType" id="scout">
					  <div class="select-type-inr <?php 
					  		if($project[0]->type == 'scout')
					  			echo 'active';
					  ?>">
					  <a href="javascript:void(0)">
					 <i class="fa fa-gamepad" aria-hidden="true"></i>

					  <h2>Scout</h2>
					  
					  </a>
					 
					 
					
					</div>
					</div>
					 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 chooseType" id="rehearsal">
					  <div class="select-type-inr <?php 
					  		if($project[0]->type == 'rehearsal')
					  			echo 'active';
					  ?>">
					  <a href="javascript:void(0)">
					  <span><i class="fa fa-user-secret" aria-hidden="true"></i></span>

					  <h2>Rehearsal</h2>
					  
					  </a>
					 
					 
					
					</div>
					</div>
					 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 chooseType" id="meeting">
					  <div class="select-type-inr <?php 
					  		if($project[0]->type == 'meeting')
					  			echo 'active';
					  ?>">
					  <a href="javascript:void(0)">
					  <span><i class="fa fa-users" aria-hidden="true"></i></span>

					  <h2>Meeting</h2>
					  
					  </a>
					 
					 
					
					</div>
					</div>
					
					</div> 
			
		
			</div> <!--  mid-page  -->
		</div>
	</div>
	</div>
			<div class="select-type-bx bottom-bx">
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
					<input type="hidden" class="call_type" value="<?php echo $project[0]->type; ?>" name="call_type">
					<input type="submit" value="Next" id="next" class="btn btn-default"/>
					
					</div>
					
					
					</div>
					
					</div>
					</div>
					</div>
					
					</div>
					</form>
	</div>

	<script>
		$('.chooseType').click(function(){
			var call_val = $(this).attr('id');
			$('.call_type').val(call_val);
			$('.select-type-inr').removeClass('active');
			$(this).find('.select-type-inr').addClass('active');
		});

		$('.timepicker').timepicker();
	</script>
<script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
      	format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
      });
    });
  </script>
  </body>
  </html>