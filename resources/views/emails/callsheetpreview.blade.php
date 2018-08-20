<div style="float:left; width:100%; margin:0 auto; text-align:center; background-color:#edecec; padding: 18px 3px;">
<div style="background-color:#fff; border:1px solid #888888; width:60%; margin: 0 20%; float:left;   box-shadow: 0 4px 13px #888888;    padding: 16px;">
<div class="row" style="padding:0px 20px;">
<div class="col-lg-4 col-xs-12 col-sm-4" style="float:left; width:25%; text-align:left; border-right:1px solid #e5e5e5;">

<ul style="padding-left:0px;">
	<li style="list-style:none; color: #858589;"> Director / Prod.</li>
 	<li style="list-style:none; color: #858589;"><?php echo $project[0]->director_name; ?></li>
	<li style="list-style:none; color: #858589;"><?php echo $project[0]->phone; ?></li>
</ul>
<ul style="padding-left:0px;">
	<li style="list-style:none; color: #858589;">Producer Details</li>
	<li style="list-style:none; color: #858589;"><?php echo $project[0]->producer_name; ?></li>
	<li style="list-style:none; color: #858589;"><?php echo $project[0]->producer_phone; ?></li>
</ul>
<ul style="padding-left:0px;">
	<li style="list-style:none; color: #858589;">Assistant Director Details</li>
	<li style="list-style:none; color: #858589;"><?php echo $project[0]->adirector_name; ?></li>
	<li style="list-style:none; color: #858589;"><?php echo $project[0]->adirector_phone; ?></li>
</ul>

<p style="color: #858589; font-size: 16px;"><?php echo $project[0]->location; ?></p>
</div>

<div class="col-lg-4 col-xs-12 col-sm-4" style="float:left; width:49%; text-align:center; border-right:1px solid #e5e5e5;">
<div style="border-radius: 50%;  display: table;   height: 54px;   margin: 0 auto; padding: 16px; width: 54px;">
	@if($pro_data->project_image != '')
		<img src="<?php echo url() ?>/projectsimg/<?php echo $pro_data->project_image; ?>" style=" height: 70px;   width: 70px;border-radius: 50%;">
	@else
		<img src="<?php echo url() ?>/front-end/images/callsheet.png" style=" height: 70px;   width: 70px;border-radius: 50%;">
	@endif
</div>
<h3 style="color: #0360e1; font-size: 21px; margin-top: 4px; margin-bottom:10px;"><?php echo $project[0]->title; ?></h3>
<p style="color: #858589; font-size: 16px; margin-top:4px; margin-bottom:0px;">General Call Time</p>
<h5 style="font-size:24px; margin-top: 10px;"><?php echo $project[0]->time; ?></h5>
<h4><?php echo date('F j, Y',strtotime($project[0]->date)); ?></h4>
</div>


<div class="col-lg-4 col-xs-12 col-sm-4" style="float:left; width:25%; text-align:center;">
	<p style="color: #858589; font-size: 16px;">
		<?php echo 'Created at '.date('F j, Y',strtotime($project[0]->created_at));?>
		<br>Crew Call:<?php echo $project[0]->time; ?>
		<br>Callsheet Type: <?php echo $project[0]->type; ?>
		<br/>
		<p style="color: #858589; font-size: 16px;">
			<?php 
				$data = $model->getweather();
				echo $data['state'].', '.$data['country']; 
				echo '<br>';
				echo round($data['temperature']).' &deg;C';
				echo '<br>';
				echo $data['main'];
			?>
		</p>
		<!-- <p style="color: #858589; font-size: 16px;">
		<?php 
			 
			//echo round($data['temperature']).' &deg;C';
		?>
		</p>
		<p style="color: #858589; font-size: 16px;">
			<?php //echo $data['main']; ?>
		</p> -->
	</p>
</div>




</div>

<div class="row" style="float:left; width:100%;  margin-top: 20px;">
<div class="col-lg-12 col-xs-12 col-sm-12">


<a href="<?php echo $link; ?>">Confirm Link</a>
</div>

<div class="row" style="text-align: left !important;">
	<!--Locations-->
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<h4 style="text-align: center;">LOCATION(S)</h4>
		<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
		    <thead>
		      <tr>
		      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Shooting Location</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Parking & Instructions</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Nearest Hospital</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php 
                 	$callsheet_id= $mycallsheet;
                 	$loc = null;
				
				 	$loc =  App\Models\Callsheet_Location::where('callsheet_id', $callsheet_id)->pluck('location_id');
					$exploded_array = explode(',', $loc);
					$x = 1;
					foreach ($exploded_array as $element){
				?>
		      <tr>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{ $x }}</td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Location::where('id', $element)->pluck('project_location')}}</td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{ App\Location::where('id', $element)->pluck('parking') }}, {{App\Location::where('id', $element)->pluck('notes')}}</td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Location::where('id', $element)->pluck('nearest_hospital')}}</td>
		      </tr>
		      <?php
		      	$x++; 
		  		} 
		  	?>
		    </tbody>
	  	</table>
	</div>
	<br />
	<!--Schedule-->
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<h4 style="text-align: center;">SCHEDULE</h4>
		<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
		    <thead>
		      <tr>
		      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Time</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Scene</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Description</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">D/N</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Cast</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Location</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php $v = 1; ?>
		    @foreach($schedules as $schedule)
		      <tr>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$v}}</td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
		        	@if($schedule->schedule_time != '')
						{{$schedule->schedule_time}}
		        	@else
						-
		        	@endif
		        </td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
		        	@if($schedule->schedule_scene != '')
						{{$schedule->schedule_scene}}
		        	@else
						-
		        	@endif
		        </td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
		        	@if($schedule->schedule_desc != '')
						{{$schedule->schedule_desc}}
		        	@else
						-
		        	@endif
		        </td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
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
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
		        	@if($schedule->schedule_cast != '')
						{{$schedule->schedule_cast}}
		        	@else
						-
		        	@endif
		        </td>
		        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
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
	<br/>
	<!--CREW-->
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<h4 style="text-align: center;">CREW(S)</h4>
		<!--Production-->
		@if(in_array('1',$condata))
		<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Production</h5>
		<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
		    <thead>
		      <tr>
		      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php $production = 1; ?>
				@foreach($contacts as $contact)
					@if($contact->department_id == 1)
						<tr>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$production}}</td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
					        	@if($contact->phone != '')
					        		{{$contact->phone}}
					        	@else
					        		-
					        	@endif
					        </td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
					        	@if($contact->email != '')
					        		{{$contact->email}}
					        	@else
					        		-
					        	@endif
					        	
					        </td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
				      	</tr>
			      		<?php $production++; ?>
			      	@endif
		      	@endforeach
		    </tbody>
		</table>
		@endif

		<!--Camera-->
		@if(in_array('2',$condata))
		<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Camera</h5>
		<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
		    <thead>
		      <tr>
		      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
		        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php $camera = 1; ?>
				@foreach($contacts as $contact)
					@if($contact->department_id == 2)
						<tr>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$camera}}</td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
					        	@if($contact->phone != '')
					        		{{$contact->phone}}
					        	@else
					        		-
					        	@endif
					        </td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
					        	@if($contact->email != '')
					        		{{$contact->email}}
					        	@else
					        		-
					        	@endif
					        	
					        </td>
					        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
				      	</tr>
			      		<?php $camera++; ?>
			      	@endif
		      	@endforeach
		    </tbody>
		</table>
		@endif

		<!--Catering-->
		@if(in_array('3',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Catering</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $catering = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 3)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$catering}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $catering++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Art-->
		@if(in_array('4',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Art</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $art = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 4)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$art}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $art++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif
		

		<!--Sound-->
		@if(in_array('6',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Sound</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $sound = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 6)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$sound}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $sound++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Hair and Make up-->
		@if(in_array('7',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Hair and Makeup</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $hair = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 7)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$hair}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $hair++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Grip-->
		@if(in_array('8',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Grip</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $grip = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 8)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$grip}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $grip++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Visual FX-->
		@if(in_array('9',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Visual FX</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $visual = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 9)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$visual}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $visual++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Property-->
		@if(in_array('10',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Property</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $property = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 10)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$property}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $property++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Special FX-->
		@if(in_array('11',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Special FX</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $special = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 11)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$special}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $special++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Costumes-->
		@if(in_array('12',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Costumes</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $costumes = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 12)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$costumes}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $costumes++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Construction-->
		@if(in_array('13',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Construction</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $construction = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 13)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$construction}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $construction++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

		<!--Accounting-->
		@if(in_array('14',$condata))
			<h5 style="padding: 4px;font-size: 15px;background: #0360e1;margin-bottom: 0px;text-transform: uppercase;color: #fff;float: left;width: 100%;">Accounting</h5>
			<table cellpadding="0" cellspacing="0" style="float: left; width: 100%;">
			    <thead>
			      <tr>
			      	<th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;"></th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Name</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Phone</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Email</th>
			        <th style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">Role</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php $accounting = 1; ?>
					@foreach($contacts as $contact)
						@if($contact->department_id == 14)
							<tr>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$accounting}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{$contact->first_name}} {{$contact->last_name}}</td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->phone != '')
						        		{{$contact->phone}}
						        	@else
						        		-
						        	@endif
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">
						        	@if($contact->email != '')
						        		{{$contact->email}}
						        	@else
						        		-
						        	@endif
						        	
						        </td>
						        <td style=" border: 1px solid #e1e1e1; padding: 8px;text-align: center; color: #333333;">{{App\Models\Department_roles::where('id',$contact->department_role_id)->pluck('name')}}</td>
					      	</tr>
				      		<?php $accounting++; ?>
				      	@endif
			      	@endforeach
			    </tbody>
			</table>
		@endif

	</div>

</div>

</div>
</div>
</div>
</div>