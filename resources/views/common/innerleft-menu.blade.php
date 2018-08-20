<?php //echo'<pre>'; print_r($users); die;?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="col-lg-2 col-xs-2 col-sm-2 side-bar-settings static">
	<div class="fixed fixed-one">
		<ul class="nav-news-feed">
			<li>
				<a href="{{URL::to('userDashboard') }}">
					<i class="fa fa-home" aria-hidden="true"></i>
					<div>
						Home
					</div>
				</a>
			</li>

			<?php if($users->user_type_id == 2 ) { ?>
				<li>
					<?php if(Session::get('user_type_id') == 2 ) { ?>
						<a href="{{URL::to('friend')}}">
					<?php } else {?>
						<a>
					<?php } ?>
						<i class="fa fa-users" aria-hidden="true"></i>
						<div>
							Friends (<?php echo $users->created_at; ?>)
						</div>
					</a>
				</li>
			<?php } if($users->user_type_id == 1 ) { ?>
				<li>
					<?php if(Session::get('user_type_id') == 1 ) { ?>
						<a href="{{URL::to('companies')}}">
					<?php } else {?>
						<a>
					<?php } ?>

					<i class="fa fa-users" aria-hidden="true"></i>
					<div>
						Followers (<?php echo $users->created_at; ?>)
					</div>
					</a>
				</li>
			<?php } ?>
			<li>
				<a href="{{URL::to('contact')}}">
					<i class="fa fa-address-book" aria-hidden="true"></i>
					<div>
						My Contacts
					</div>
				</a>
			</li>
			<li>
				<a href="{{URL::to('confirmCallsheet')}}">
					<i class="fa fa-file-text" aria-hidden="true"></i>
					<div>
						My Callsheets
					</div>
				</a>
			</li>
			<li>
				<a href="{{URL::to('myJobListing')}}">
					<i class="fa fa-fax" aria-hidden="true"></i>
					<div>
						My Job Listings
					</div>
				</a>
			</li>
			
			<?php 	if(Session::get('user_type_id') == 1 ) { ?>
				<li>
					<a href="{{URL::to('package')}}">
						<i class="fa fa-building" aria-hidden="true"></i>
						<div>
							Pricing
						</div>
					</a>
				</li>

				<li>
					<a href="{{URL::to('history')}}">
						<i class="fa fa-building" aria-hidden="true"></i>
						<div>
							My Payments
						</div>
					</a>
				</li>
				
				<li>
					<i class="fa fa-fax" aria-hidden="true"></i>
					<a href="javascript:void" id="btn-1" data-toggle="collapse" data-target="#submenu2" aria-expanded="false">Rental Post</a>
					<ul class="nav collapse" id="submenu2" role="menu" aria-labelledby="btn-1">
						<li><a href="{{ url('/rentalJob') }}">Create Rental</a></li>
						<li><a href="{{ url('/myRentalJob') }}">My Rental Listing</a></li>
						<li><a href="{{ url('/RentalJobListing') }}">All Rental Listing</a></li>
					</ul>
				</li>
			<?php } ?>
			<!-- <li>
				<i class="fa fa-globe" aria-hidden="true"></i>
				<?php 
					if($users->website == "" ) { 
						$website="No Website Link";
					}else{ 
						$link = $users->website; 
						$website = $users->website;
						//echo '<a href="'.$link.'" target="_blank" >';
					} 
				?>
				<div>
					<a href="{{URL::to('jobListing')}}"><?php echo $website; ?></a>
				</div>
			</li> -->

		</ul><!--news-feed links ends-->
	   
		<?php 	if(Session::get('user_type_id') == 2 ) { ?>
		<ul class=" nav-news-feed Premium">
			<h4>Current Projects</h4>
			<?php 
				for ($i=0;$i<count($users->ip);$i++ ) {					
					if(isset($users->ip[$i]->id)) {
												
			?>
			<li>
				<a href="{{URL::to('project')}}/<?php echo $users->ip[$i]->id; ?> ">
					<i class="fa fa-tasks" aria-hidden="true"></i>
					<div>
						<?php echo $users->ip[$i]->project_name; ?>	
					</div>
				</a>
			</li>
			<?php } 
				}
			?>
			<li>
				<a href="{{URL::to('projects')}}">
					<i class="fa fa-tasks" aria-hidden="true"></i>
					<div>
						Add Project	
					</div>
				</a>
			</li>
		</ul>	
		<?php } ?>		
	</div>	
</div>	