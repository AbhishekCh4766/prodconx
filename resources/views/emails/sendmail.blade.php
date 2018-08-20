<div style="float:left; width:100%; margin:0 auto; text-align:center; background-color:#edecec; padding: 18px 3px;">
	<div style="background-color:#fff; border:1px solid #888888; width:60%; margin: 0 20%; float:left;   box-shadow: 0 4px 13px #888888;    padding: 16px;">
		<div class="row" style="padding:0px 20px;">
			<div class="col-lg-4 col-xs-12 col-sm-4" style="float:left; width:25%; text-align:left; border-right:1px solid #e5e5e5;">
				<h3>Test</h3>
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
				<h3 style="color: #0360e1; font-size: 21px; margin-top: 4px; margin-bottom:10px;">
					<?php echo $project[0]->title; ?>
				</h3>
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
				</p>
			</div>

		</div>

		<div class="row" style="float:left; width:100%;  margin-top: 20px;">
			<div class="col-lg-12 col-xs-12 col-sm-12">
				<a href="<?php echo $link; ?>"><?php echo $link; ?></a>
			</div>
		</div>
	</div>
</div>