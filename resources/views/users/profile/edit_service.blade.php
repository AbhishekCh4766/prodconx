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
											<h3>Edit Service</h3>
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
											<form class="form-horizontal edit-service" method="POST" action="{{URL::to('updateService')}}" enctype="multipart/form-data">
											@if(Session::get('education-message') != '')
											  <div class="form-group">
												<div class="alert alert-success all-success">
													{{Session::get('education-message')}}
												</div>
											  </div>
											@endif
											  <div class="form-group">
											    <label for="exampleInputEmail1">Title</label>
											    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Title" name="title" value="{{$service->title}}">
											  </div>
											  <div class="form-group">
											    <label for="desc">Description</label>
											    <textarea class="form-control" rows="3" name="desc" placeholder="Enter Service Description...">{{ $service->description }}</textarea>
											  </div>
											  <div class="form-group">
											  	<div class="row">
											  		<div class="col-md-8">
											  			<label for="exampleInputEmail1">Upload Service Image</label>
														<input class="browse-button" id="imgInp" type="file" accept="image/png, image/jpeg, image/gif" name="image"/>
											  		</div>
											  		<div class="col-md-4 image-preview">
											  			<img id="preview" src="{{URL::to('/servivespics/',$service->image_src)}}" alt="{{$service->title}}" class="img-responsive">
											  		</div>
											  	</div>
											  	
											  </div>
											  <input type="hidden" name="service_id" value="{{ $service->id }}">
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
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	$("#imgInp").change(function(){
        readURL(this);
    });
</script>
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/edit-service.min.js')}}" type="text/javascript"></script>
</body>
</html>