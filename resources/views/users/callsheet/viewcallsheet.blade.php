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
	<div class="mid-page addCallsheet-main">
		<div class="container">
			<div class="modal-dialog call-sheet-preview" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">CallSheet</h4>
					</div>
					<div class="">
						<div class="call-sheet-made">
							<div class="row row-first-section-call-sheet">
								<div class="col-lg-4 col-xs-4 col-sm-4 first-child">
									
									<ul class="person">
										<li class="role strong">Director Details</li>
										<li class="name-a"><?php echo $project[0]->director_name; ?></li>
										<li class="phone"><?php echo $project[0]->phone; ?></li>
									</ul>
									<ul class="person">
										<li class="role strong">Producer Details</li>
										<li class="name-a"><?php echo $project[0]->producer_name; ?></li>
										<li class="phone"><?php echo $project[0]->producer_phone; ?></li>
									</ul>
									<ul class="person">
										<li class="role strong">Assistant Director Details</li>
										<li class="name-a"><?php echo $project[0]->adirector_name; ?></li>
										<li class="phone"><?php echo $project[0]->adirector_phone; ?></li>
									</ul>
									<p><span><?php echo $project[0]->location; ?></span></p>
								</div>

								<div class="col-lg-4 col-xs-4 col-sm-4 second-child" style="text-align: center;">
									<div class="image-logo">
										@if($pro_data->project_image != '')
											<img src="<?php echo url() ?>/projectsimg/<?php echo $pro_data->project_image; ?>">
										@else
											<img src="<?php echo url() ?>/front-end/images/callsheet.png">
										@endif
									</div>
									<h5><?php echo $project[0]->title; ?></h5>
									<p>General Call Time</p>
									<h4><?php echo $project[0]->time; ?></h4>
									<h4><?php echo date('F j, Y',strtotime($project[0]->date)); ?></h4>
								</div>
								<div class="col-lg-4 col-xs-4 col-sm-4 third-child">
									<p><?php echo 'Created at '.date('F j, Y',strtotime($project[0]->created_at));?></p>
									<p>Crew Call:<?php echo $project[0]->time; ?></p>
									<p>Callsheet Type:<?php echo $project[0]->type; ?></p>
									<br/>
									<p>
										<?php 
											$data = $model->getweather();
											echo $data['state'].', '.$data['country']; 
										?>
									</p>
									<p>
									<?php 
										 
										echo round($data['temperature']).' &deg;C';
									?>
									</p>
									<p>
										<?php echo $data['main']; ?>
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<!--Locations-->
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<h4 style="text-align: center;">LOCATION(S) 
							<?php 
                             	$callsheet_id= Request::segment(3);
                             	$loc = null;
							
							 	$loc =  App\Models\Callsheet_Location::where('callsheet_id', $callsheet_id)->pluck('location_id');
								$exploded_array = explode(',', $loc);
								$y = 1;
								foreach ($exploded_array as $element){
							?>
							
							<?php 
								$y++;
							} ?>
							</h4>
							<table class="table">
							    <thead>
							      <tr>
							      	<th></th>
							        <th>Shooting Location</th>
							        <th>Parking & Instructions</th>
							        <th>Nearest Hospital</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php 
                                     	$callsheet_id= Request::segment(3);
                                     	$loc = null;
									
									 	$loc =  App\Models\Callsheet_Location::where('callsheet_id', $callsheet_id)->pluck('location_id');
										$exploded_array = explode(',', $loc);
										$x = 1;
										foreach ($exploded_array as $element){
									?>
							      <tr>
							        <td>{{ $x }}</td>
							        <td>{{App\Location::where('id', $element)->pluck('project_location')}}</td>
							        <td>{{ App\Location::where('id', $element)->pluck('parking') }}, {{App\Location::where('id', $element)->pluck('notes')}}</td>
							        <td>{{App\Location::where('id', $element)->pluck('nearest_hospital')}}</td>
							      </tr>
							      <?php
							      	$x++; 
							  		} 
							  	?>
							    </tbody>
						  	</table>
						</div>

						<!--Schedule-->
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<h4 style="text-align: center;">SCHEDULE</h4>
							<table class="table">
							    <thead>
							      <tr>
							      	<th></th>
							        <th>Time</th>
							        <th>Scene</th>
							        <th>Description</th>
							        <th>D/N</th>
							        <th>Cast</th>
							        <th>Location</th>
							      </tr>
							    </thead>
							    <tbody>
							    <?php $v = 1; ?>
							    @foreach($schedules as $schedule)
							      <tr>
							        <td>{{$v}}</td>
							        <td>
							        	@if($schedule->schedule_time != '')
											{{$schedule->schedule_time}}
							        	@else
											-
							        	@endif
							        </td>
							        <td>
							        	@if($schedule->schedule_scene != '')
											{{$schedule->schedule_scene}}
							        	@else
											-
							        	@endif
							        </td>
							        <td>
							        	@if($schedule->schedule_desc != '')
											{{$schedule->schedule_desc}}
							        	@else
											-
							        	@endif
							        </td>
							        <td>
							        	@if($schedule->schedule_dn != '')
											@if($schedule->schedule_dn == 1)
												D
											@else
												N
											@endif
							        	@else
											-
							        	@endif
							        </td>
							        <td>
							        	@if($schedule->schedule_cast != '')
											{{$schedule->schedule_cast}}
							        	@else
											-
							        	@endif
							        </td>
							        <td>
							        	@if($schedule->schedule_location != '')
											{{$schedule->schedule_location}}
							        	@else
											-
							        	@endif
							        </td>
							      </tr>
							      <?php $v++; ?>
							    @endforeach
							    </tbody>
						  	</table>
						</div>

						<!--CREW-->
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<h4 style="text-align: center;">CREW(S)</h4>

							<!--Production-->
							@if(in_array('1',$condata))
							<h5 class="text-style">Production</h5>
							<table class="table">
							    <thead>
							      <tr>
							      	<th></th>
							        <th>Name</th>
							        <th>Phone</th>
							        <th>Email</th>
							        <th>Role</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php $production = 1; ?>
									@foreach($contacts as $contact)
										@if($contact->department_id == 1)
											<tr>
										        <td>{{$production}}</td>
										        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
										        <td>
										        	@if($contact->phone != '')
										        		{{$contact->phone}}
										        	@else
										        		-
										        	@endif
										        </td>
										        <td>
										        	@if($contact->email != '')
										        		{{$contact->email}}
										        	@else
										        		-
										        	@endif
										        	
										        </td>
										        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
									      	</tr>
								      		<?php $production++; ?>
								      	@endif
							      	@endforeach
							    </tbody>
							</table>
							@endif

							<!--Camera-->
							@if(in_array('2',$condata))
							<h5 class="text-style">Camera</h5>
							<table class="table">
							    <thead>
							      <tr>
							      	<th></th>
							        <th>Name</th>
							        <th>Phone</th>
							        <th>Email</th>
							        <th>Role</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php $camera = 1; ?>
									@foreach($contacts as $contact)
										@if($contact->department_id == 2)
											<tr>
										        <td>{{$camera}}</td>
										        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
										        <td>
										        	@if($contact->phone != '')
										        		{{$contact->phone}}
										        	@else
										        		-
										        	@endif
										        </td>
										        <td>
										        	@if($contact->email != '')
										        		{{$contact->email}}
										        	@else
										        		-
										        	@endif
										        	
										        </td>
										        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
									      	</tr>
								      		<?php $camera++; ?>
								      	@endif
							      	@endforeach
							    </tbody>
							</table>
							@endif

							<!--Catering-->
							@if(in_array('3',$condata))
								<h5 class="text-style">Catering</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $catering = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 3)
												<tr>
											        <td>{{$catering}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $catering++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Art-->
							@if(in_array('4',$condata))
								<h5 class="text-style">Art</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $art = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 4)
												<tr>
											        <td>{{$art}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $art++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif
							

							<!--Sound-->
							@if(in_array('6',$condata))
								<h5 class="text-style">Sound</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $sound = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 6)
												<tr>
											        <td>{{$sound}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $sound++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Hair and Make up-->
							@if(in_array('7',$condata))
								<h5 class="text-style">Hair and Makeup</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $hair = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 7)
												<tr>
											        <td>{{$hair}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $hair++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Grip-->
							@if(in_array('8',$condata))
								<h5 class="text-style">Grip</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $grip = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 8)
												<tr>
											        <td>{{$grip}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $grip++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Visual FX-->
							@if(in_array('9',$condata))
								<h5 class="text-style">Visual FX</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $visual = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 9)
												<tr>
											        <td>{{$visual}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $visual++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Property-->
							@if(in_array('10',$condata))
								<h5 class="text-style">Property</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $property = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 10)
												<tr>
											        <td>{{$property}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $property++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Special FX-->
							@if(in_array('11',$condata))
								<h5 class="text-style">Special FX</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $special = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 11)
												<tr>
											        <td>{{$special}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $special++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Costumes-->
							@if(in_array('12',$condata))
								<h5 class="text-style">Costumes</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $costumes = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 12)
												<tr>
											        <td>{{$costumes}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $costumes++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Construction-->
							@if(in_array('13',$condata))
								<h5 class="text-style">Construction</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $construction = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 13)
												<tr>
											        <td>{{$construction}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $construction++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif

							<!--Accounting-->
							@if(in_array('14',$condata))
								<h5 class="text-style">Accounting</h5>
								<table class="table">
								    <thead>
								      <tr>
								      	<th></th>
								        <th>Name</th>
								        <th>Phone</th>
								        <th>Email</th>
								        <th>Role</th>
								      </tr>
								    </thead>
								    <tbody>
										<?php $accounting = 1; ?>
										@foreach($contacts as $contact)
											@if($contact->department_id == 14)
												<tr>
											        <td>{{$accounting}}</td>
											        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
											        <td>
											        	@if($contact->phone != '')
											        		{{$contact->phone}}
											        	@else
											        		-
											        	@endif
											        </td>
											        <td>
											        	@if($contact->email != '')
											        		{{$contact->email}}
											        	@else
											        		-
											        	@endif
											        	
											        </td>
											        <td>{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
										      	</tr>
									      		<?php $accounting++; ?>
									      	@endif
								      	@endforeach
								    </tbody>
								</table>
							@endif
						</div>
					</div>

					<div class="row viewBackBtn">
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<a href="{{URL::to('team')}}/{{Request::segment(2)}}" class="btn btn-default pull-right">Back</a>
						</div>
					</div>
				</div>					
																	
			</div>		
		</div>
	</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
</body>
</html>