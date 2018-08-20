@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <body>
    	<style>
  		a#like , .post-like{
  			color: #7f7f7f;
  		}
  		.comments a , .comments p{
  			color: #777;
  		}
  	</style>
<?php
	
	define( 'TIMEBEFORE_NOW',         'Just now' );
    define( 'TIMEBEFORE_MINUTE',      '{num} minute ago' );
    define( 'TIMEBEFORE_MINUTES',     '{num} minutes ago' );
    define( 'TIMEBEFORE_HOUR',        '{num} hour ago' );
    define( 'TIMEBEFORE_HOURS',       '{num} hours ago' );
    define( 'TIMEBEFORE_YESTERDAY',   'yesterday' );
    define( 'TIMEBEFORE_FORMAT',      '%b %e, %Y' );
    define( 'TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y' );

    function time_ago( $time )
    {
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
						
						
						<div class="col-lg-8 col-xs-8 col-sm-8 post-page-center">
							<div class="row">
								<div class="right-side">
											<div class="whats-on-your-mind-icon">
											<div id="share_update">
											<div class="right-side-fa-icon share_update">
										 			<i class="fa fa-share" aria-hidden="true"></i>
										 		</div> <p>Share an Update</p></div>
											<div id="file-upload">
										 		<div class="right-side-fa-icon">
										 			<i class="fa fa-camera" aria-hidden="true"></i>
										 		</div> <p>Upload a photo</p>
										 		<span id="select_file"></span>
										 	</div>
										</div>
									<div class="whats-on-your-mind">
									
										<div class="whats-on-your-mind-text">
											<form class="textarea-home-frm" action="{{URL::to('post')}}" name="" method="POST" enctype="multipart/form-data">	
												<!--<input class="" type="text" name="post" placeholder="Post on Prodcnox.....">-->
												<textarea class="textarea-home" type="text" name="post" placeholder="What's on your mind?" required=""></textarea>
												<input type="hidden" value="{{ csrf_token() }}"  name="_token" />
												<div class="input-div">
												<div class="image-div"> 
													<!-- <p id="file-upload"  ><img title="Add Image" src="{{ URL::asset('/front-end/images/pic-uploaded.png')}}" class="upload-file" alt="Add image" /></p> -->
													<span id="select_file"></span>
													
												</div>
												
												<input type="text" name="video_url" id="video_url" class="video_url" style="display:none" placeholder="Please enter youtube/vimeo URL here..." />
												
												<input type="radio" name="post_type_radio" id="image_post_type" value="image" checked style="visibility:hidden;" >
												<input type="radio" name="post_type_radio" id="video_post_type" value="video" style="visibility:hidden;" > 	
												
												<input type="file" id="image" name="image" class="image" style="display:none" />
												</div>
												<div class="form-submit-home">   <input type="submit" value="Post" /></div>
													
												

											</form>
										</div>
									</div>
									

									 <div class="post-section" id="post-append" >
							
									
									
										<ul>
										<?php //echo'<pre>'; print_r($posts); die;
										if(!empty($posts)) { ?>
										@foreach($posts as $post)
											<li>
												<div class="posts-left-section">
													<div class="image-icon">
														<?php if($post->profile_pic !="" ) {?>
														<img src="{{ URL::asset('/profilepics')}}/{{ $post->profile_pic }} " />
														<?php }else { ?>
														<img src="{{ URL::asset('front-end/images/man-icon.png')}}"  >
														<?php } ?>
													</div>
												</div>
												<div class="posts-right-section">
													<div class="icon-name">
														<div class="blog-name-time">
															
															<?php if($post->company_name == "" ) { ?> 
															<a href="user/{{$post->username}}"><p class="blog-name">{{ $post->first_name }}&nbsp;{{ $post->last_name }}</p></a>
															<?php } else { ?>
															<a href="user/{{$post->username}}"><p class="blog-name">{{ $post->company_name }}</p></a>														
															
															<?php } ?>
															
															
															<p class="time-ago"><?php echo time_ago($post->created_at); 
																
															?> </p>
														</div>
													</div>
													<div class="blog-image-text">
														<p>{{$post->post_text}}</p>
														<?php if($post->post_type == 'jobpost'){ ?>
															<div class="post-div-img">
																<img src="{{ URL::asset('jobpostimage')}}/<?php echo $post->updated_at[0]->media; ?>">
															</div>
														<?php } ?>
														<?php if($post->post_type == 'image'){ ?>
														<?php if(!empty($post->updated_at)) { ?>
															<div class="post-div-img">
																<img src="{{ URL::asset('postpics')}}/<?php echo $post->updated_at[0]->media; ?>">
															</div>
														<?php } }?>
														<?php if($post->post_type == 'video') {
														
														if($post->updated_at[0]->type=='youtube')
														
														{ ?>
														
														
														<iframe width="730" height="405" src="https://www.youtube.com/embed/<?php echo $post->updated_at[0]->media;?>" frameborder="0" allowfullscreen></iframe>
														
														<?php }elseif($post->updated_at[0]->type=='vimeo') { ?>

														<iframe src="https://player.vimeo.com/video/<?php echo $post->updated_at[0]->media;?>" width="730" height="405" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>													
														
														
														<?php
                                         					
														 }} 
														 ?>

														 <ul class="icon-text">
													             
																
                                                               <?php 
                                                  $user_id = Session::get('user_id');
                                  $data = DB::table('tbl_posts_likes')
								->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts_likes.user_id' )							
								->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.username','tbl_users.email','tbl_users.profile_pic','tbl_posts_likes.post_id')					
								->where('tbl_posts_likes.user_id', $user_id)			
								->get();
                                                               ?>

                                                                 
															<li class="like"  > 
                                            
																<a href="javascript:;" alt="{{$post->id}}" id="like"  ><i class="fa fa-thumbs-up" ></i>
														           Like  
														       	</a> 
																<p alt="{{$post->id}}" class="btn btn-info btn-lg post-like" data-toggle="modal" data-target="#myModal" id="{{$post->id}}_counter"  >({{$post->like_counter}})</p>
																<input type="hidden" id="{{$post->id}}_like" value="{{$post->like_counter}}" />
															</li>

															        
                                                                          
															
															    
															<li class="comments">
																<a href="javascript:;" alt="{{$post->id}}" id="comments" ><i class="fa fa-comment" aria-hidden="true"></i>Comments</a>
																<p alt="{{$post->id}}" id="{{$post->id}}_comment_counter" >({{$post->total_comments}})</p>
																<input type="hidden" id="{{$post->id}}_comment" value="{{$post->total_comments}}" />

																

																
															</li>
															
															
														</ul>
													</div>
													
												</div>
												<div class="say-something-section">
														<div class="say-something-icon">
															@if($users->profile_pic!="")
																<img src="{{ URL::asset('profilepics')}}/<?php echo $users->profile_pic ; ?>" style="width:100%;"  />
															@else
																<img src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" style="width:100%;"  />
															@endif	
														</div>
														<div class="say-something-text">
															<input type="hidden" value="{{$post->id}}" id="comment_id" name="post_id_val" /> 													
															<input class="" type="text" id="post-comments" placeholder="Comment on Prodcnox.....">
															
															<?php if($users->company_name == "" ) { ?>
															<input type="hidden" value="<?php echo $users->first_name.' '.$users->last_name; ?>" id="user_name" />	
															<?php } else { ?>
															<input type="hidden" value="<?php echo $users->company_name; ?>" id="user_name" />															
															<?php }	 ?>	
														</div>
														<div class="blog-comments">
															<ul class="all-comments">
																														
																<?php for($i=0;$i<count($post->ip);$i++){ ?>
																<li>
																	<div class="user-icon-who-commented">
																		<?php if($post->ip[$i]->img!="") { ?>
																				<img src="{{ URL::asset('profilepics')}}/<?php echo $post->ip[$i]->img; ?>" style="width:100%;"  />
																		<?php } else { ?>
																				<img src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" style="width:100%;"  />
																		<?php } ?>
																	</div>
																	<div class="user-comment">
																		<h5><a href="{{ url ('user') }}/<?php echo $post->ip[$i]->username; ?>"><?php if($post->ip[$i]->company_name == "" ) echo $post->ip[$i]->first_name.' '.$post->ip[$i]->last_name;
																		
																		else
																			
																			echo $post->ip[$i]->company_name;
																		
																		?></a> <p><?php echo time_ago($post->ip[$i]->comment_date); ?></p></h5>
																		<p><?php echo $post->ip[$i]->comment;?> </p>
																	</div>	
																</li>
																<?php } ?>
															</ul>
														</div>
													</div>
											</li>
											<?php 
											$lastID = $post->id;
											?>
								
											@endforeach
										<?php } else { ?>
											<div class="alert alert-danger combine-alert">
											  <strong>No Post Available!!</strong>
											</div>
											
										<?php } ?>	
										</ul>
									<input type="hidden" name="lastID" id="lastID" value="<?php  if(isset($lastID)){ echo $lastID; } ?>" />
									<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">										
									</div>

								</div>	
							</div>	
						</div>
						
						<div class="rightsidebar">
							<div class="fixed fixed-two">
							
								@include('common.header-menu')
								
								<div class="col-lg-2 col-md-2 Add_frnd_box-main" style="">
									<h4> People you may know</h4>
									 <?php 
								

										$user_id = Session::get('user_id');
										$data = DB::table('tbl_friend_requests')
										->join('tbl_users', 'tbl_users.id' , '=',  'tbl_friend_requests.friend_id' )							
										->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.username','tbl_users.email','tbl_users.profile_pic')				
										->where('tbl_friend_requests.status', '0')	
										->where('tbl_friend_requests.user_id', $user_id)			
										->get();	

										if(!EMPTY($data)){

									 for($i=0; $i<=3;$i++)
									 {
										$id = $data[$i]->id;
										//echo $id; echo ' ';
										//echo($data[$i]->first_name); echo ' ';
										//echo($data[$i]->last_name);  echo ' '; 
										  ?> 
										  <div class="Add_frnd_box">
											<div class="profile_pic_front">
												@if($data[$i]->profile_pic == '')
												<img src="{{ URL::asset('/assets/logo/images.jpeg')}}">
								  
												@else
															<img src="{{ URL::asset('profilepics')}}/{{ $data[$i]->profile_pic }}" >
												 @endif
											</div>
											<div class="profile_name_front">
										  <h5><a href="user/{{$data[$i]->username}}">{{ $data[$i]->first_name}} {{ $data[$i]->last_name}}</a></h5>
										
											<div id="friend_id" >
											<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	


											<a class="mysearchbtn btn btn-default" alt="{{ $id}}" id="{{ $id}}"  href="javascript:;">
											<i class="icon-plus font-green-meadow">Add Friend </i>	
											</a>
											<i id="{{$id}}"></i>

											</div>
											</div>
											</div>
									 <?php
										
									 }
									}
										
												 ?> 

												 <br>
												 <?php ?>
										
												   
								</div>
							</div>
						 </div>

						</div>
						</div>
						
					</div> <!-- row -->
					
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
$('#friend_id a').click(function(){var data=$(this).attr("alt");var element='#friend_request_'+data;var element1='#friend_'+data;var token=document.getElementById('token').value;var route="genre";$.ajax({url:route,headers:{'X-CSRF-TOKEN':token},type:'POST',dataType:'json',data:{data:data},success:function(data){$(element).addClass("icon-check font-green");$(element1).css("display","none");},error:function(data){$(element).html("Fail");},});});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	-->
		<script type="text/javascript">
$(document).ready(function(){
	
    $("#file-upload").click(function(){
        $('#image').trigger('click'); 
		$(".image-div").addClass('active');	
		$(".video-div").removeClass('active');			
		$("#image_post_type").prop("checked", true);
		$("#video_post_type").prop("checked", false);
		$('#video_url').val();	
		$('#video_url').css('display','none');
		$('#select_file').css('display','block');
		
    });
	
	$('.video_file').click(function(){
		$("#video_url").toggle('slow');
		$(".video-div").addClass('active');	
		$(".image-div").removeClass('active');		
		$("#image_post_type").prop("checked", false);
		$("#video_post_type").prop("checked", true);	
		$('#select_file').css('display','none');		
	});	
	
	
	$(window).scroll(function(){
		var lastID = $('#lastID').val();

		var token = document.getElementById('token').value;		
		
		if ($(window).scrollTop() == $(document).height() - $(window).height() && lastID != 0){
			
			
			var route = "postData";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: lastID
				},
				success: function(data) {
					$('#lastID').remove();
					$('#post-append').append(data);
				},
				error: function(data) {
				},
			});
			
		}
	});
	
	
	$(document).on("click", '#like', function() {
		var id = $(this).attr("alt");
		var counter = $('#'+id+'_like').val();
		var token = document.getElementById('token').value;		
		var route = "postLike";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				data: {
					data: id
				},
				success: function(response) {
					
					if(response == 'already'){
						//$('#myModal').modal('show');

						//alert("You have Already Liked this POST. Thank you");

					}else{
						counter = parseInt(counter)+1;
						$('#'+id+'_counter').text("("+counter+")" );
					}
				},
				error: function(response) {
				},
			});
	});

	$(document).on("click", '#comments', function() {
		var id = $(this).attr("alt");
		var token = document.getElementById('token').value;	

		
		var route = "postComment";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				data: {
					data: id
				},
				success: function(data) {
				
				},
				error: function(data) {
				},
			});
	});
	
	$(document).on("click", '.post-like', function() {
		var id = $(this).attr("alt");
		var token = document.getElementById('token').value;		
		var route = "allLikePost";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: id
				},
				success: function(data) {
					$('.modal-content').html(data)
				},
				error: function(data) {
				},
			});
	});	
	
	
});



	$(document).on('keypress',".say-something-text #post-comments",function(e) {
		 var comment = $(this).val();
		 
		 var post_id = $(this).closest('.say-something-text').find("input[name='post_id_val']").val();

        var keynum;
		if(window.event) { // IE                    
		  keynum = e.keyCode;
		} else if(e.which){ // Netscape/Firefox/Opera                   
		  keynum = e.which;
		}
		if(keynum == 13){
			$(this).val('');
			if(comment!=""){
			postComments(comment,post_id);
			
			$(this).parent().siblings().find('ul').append('<li><h5><a href="#">'+$("#user_name").val()+'</a> <p>0 min ago</p></h5><p>'+comment+'</p></li>');
		}
		}
    });
	
	
	function postComments(comment,post_id){
		var token = document.getElementById('token').value;				
		var counter = $('#'+post_id+'_comment').val();	
		
		var route = "postComment";
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
					counter = parseInt(counter)+1;
					$('#'+post_id+'_comment_counter').text("("+counter+")" );						
				},
				error: function(data) {					
					counter = parseInt(counter)+1;
					$('#'+post_id+'_comment_counter').text("("+counter+")" );	
					$('#'+post_id+'_comment').val(counter);	
				},
			});
	}

	$("#image").change(function() {
		var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
		$('#select_file').html(filename);
	});
	
	$(document).on('click','.like a',function(){
		//$(".like a").click(function(){
         $(this).css('color', '#337ab7', 'important');
	});
	
</script>	
  </body>
  </html>