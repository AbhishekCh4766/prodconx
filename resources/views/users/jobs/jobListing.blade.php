@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <body>
  	<style>
  		.user-comment {
		    float: right;
		    width: 91%;
		}
		.blog-comments ul li h5 {
		    float: left;
		    margin: 0;
		    width: 100%;
		}
		.blog-comments ul li p {
		    float: left;
		    font-size: 12px;
		    margin: 0;
		    width: 100%;
		}
		.blog-comments ul li h5 p {
		    color: #cdcdcd;
		    float: right;
		    font-size: 10px;
		    width: auto;
		}
		.blog-comments ul.all-comments li .user-icon-who-commented {
    float: left;
    width: 6%;
}
.blog-comments ul li .user-icon-who-commented img {
    border-radius: 50%;
    height: 30px;
    width: 30px !important;
}
  	</style>
  <!-- top-bar -->
<?php
define( 'TIMEBEFORE_NOW',         'Just now' );
    define( 'TIMEBEFORE_MINUTE',      '{num} minute ago' );
    define( 'TIMEBEFORE_MINUTES',     '{num} minutes ago' );
    define( 'TIMEBEFORE_HOUR',        '{num} hour ago' );
    define( 'TIMEBEFORE_HOURS',       '{num} hours ago' );
    define( 'TIMEBEFORE_YESTERDAY',   'yesterday' );
    define( 'TIMEBEFORE_FORMAT',      '%b %e, %Y' );
    define( 'TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y' );
function time_ago( $time ){
    	$time = strtotime($time);
    	
        $out    = ''; // what we will print out
        $now    = time(); // current time
        $diff   = $now - $time; // difference between the current and the provided dates

        if( $diff < 60 ) // it happened now
            return TIMEBEFORE_NOW;

        elseif( $diff < 3600 ) // it happened X minutes ago
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

        elseif( $diff < 3600 * 24 ) // it happened X hours ago
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

        elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
            return TIMEBEFORE_YESTERDAY;

        else // falling back on a usual date format as it happened later than yesterday
            return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
}

?>
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
							<div class="common-right-section">
								
							
								
							</div>
					</div>
						
						<div class="col-lg-8 col-xs-8 col-sm-8 jobs-common-class rental-common-class job-posting-common-class middle-section">
							<div class="row">
									<div class="right-side">
									
										<div class="row personal-info">
										
											<div class="heading-search">
												<h3>Job Listing</h3>
												<p class="job-posting-heading-bottom">Search By Job Title</p>
                                                 <div class="filter-div listing">
												 	<input class="form-control" type="search" placeholder="Search By Job Title" id="search-here" >
												  <select class="form-control fliter-category" id="sel1">
												  
													<option value="">Select Category</option>
													@foreach($jobCat as $val)
														<option value="{{$val->cat_name}}">{{$val->cat_name}}</option>
													@endforeach	
													
												  </select>

											
												<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">	</div>											
											</div>
											<div class="row joblistingstatus" style="display: none;">
												<div class="col-md-12">
													<div class="alert alert-success">
														<span> Job Post Successfully!! </span>
													</div>
												</div>
											</div>
											@if (session('message'))
											<div class="row">
												<div class="col-md-12">
													<div class="alert alert-success success-alert myalert">
														<span> {{ session('message') }} </span>
													</div>
												</div>
											</div>				
											@endif										
									 <div class="project-section"> 
										<ul class="drama searchjobs">
										<?php if(!empty($jobPost)) { ?>
										@foreach($jobPost as $val)

											<li>
											
											
										<div class="actress box">
											<a href="viewJob/{{$val->id}}" >
												<div class="details">
													<div class="e-mail-actress" style="width:90%;"><?php if($val->image){?><span><img src="{{ URL::asset('jobpostimage/')}}/{{$val->image}}" class="img-thumbnail"  width="100" height="100" /></span><?php }else{ ?><span><img src="<?php echo asset('front-end/images/logo2.png')?>"/></img></span> <?php } ?><div class="details-text-box"><p><b> {{$val->job_title}}</b><br>Job Location : {{$val->job_location}}<br>Job Cat : {{$val->job_cat}}<br>{{$val->job_description}}</p>
													</div>
													
													</div>
												</div>
											</a>
											<!-- <div class="row">
												<div class="col-md-3 col-md-offset-1">
													<input type="hidden" id="job_id" value="{{$val->id}}">
													<a class="share_job" style="cursor: pointer">Share this job</a>
												</div>
											</div> -->
											<ul class="icon-text">
												<li class="like" style="padding: 0px;float: right;width: auto;margin-left: 25px;">
													<input type="hidden" id="job_id" value="{{$val->id}}">

													<a class="share_job" style="cursor: pointer"><i class="fa fa-share-alt"></i> Share this job</a>
												</li>
												<li class="comments" style="padding: 0px;float: right;width: auto;">
													<a style="float: left;width: auto;" href="javascript:;" alt="87" id="comments"><i class="fa fa-comments"></i> Comments</a>
													<p style="float: left;" alt="{{$val->id}}" id="{{$val->id}}_comment_counter">
														<?php 
															$counter = 0; 
															foreach($job_comments as $index=> $comment){
																if($comment->jobpost_id == $val->id){
																	$counter++;
																}
															}
															echo '('.$counter.')'; 
														?>
													</p>
													<input id="87_comment" value="1" type="hidden">
												</li>
											</ul>
											<div class="say-something-section">
												<div class="say-something-icon">
													@if($users->profile_pic!="")
														<img src="{{ URL::asset('profilepics')}}/<?php echo $users->profile_pic ; ?>" style="width:100%;"  />
													@else
														<img src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" style="width:100%;"  />
													@endif	
												</div>
												<div class="say-something-text">
													<?php 
														$counter = 0; 
														foreach($job_comments as $index=> $comment){
															if($comment->jobpost_id == $val->id){
																$counter++;
															}
														}
														 
													?>
													<input type="hidden" id="counter" value="<?php echo $counter; ?>"> 
													@if($users->profile_pic!="")
														<input type="hidden" class="pro_img" value="{{ URL::asset('profilepics')}}/<?php echo $users->profile_pic ; ?>">
													@else
														<input type="hidden" class="pro_img" value="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}">
													@endif
													<input type="hidden" value="{{$val->id}}" id="job_id_value" class="job_id_value">										
													<input class="" type="text" id="job-comments" placeholder="Comment on Prodcnox.....">
													<?php if($users->company_name == "" ) { ?>
														<input type="hidden" value="<?php echo $users->first_name.' '.$users->last_name; ?>" id="user_name" />	
														<?php } else { ?>
														<input type="hidden" value="<?php echo $users->company_name; ?>" id="user_name" />															
													<?php }	 ?>	
												</div>
												<div class="blog-comments">
													<ul class="all-comments">
														@foreach($job_comments as $comment)
															@if($comment->jobpost_id == $val->id)
															<li>
																<div class="user-icon-who-commented">
																	<?php
																		$pic = App\User::where('id',$comment->user_id)->pluck('profile_pic')
																	?>
																	<?php if($pic != "") { ?>
																			<img src="{{ URL::asset('profilepics')}}/<?php echo $pic; ?>" style="width:100%;"  />
																	<?php } else { ?>
																			<img src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" style="width:100%;"  />
																	<?php } ?>
																	
																</div>
																<div class="user-comment">
																	<h5>
							<?php $username = 	App\User::where('id',$comment->user_id)->pluck('username'); ?> 								
																		<a href="user/{{$username}}">
																			{{ App\User::where('id',$comment->user_id)->pluck('first_name') }} {{ App\User::where('id',$comment->user_id)->pluck('last_name') }}
																		</a> 
																		<p><?php echo time_ago($comment->created_at);?></p>
																	</h5>
																	<p>{{ $comment->comment }}</p>
																</div>	
															</li>
															@endif
														@endforeach	
													</ul>
												</div>
											</div>
										</div>
												</li>
											
											@endforeach	
										<?php } else { ?>

											<li>No Job Found</li>
										<?php } ?>		
										</ul>	
										</div>
										 
									</div>	
								</div>	
						</div>
						
					</div> <!-- row -->
				      <div class="rightsidebar">
					  <div class="fixed fixed-two"><div class="col-lg-2 col-md-2 side-bar-settings static rightsidebar common-rightbar">
@include('common.header-menu')
</div>
					</div>
					  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
      </div>
      
    </div>
  </div>
					</div>
				</div> <!-- profile-part -->
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
	<script>
		$("#search-here").keyup(function(e){ 
			var code = e.which; // recommended to use e.which, it's normalized across browsers
			if(code==13){
					var search = $('#search-here').val();	
					var token = document.getElementById('token').value;								
						var route = "searchJobs";
						$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'html',
							data: {
								data: search
							},
							success: function(data) {
								$('.searchjobs').empty();
								$('.searchjobs').html(data);
								},
							error: function(data) {
								alert("Fail");
								//$('#'+item).remove();
							},
						});				
			}else{
				var search = $('#search-here').val();	
					var token = document.getElementById('token').value;								
						var route = "searchJobs";
						$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'html',
							data: {
								data: search
							},
							success: function(data) {
								$('.searchjobs').empty();
								$('.searchjobs').html(data);
								},
							error: function(data) {
								alert("Fail");
								//$('#'+item).remove();
							},
						});						

			}
			
		});		
		
		$(".fliter-category").change(function(){
			search = $(this).val();
			var token = document.getElementById('token').value;								
			var route = "searchJobsByCat";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: search
				},
				success: function(data) {
					$('.searchjobs').empty();
					$('.searchjobs').html(data);
					},
				error: function(data) {
					alert("Fail");
					//$('#'+item).remove();
				},
			});
		});		
		

	</script>	
	<script>
		$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
		    $(".success-alert").slideUp(500);
		});

		$('.share_job').click(function(){
			var job_id = $(this).parent().find('#job_id').val();
			var token = document.getElementById('token').value;					

			var route = "shareJobById";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: job_id
				},
				success: function(data) {
					//$('.searchjobs').empty();
					//$('.searchjobs').html(data);
					//console.log(data);
					$("html, body").animate({ scrollTop: "100px" },1000);
					$('.joblistingstatus').css('display','block');
				}
			});
		});


		$(document).on('keypress',".say-something-text #job-comments",function(e) {
			 var comment = $(this).val();
			 
			 var pro_img = $(this).parent().find(".pro_img").val();
			 var post_id = $(this).parent().find("#job_id_value").val();
			 var counter = $(this).parent().find("#counter").val();

			 

	        var keynum;
			if(window.event) { // IE                    
			  keynum = e.keyCode;
			} else if(e.which){ // Netscape/Firefox/Opera                   
			  keynum = e.which;
			}
			if(keynum == 13){
				$(this).val('');
				if(comment!=""){
					postComments(comment,post_id,counter);
					
					//$(this).parent().siblings().find('ul').append('<li><h5><a href="#">'+$("#user_name").val()+'</a> <p>0 min ago</p></h5><p>'+comment+'</p></li>');

					counter = parseInt(counter)+1;
					
					$('#'+post_id+'_comment_counter').text("("+counter+")" );	

					$(this).parent().siblings().find('ul').append('<li><div class="user-icon-who-commented"><img src="'+pro_img+'" style="width:100%;"></div><div class="user-comment"><h5><a href="#">'+$("#user_name").val()+'</a><p>0 min ago</p></h5><p>'+comment+'</p></div></li>');


				}
			}
	    });

	    function postComments(comment,post_id,counter){
			var token = document.getElementById('token').value;					
			
			var route = "jobpostComment";
				$.ajax({
					url: route,
					headers: {
						'X-CSRF-TOKEN': token
					},
					type: 'POST',
					dataType: 'json',
					data: {
						comment: comment,
						post_id : post_id 
					},
					success: function(data) { 
						/*counter = parseInt(counter)+1;
						alert('here'+counter);
						$('#'+post_id+'_comment_counter').text("("+counter+")" );	*/					
					}
				});
		}

	</script>
  </body>
  </html>