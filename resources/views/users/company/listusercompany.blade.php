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

			<div class="mid-page">
			<div class="container">
				<div class="profile-part">
					<div class="row">
							
						<div class="row_inr_box"> 
							<div class="post-page-right-section_bx">
						@include('common.innerleft-menu')
							<div class="common-right-section">
								<div class="rightsidebar">
@include('common.header-menu')
</div>
								
								<?php if($users->facebook_link !="" || $users->twitter_link !="") { ?>	
							<div class="row individual-group-section">
								<div class="col-lg-12 col-xs-12 col-sm-12 groups">
									<div class="friends-section">
										<p class="profile-setting">	Social Links</p>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12 col-sm-12 group-background">
									<?php if($users->facebook_link !="" ) { ?>
									<div class="group-hand">
										  <img src="{{ URL::asset('front-end/images/9.png')}}">
										<span class="profile-setting"><a href="<?php echo $users->facebook_link; ?>" target="_blank" > Facebook </a></span>
									</div>
									
									<?php }	if($users->twitter_link !="" ) { ?>
								
										<div class="yellow-bag">
											<img src="{{ URL::asset('front-end/images/10.png')}}">
											<span class="profile-setting"><a href="<?php echo $users->twitter_link; ?>" target="_blank" > Twitter </a></span>
										</div>
									<?php } ?>	
								</div>
							</div>	
							<?php }	?>
								
							</div>
							</div>
						<div class="col-lg-9 col-xs-9 col-sm-9 rental-common-class job-posting-common-class company-followers-page">
								<div class="row">
									<div class="right-side">
									<div class="rightsidebar">
@include('common.header-menu')
</div>
										<div class="friends-listing">
										
											<div class="friends-list-tabs">

												<div class="tab-content">
													<h3>Followers</h3>							
													<div id="home" class="tab-pane1 fade in ">
														<div class="friends-list">
														
															<ul>@forelse($followCompany as $search)
																<li>
																	<div class="friends-image">												@if($search->profile_pic!="")
																		<img class="img-responsive img-thumbnail" src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
																	@else
																		 <img src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
																	@endif </div>
																	<div class="friends-name">
																		<h3><a href="{{ url ('user') }}/<?php echo $search->username; ?>">
																		<?php if( $search->company_name == "" ) { ?>
																		{{ $search->first_name}} {{ $search->last_name}}
																		
																		<?php } else { ?>
																		
																		{{ $search->company_name}}
																		<?php } ?>
																		</a></h3>
																	</div>
																	<div id="friend_pending_id" >
																		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
																	</div>
																	
																</li>
																@empty
																<div class="alert alert-success myalert">
																  <strong>No Followers Found!!</strong>
																</div>
																@endforelse			
															</ul>
														</div>	
													</div>
													
													
												</div>
											</div>	
										</div>
										
									</div>	
								</div>	
							</div>
						
						</div>
					</div> <!-- row -->
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
				
			</div> <!--  mid-page  -->

		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<script>
$('#friend_id a').click(function(){var data=$(this).attr("alt");var element='#friend_request_'+data;var element1='#friend_'+data;var token=document.getElementById('token').value;var route="companyfollow";$.ajax({url:route,headers:{'X-CSRF-TOKEN':token},type:'POST',dataType:'json',data:{data:data},success:function(data){$(element).addClass("icon-check font-green");$(element1).css("display","none");},error:function(data){$(element).html("Fail");},});});
</script>
<script>
$('#friend_pending_id a').click(function() {
    var data = $(this).attr("alt");
    var token = document.getElementById('token').value;
    var route = "unfollowCompany";
	$(this).css("display", "none");
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: {
            data: data
        },
        success: function(data) {
            
        },
        error: function(data) {
            $(element).html("Fail");
        },
    });
});
</script>

  </body>
  </html>