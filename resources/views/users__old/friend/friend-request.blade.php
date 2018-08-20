<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
	
	<head>
	<meta name="_token" content="{!! csrf_token() !!}" />
	@include('includes.head')
	</head>
	<!-- HEAD END --->	
	<style>
		@media (min-width: 992px)
		.page-content-wrapper .page-content {
			margin-left: 0px !important; 
			margin-top: 0;
			min-height: 600px;
			padding: 25px 20px 10px;
		}
		
		.page-content-wrapper .page-content {
			margin-left: 0px !important; 
			background: #eef1f5;
		}
		.col-md-3 {
			margin-top: 20px;
		}
		
		.static-info.align-reverse .value {
			margin-top: 0px !important;
		}
		
	</style>	

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
	
        <div class="page-content-wrapper">
	
		<div class="page-content" style="margin-left:0px !important;">
		
					<div class="page-bar">
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> My Account
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="{{URL::to('userDashboard') }}">
                                            <i class="fa fa-home"></i>Home</a>
                                    </li>									
                                    <li>
                                        <a href="{{URL::to('getMyProfile') }}">
                                            <i class="icon-user"></i>My Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('userOrder') }}">
                                            <i class="fa fa-briefcase"></i>My Plan</a>
                                    </li>	
                                    <li>
                                        <a href="{{URL::to('request') }}">
                                            <i class="fa fa-search"></i>Seacrh</a>
                                    </li>	
                                    <li>
                                        <a href="{{URL::to('getFriend') }}">
                                            <i class="fa fa-odnoklassniki"></i>Friends</a>
                                    </li>									
                                    <li>
                                        <a href="{{URL::to('userLogout')}}">
                                            <i class="icon-key"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>				
		
		
                    <!-- BEGIN PAGE HEADER-->

                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Search Results
                        <!--<small>pricing table samples</small>-->
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="search-page search-content-3">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="search-filter ">
                                    <div class="search-label uppercase">Search By</div>
									<form action="{{URL::to('searchResult')}}" method="POST" name="search">
                                    <div class="input-icon right">
                                        <i class="icon-magnifier"></i>
										<input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                        <input type="text" class="form-control" name="search" placeholder="Search..."> </div>
                                    <button class="btn green bold uppercase btn-block">Search Results</button>
                                    <div class="search-filter-divider bg-grey-steel"></div>
									</form>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
								<?php if(isset($searchs)) { ?>
								@foreach($searchs as $search)
                                    <div class="col-md-4">
                                        <div class="tile-container">
                                            <div class="tile-thumbnail">
                                                <a href="javascript:;">
												@if($search->profile_pic!="")
                                                    <img src="{{ URL::asset('profilepics')}}/{{$search->profile_pic}}" />
												@else
													 <img src="{{ URL::asset('assets/pages/img/page_general_search/img.jpg')}}" />
												@endif 
                                                </a>
                                            </div>
                                            <div class="tile-title">
                                                <h3>
                                                    <a href="javascript:;">{{ $search->first_name}} {{ $search->last_name}}</a>
                                                </h3>

														<!--<a href="javascript:;">
															<i class="icon-check font-green"></i>
														</a>-->
														<div id="friend_id" >
															<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
															<a alt="{{ $search->id}}" id="friend_{{ $search->id}}"  href="javascript:;"><!--{{URL::to('friendRequest')}}/{{ $search->id}}"-->
															<i class="icon-plus font-green-meadow"></i>	
															</a>
															<i id="friend_request_{{ $search->id}}"></i>
														</div>
                                                <div class="tile-desc">
                                                    <p>Country:
                                                        <a href="javascript:;">{{ $search->name}}</a> 
                                                        <!--<span class="font-grey-salt">25 mins ago</span>-->
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								@endforeach	
								<?php } else { ?>
                                    <div class="col-md-4">
                                                <h3>
                                                   No search Data 
                                                </h3>
                                    </div>								
								<?php } ?>
								
								
								
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
			</div>			
				@include( 'includes.footer' )			
<script>
$('#friend_id a').click(function(){var data=$(this).attr("alt");var element='#friend_request_'+data;var element1='#friend_'+data;var token=document.getElementById('token').value;var route="genre";$.ajax({url:route,headers:{'X-CSRF-TOKEN':token},type:'POST',dataType:'json',data:{data:data},success:function(data){$(element).addClass("icon-check font-green");$(element1).css("display","none");},error:function(data){$(element).html("Fail");},});});
</script>				