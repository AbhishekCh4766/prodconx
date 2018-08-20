@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	.nopaddingright{
  		padding-right: 0px;
  	}
  </style>
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
							</div> <!-- row -->
					  		
							<div class="col-lg-9 col-xs-9 col-sm-9 rental-common-class">
								<div class="row">
									<div class="right-side">
										<div class="row personal-info">
											@if (session('message'))
												<div class="alert alert-success">
													<span> {{ session('message') }} </span>
												</div>					
											@endif											
											<h3>Add Service</h3>
										</div>
										@if (count($errors) > 0)
										    <div class="alert alert-danger">
										        <ul>
										            @foreach ($errors->all() as $error)
										                <li>{{ $error }}</li>
										            @endforeach
										        </ul>
										    </div>
										@endif
										<div class="row personal-info" style="margin-top:2px;">
											<form class="form-horizontal service-form" method="POST" action="{{URL::to('addService')}}" enctype="multipart/form-data">
											@if(Session::get('education-message') != '')
											  <div class="form-group">
												<div class="alert alert-success all-success">
													{{Session::get('education-message')}}
												</div>
											  </div>
											@endif
											  <div class="form-group">
											    <label for="exampleInputEmail1">Title</label>
											    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Title" name="title">
											  </div>
											  <div class="form-group">
											    <label for="desc">Description</label>
											    <textarea class="form-control" rows="3" name="desc" id="desc" placeholder="Enter Service Description..."></textarea>
											  </div>
											  <div class="form-group">
											  	<label for="image">Upload Service Image</label>
												<input class="browse-button" id="image" type="file" accept="image/png, image/jpeg, image/gif" name="image"/>
											  </div>
											  <input type="hidden" name="uid" value="{{Session::get('user_id')}}">
											  <input type="hidden" name="_token" value="{{csrf_token()}}" />
											  <a href="{{URL::to('profile')}}" class="btn btn-default pull-left">Back</a>
											  <button type="submit" class="btn btn-default pull-right">Save</button>
											</form>
										</div>
									</div> 
								</div>	
							</div>	
						</div>
					</div>
  				</div>
			</div> <!-- profile-part -->
		</div> <!--  mid-page  -->
	</div>
</div>
<script>
	$(".all-success").fadeTo(2000, 500).slideUp(500, function(){
	    $(".all-success").slideUp(500);
	});
</script>
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/services.min.js')}}" type="text/javascript"></script>
</body>
</html>