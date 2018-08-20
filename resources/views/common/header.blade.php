<?php
	$uid = Session::get('user_id');

	$users = App\User::where('id',$uid)->first();
?>
<style>
	a.fa-globe {
      position: relative;
    font-size: 32px;
    color: grey;
    cursor: pointer;
    top: 2px;
    float: left;
    right: -23px;
}
span.fa-comment {
  position: absolute;
  font-size: 0.6em;
  top: -4px;
  color: red;
  right: -4px;
}
</style>
<div class="top-bar">
	<div class="container">
		<div class="main-logo"><a href="{{ url('userDashboard') }}"><img src="{{ URL::asset('front-end/images/logo-white1.png')}}"></a></div>
		
		<div class="header-right-section">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
						  <span class="sr-only">Toggle navigation</span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</button>
					</div>
					
					<div class="navbar-collapse collapse" id="navbar" aria-expanded="false" style="height: 1px;">
						<ul class="nav navbar-nav navbar-right">
						  <!-- <li class="active"><a href="{{URL::to('userDashboard') }}">Home <span class="sr-only">(current)</span></a></li> -->
							<?php 	if(Session::get('user_type_id') == 1 ) { ?>							  
						  <!-- <li><a href="{{URL::to('package')}}">Pricing</a></li>
						  <li><a href="{{URL::to('history')}}">My Payments</a></li> -->
							<?php } ?>							  
						 
						
							<!-- <li class="dropdown"><a href="javascript:;">Job Post</a>
										
									 
									  <div class="dropdown-content">
										<a href="{{URL::to('job')}}">Create Job</a>
										<a href="{{URL::to('myJobListing')}}">My Listing</a>								
										<a href="{{URL::to('jobListing')}}">Job Listing</a>								
									  </div>
									
									</li> -->	
							
						<?php 	if(Session::get('user_type_id') == 1 ) { ?>
							<!-- <li class="dropdown"><a href="javascript:;">Rental Post</a>
									
								 
								  <div class="dropdown-content">
									<a href="{{URL::to('rentalJob')}}">Create Rental</a>
									<a href="{{URL::to('myRentalJob')}}">My Rental Listing</a>								
									<a href="{{URL::to('RentalJobListing')}}">All Rental Listing</a>								
								  </div>
								
								</li> -->	
						<?php } ?>
						<?php 	if(Session::get('user_type_id') == 2 ) { ?>							
						   <!-- <li class="dropdown"><a href="javascript:;">My CallSheet</a>
						   							  <div class="dropdown-content">
						   								<a href="{{URL::to('confirmCallsheet')}}">Confirm CallSheet</a>
						   								<a href="{{URL::to('pendingCallsheet')}}">Pending CallSheet</a>
						   							  </div>
						   							
						   							</li> -->
							<?php } ?>
						</ul>
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
			
			<div class="side-bar">
				<div class="row"><?php if(Session::get('user_type_id') == 2 ) { ?>
					<!-- <div class="col-lg-12 col-mg-12 col-xs-12 space-icon">
						<a href="{{URL::to('chat')}}"><img src="{{ URL::asset('front-end/images/notification-icon-white1.png')}}"></a>
						<span ><?php //echo $friendCount;?></span>
					
					</div> -->
					
					<!-- <div class="col-lg-12 col-mg-12 col-xs-12 space-icon" >
					
						<a href="{{URL::to('friend')}}" > <img src="{{ URL::asset('front-end/images/notification-icon-white2.png')}}"></a>
						<?php if($friendCount > 0 ) { ?>
						<span id="friend_id" ><?php //echo $friendCount;?></span>
						<?php } ?>
					
					</div> -->
					
				<?php } ?>	
				</div>
			</div>

			<div class="dropdown header_notification">
				<!-- <a class="fa fa-globe">
				  <span class="fa fa-comment"></span>
				  <span class="num">2</span>
				</a> -->
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<i class="fa fa-globe"></i>
					<span class="num"></span>
				</button>
				<ul id="notifications_here" class="dropdown-menu" aria-labelledby="dropdownMenu2">
					<!-- <li><a href="{{URL::to('profile')}}">Profile</a></li>
					<li><a href="{{URL::to('userLogout')}}">Log-Out</a></li>
					<li><a href="{{URL::to('userLogout')}}">Log-Out</a></li>
					<li><a href="{{URL::to('userLogout')}}">Log-Out</a></li>
					<li><a href="{{URL::to('userLogout')}}">Log-Out</a></li>
					<li class="notification_see_all"><a href="#">See All</a></li> -->
				</ul>
			</div>
			
			<div class="dropdown logout">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<img src="{{ URL::asset('profilepics')}}/{{ $users->profile_pic }}">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a href="{{URL::to('profile')}}">Profile</a></li>
					<li><a href="{{URL::to('userLogout')}}">Log-Out</a></li>
					<!-- <li role="separator" class="divider"></li> 
					<li><a href="#">Separated link</a></li>-->
				</ul>
			</div>

			

		</div>
	</div>
</div>
<style>
.dropbtn {
    /* background-color: #4CAF50; */
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
	/* z-index:9999; */
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 170px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	left:-39px;
	background-color: #edeef2;
}

.dropdown-content a {
    color: #0360e1;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}

</style>

<!-- <script>

$(window).scroll(function() {
    var scroll = $(window).scrollTop();
     //console.log(scroll);
    if (scroll >= 60) {
        //console.log('a');
        $(".mid-page").addClass("mid-page-scroll");
    } else {
        //console.log('a');
        $(".mid-page").removeClass("mid-page-scroll");
    }
});	

</script> -->
	<?php
		$uid = Session::get('user_id');
		$count12 = App\Models\NotificationModel::where('created_by',$uid)->where('is_seen',0)->count();
		$notify_data = App\Models\NotificationModel::where('created_by',$uid)->where('is_seen',0)->get();

		//print_r($notify_data);
	?>
	<script>
	
		jQuery('.navbar-nav a').click(function(e){
			event.stopPropagation();
			jQuery(this).next().toggle()
		});
		

		jQuery(document).on('ready',function(){
			//alert('sSsS');

			var count12 = "<?php echo $count12 ?>";
			if(count12 == 0){
				jQuery('.num').html(0);
			}else{
				jQuery('.num').html(count12);
				
				var jqueryarray = <?php echo json_encode($notify_data); ?>;
				//console.log(jqueryarray);
		        jQuery.each(jqueryarray, function(index, value){
            		var userid = value.user_id;
            		var callsheet_id = value.callsheet_id;
            		var team_id = value.team_id;
            		jQuery.ajax({
			          	url: 'getnotificationusername',
			          	type: "post",
			          	data: {_token: "{{ csrf_token() }}",userid:userid,callsheet_id:callsheet_id,team_id:team_id},
			           	success: function(response){
			           		var mylink = '<?php echo url('/callsheet_notification'); ?>';

				          	var data = '<li><a target="_blank" href="'+mylink+'/'+response.team_id+'/'+response.callsheet_id+'">'+response.name+' Accepted your Invitation</a></li>';
				          	jQuery('#notifications_here').append(data);
			        	}
        			});
		        });

				/*$( daataa ).each(function( index ) {
				  console.log( index );
				});*/
				/*var data = '<li><a href="#">Profile</a></li>';
				jQuery('#notifications_here').html(data);*/
			}
		});
	</script>