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
							

							<div class="col-lg-8 col-xs-8 col-sm-8 friends-common-class">
								<div class="row">
									<div class="right-side">
									
									<div class="row personal-info">
										<div class="project-name">
											<h3>My Friends</h3>
											<p>Search and Add Friends</p>
										</div>
										
											<div class="add-friend-section">
												<form action="{{URL::to('searchResult')}}" method="POST" name="search">
													 <div class="row project-section-name">
														<div class="col-lg-8 col-sm-8 col-xs-12 input-box">
															<div class="input-group">
																  <input type="hidden" name="_token" value="{{ csrf_token() }}">	
																  <input type="text" class="form-control" name="search" placeholder="Search for people..." value="{{Request::old('search')}}">
																  <span class="input-group-btn" >
																	<button class="btn btn-default" type="submit" >Add Friend !</button>
																  </span>
															</div>
														</div>
													</div>
												</form>	
												<ul>@forelse($searchs as $search)
													<li>
														<div class="row">
															<div class="col-md-12 myfriendslist">
																<div class="friends-image">	
																@if($search->profile_pic!="")
																	<img class="img-responsive img-thumbnail" src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
																@else
																	 <img class="img-responsive img-thumbnail" src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
																@endif </div>
																<div class="friends-name">
																			<h3><a href="user/{{$search->username}}">{{ $search->first_name}} {{ $search->last_name}}</a></h3>
																			<p style="margin-left: 10px;">{{$search->job_title}}</p>
																		</div>
																<div id="friend_id" >
																	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	

																	
																	<a class="mysearchbtn btn btn-default" alt="{{ $search->id}}" id="friend_{{ $search->id}}"  href="javascript:;">
																	<i class="icon-plus font-green-meadow">Send Request </i>	
																	</a>
																	<i id="friend_request_{{ $search->id}}"></i>

																</div>
															</div>
														</div>
													</li>
													@empty
													<div class="row">
														<div class="col-md-12">
															<!-- <div class="alert alert-danger">
															  <strong>No Friends Found!!</strong>
															</div>
 -->														</div>
													</div>
													
													@endforelse			
												</ul>
											</div>

										
										
											<div class="friends-listing">
											
												<div class="friends-list-tabs">
													<ul class="nav nav-tabs">
														<li class="active"><a data-toggle="tab" href="#home">My Friends</a></li>
														<li><a data-toggle="tab" href="#menu2">Pending Request</a></li>
													</ul>

													<div class="tab-content">											
														<div id="home" class="tab-pane fade active in">
															<div class="friends-list">
															
																<ul>@forelse($sendrequest as $search)
																	<li>
																		<div class="friends-image">
																		@if($search->profile_pic!="")
																			<img class="img-thumbnail" src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
																		@else
																			 <img class="img-thumbnail" src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
																		@endif </div>
																		<div class="friends-name-box-main">
																		<div class="friends-name">
																			<h3><a href="user/{{$search->username}}">{{ $search->first_name}} {{ $search->last_name}}</a></h3>
																			<p style="margin-left: 10px;">{{$search->job_title}}</p>
																		</div>
																		
																		<div class="send-msg-div"><a href="{{URL::to('friends')}}/{{ $search->id}}"><div id="send_msg">Send Message</div></a></div>
																		<div id="friend_pending_id" >
																			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
																			<a alt="{{ $search->id}}" id="friend_{{ $search->id}}"  href="javascript:;">
																			<!--<i class="icon-plus font-green-meadow">Send Request</i>	-->
																			</a>
																			<i id="friend_request_{{ $search->id}}"></i>
																		</div>
																		</div>
																	</li>
																	@empty
																		<li>No Friend Found!!</li>
																	@endforelse			
																</ul>
															</div>	
														</div>
														
														<div id="menu2" class="tab-pane fade in ">
															<div class="friends-list">
																<?php if(!empty($pendingrequest)) { ?>	
																<ul>@foreach($pendingrequest as $search)
																	<li>
																		<div class="friends-image">
																		@if($search->profile_pic!="")
																			<img class="img-responsive img-thumbnail" src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
																		@else
																			 <img class="img-responsive img-thumbnail" src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
																		@endif </div>
																		<div class="friends-name">
																			<h3><a href="javascript:;">{{ $search->first_name}} {{ $search->last_name}}</a></h3>
																			<p style="margin-left: 10px;">{{$search->job_title}}</p>
																		</div>
																		<div id="friend_pending_id" >
																			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
																			<a alt="{{ $search->id}}" id="friend_{{ $search->id}}"  href="javascript:;">
																			<i class="icon-plus font-green-meadow">Confirm</i>	
																			</a>
																			<i id="friend_request_{{ $search->id}}"></i>
																		</div>
																	</li>
																	@endforeach		
																<?php } else { ?>	

																	<li>No Pending Friend Request</li>
																	
																<?php } ?>	
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
							<div class="rightsidebar">
								<div class="fixed fixed-two">@include('common.header-menu')</div>
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
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<script>
$('#friend_id a').click(function(){var data=$(this).attr("alt");var element='#friend_request_'+data;var element1='#friend_'+data;var token=document.getElementById('token').value;var route="genre";$.ajax({url:route,headers:{'X-CSRF-TOKEN':token},type:'POST',dataType:'json',data:{data:data},success:function(data){$(element).addClass("icon-check font-green");$(element1).css("display","none");},error:function(data){$(element).html("Fail");},});});
</script>
<script>
$('#friend_pending_id a').click(function() {
    var data = $(this).attr("alt");
    var element = '#friend_request_' + data;
    var element1 = '#friend_' + data;
    var token = document.getElementById('token').value;
    var route = "pending";
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
            $(element).addClass("icon-check font-green");
            $(element1).css("display", "none");
        },
        error: function(data) {
            $(element).html("Fail");
        },
    });
});
</script>
  </body>
  </html>