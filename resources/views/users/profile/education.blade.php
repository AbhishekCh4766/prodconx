@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
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
									
							</div> <!-- row -->
					  		
							<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class">
								<div class="row">
									<div class="right-side">
										<div class="row personal-info">
											@if (session('message'))
												<div class="alert alert-success">
													<span> {{ session('message') }} </span>
												</div>					
											@endif											
											<h3>Add Education</h3>
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
											<form class="form-horizontal education-form" method="POST" action="{{URL::to('addEducation')}}">
											@if(Session::get('education-message') != '')
											  <div class="form-group">
												<div class="alert alert-success all-success">
													{{Session::get('education-message')}}
												</div>
											  </div>
											@endif
											  <div class="form-group">
											    <label for="exampleInputEmail1">Degree</label>
											    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Degree" name="title">
											  </div>
											  <div class="form-group">
											    <label for="location">School</label>
											    <input type="text" class="form-control" id="location" placeholder="School" name="location">
											  </div>
											  <div class="form-group">
											    <label for="start_year">Start Year</label>
											    <input type="text" class="form-control date-own" id="start_year" placeholder="Start Year" name="start_year">
											  </div>
											  <div class="form-group">
											    <label for="end_year">End Year</label>
											    <input type="text" class="form-control date-own" id="end_year" placeholder="End Year" name="end_year">
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
							<div class="rightsidebar">
@include('common.header-menu')
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
<script type="text/javascript">

      $('.date-own').datepicker({

         minViewMode: 2,

         format: 'yyyy',
         endDate: 'today'

       });

  </script>
  <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/education.min.js')}}" type="text/javascript"></script>
</body>
</html>