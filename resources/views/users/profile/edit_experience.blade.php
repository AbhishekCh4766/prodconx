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
											<h3>Edit Experience</h3>
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
											<form class="form-horizontal experience-form" method="POST" action="{{URL::to('editExperience',$experience->id )}}">
											@if(Session::get('flash-message') != '')
											  <div class="form-group">
												<div class="alert alert-success all-success">
													{{Session::get('flash-message')}}
												</div>
											  </div>
											@endif
											  <div class="form-group">
											    <label for="exampleInputEmail1">Company Name</label>
											    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Company Name" name="company_name" value="{{ $experience->company_name }}" >

											  </div>
											  <div class="form-group">
											    <label for="location">Location</label>
											    <input type="text" class="form-control" id="location" placeholder="Location" name="location" value="{{ $experience->location }}">
											  </div>
											  <div class="form-group">
											    <label for="start_year">Start Year</label>
											    <input type="text" class="date-own form-control" id="start_year" placeholder="Start Year" name="start_year" value="{{ $experience->start_year }}">
											  </div>
											  <div class="form-group">
											    <label for="end_year">End Year</label>
											    <input type="text" class="date-own form-control" id="end_year" placeholder="End Year" name="end_year" value="{{ $experience->end_year }}"  >
											  </div>
											  
											  <div class="form-group">
											    <label for="job_status">Is current Job?</label>
											   	<select class="form-control" name="is_current" value="{{ old('job_status') }}">
												  <option value="" selected="selected">--Select--</option>
												  <option value="1" {{ $experience->is_current == '1' ? 'selected' : '' }} >Yes</option>
												  <option value="0" {{ $experience->is_current == '0' ? 'selected' : '' }} >NO</option>
												</select>
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
  <script type="text/javascript">

      $('.date-own').datepicker({

         minViewMode: 2,

         format: 'yyyy',
          endDate: "today"

       });

      

  </script>
      <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/experience.min.js')}}" type="text/javascript"></script>	
</body>
</html>