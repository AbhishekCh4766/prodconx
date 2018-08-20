@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	.nopaddingright{
  		padding-right: 0px;
  	}
  	.addskills{
  		margin-bottom: 20px;
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
											<h3>Edit Skill</h3>
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
											<form class="form-horizontal skill-form" method="POST" action="{{URL::to('editSkill',$skill->id )}}">
											@if(Session::get('skills-message') != '')
											  <div class="form-group">
												<div class="alert alert-success all-success">
													{{Session::get('skills-message')}}
												</div>
											  </div>
											@endif
											  <div class="form-group">
											    <label for="exampleInputEmail1">Skill</label>
											    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="skill_name" value="{{ $skill->skill_name }}">
											  </div>
											  <div class="form-group">
											  	<label for="skill_desc">Enter Description</label>
											  	<textarea class="form-control" rows="3" name="skill_desc" id="skill_desc" placeholder="Enter Description">{{ $skill->skill_name }}</textarea>
											  </div>
											  <div class="newrow"></div>
											  
											  
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
	$('.addSkillBtn').click( function(){
		var new_row = '<div class="form-group"><div class="row"><div class="col-md-11"><label for="exampleInputEmail1">Skill</label><input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="skill_name[]"></div><div class="col-md-1"><span class="glyphicon glyphicon-remove-circle remove_me" aria-hidden="true"></span></div><div class="col-md-12"><div class="form-group"><label for="skill_desc">Enter Description</label><textarea class="form-control" rows="3" name="skill_desc[]" placeholder="Enter Description"></textarea></div></div></div>';
	    $(".newrow").append(new_row);
	});

	$(document).on('click','.remove_me',function(){
		$(this).parent().parent().parent().remove();
	});

	$(".all-success").fadeTo(2000, 500).slideUp(500, function(){
	    $(".all-success").slideUp(500);
	});
</script>
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/profile-skill.min.js')}}" type="text/javascript"></script>
</body>
</html>