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
							
						
							
						<div class="col-lg-8 col-xs-8 col-sm-8 middle-section">
								<div class="row">
									<div class="right-side">
										<div class="row personal-info">
										
											<div class="friends-listing">
											
												<div class="friends-list-tabs">
													<ul class="nav nav-tabs">
														<li  class="active"><a data-toggle="tab" href="#menu1">Search Companies</a></li>
														<li><a data-toggle="tab" href="#home">Companies You Follow</a></li>

													</ul>

													<div class="tab-content">
													<div id="menu1" class="tab-pane fade in active">
															<div class="friends-list">
																<form action="{{URL::to('searchCompany')}}" method="POST" name="search">
																	 <div class="row project-section-name">
																		<div class="col-lg-12 col-sm-8 col-xs-12 input-box">
																			<div class="input-group">
																				  <input type="hidden" name="_token" value="{{ csrf_token() }}">	
																				  <input type="text" class="form-control" name="search" placeholder="Search for company..." value="{{Request::old('search')}}">
																				  <span class="input-group-btn" >
																					<button class="btn btn-default" type="submit" >Search</button>
																				  </span>
																			</div>
																		</div>
																	</div>
																</form>	
																<ul>@foreach($searchs as $search)
																	<li>
																		<div class="friends-image">
																		@if($search->profile_pic!="")
																			<img class="img-thumbnail company_thumb" src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
																		@else
																			 <img class="img-thumbnail company_thumb" src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
																		@endif </div>
																		<div class="friends-name">
																			<h3><a href="{{ url ('user') }}/<?php echo $search->username; ?>">										    <?php if( $search->company_name == "" ) { ?>
																			{{ $search->first_name}} {{ $search->last_name}}
																			
																			<?php } else { ?>
																			
																			{{ $search->company_name}}
																			<?php } ?>
																			
																			</a></h3>
																		</div>
																		<div id="friend_id" >
																			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	

																			@if (Request::segment(1)  === 'searchCompany') 
																			<a alt="{{ $search->id}}" id="friend_{{ $search->id}}"  href="javascript:;">
																				<!--<i class="icon-plus font-green-meadow">  Follow </i>-->
																				<button class="btn btn-default unfollowBtn">Follow</button>	
																			</a>
																			<i id="friend_request_{{ $search->id}}"></i>
																			@endif
																		</div>
																	</li>
																	@endforeach			
																</ul>
															</div>	
													</div>												
														<div id="home" class="tab-pane fade in ">
															<div class="friends-list">
															
																<ul>@forelse($followCompany as $search)
																	<li>
																		<div class="friends-image">
																		@if($search->profile_pic!="")
																			<img class="img-thumbnail company_thumb" src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
																		@else
																			 <img class="img-thumbnail company_thumb" src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
																		@endif </div>
																		<div class="friends-name">
																			<h3>
																				<a href="javascript:;">
																				@if($search->first_name != '')
																					{{ $search->first_name }} {{ $search->last_name}}
																				@elseif($search->company_name != '')
																					{{ $search->company_name }}
																				@endif
																				</a>
																			</h3>
																		</div>
																		<div class="row text-center">
																			<div class="col-md-12">
																				<div id="friend_pending_id" >
																					<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
																					<a alt="{{ $search->id}}" id="friend_{{ $search->id}}"  href="javascript:;">
																						<!--<i class="icon-plus font-green-meadow">Unfollow</i>-->
																						<button class="btn btn-default unfollowBtn">Unfollow</button>
																					</a>
																				</div>
																			</div>
																		</div>
																		
																		
																	</li>
																	@empty
																	<div class="row">
																		<div class="col-md-12">
																			<div class="alert alert-danger">
																			  <strong>No Data Found!!</strong>
																			</div>
																		</div>
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