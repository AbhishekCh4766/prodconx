@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('date/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date/timepicker.css') }}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>
  <script src="{{ asset('date/datepicker.min.js') }}"></script>
  <script src="{{ asset('date/timepicker.js') }}"></script>

  <body>
  <!-- top-bar -->
    <div class="post-page main-page">
		
			@include('common.header')

			@include('common.left-menu')

			<div class="mid-page addLocations-main">
			<div class="container">
				<div class="profile-part">
					<div class="row">
					<div class="addCallsheet-bx">
		           			<form action="{{URL::to('/addlocationCallsheet')}}" method="POST" >
				<div class="profile-part">
					<div class="row">
					<div class="addCallsheet-bx recipints-box">
					<div class="call-sheet-recipints">
					<h3>Select call sheet recipients</h3>
					

<div id="London" class="tabcontent">
            <!--<div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
				   <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                    <input type="text" class="form-control"  placeholder="Search by name, email, project name, or list……" >
                 
                </div>
            </div>-->
			<div class="table-chack-bx"> 

			
			
				<div class="row margin-top-50">
					<div class="col-md-12">
					<h4>Add Project Locations</h4>
						<div class="panel panel-primary filterable">
						
							<table class="span12">
								<table>
									<tr class="filters">
										<th style="width: 20%; width:50px; padding: 5px 30px !important;">
									
									<th>Project Location</th>
									<th> Parking / Notes</th>
							
									<th>  Nearest Hospital</th>
									</tr>

								</table>
								<div class="bg tablescroll">
									<table class="table table-bordered table-striped">
										@forelse($locations as $location)
										<tr>
											<td style="width: 4.1%; width:50px;">
												<div class="checkbox radio-margin">
													<label>
														<input type="checkbox" value="{{$location->id}}" name="project_location[]" >
														<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													</label>
												</div>
											</th>
											<td style="width: 25%">
												<span class="addCallsheet-img">
													<img src="http://allalgos.com/prodconx/public/front-end/images/profile_no_bg.png">
												</span>
												<span class="table-striped-table">{{$location->project_location}}</span>
											</td>
											<td style="width: 25%">
												<span class="table-striped-table">{{$location->parking}}/
												{{$location->notes}}</span>
											</td>

										
											<td style="width: 25%">
												<span class="table-striped-table">{{$location->nearest_hospital}}</span>
											</td>
										</tr>
										@empty
											<p>No Location</p>
										@endforelse						
										
									
								
								</div>
							</table>
						</div>
					</div>
				</div>

  </div>
</div>


						</div>
					</div>
				</div>

  </div>
</div> 
					
					</div>
					
					
			
			</div> <!--  mid-page  -->
		</div>
	</div>
	<input type="hidden" value="{{ Request::segment(3) }} " name="callsheet_id" />
	<input type="hidden" value="{{ Request::segment(2) }} " name="project_id" />
	{{csrf_field()}}
	
	</div>

<div class="select-type-bx bottom-bx">
					<div class="container">
					<div class="row">
					<div class="inr-bottom-bx">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
					<div class="select-cencl-buton">
					<a href="{{URL::to('/team')}}/{{Request::segment(2)}}"> Cancel</a>
					
					</div>
					
					
					</div>
					
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 next_button">
					<div class="select-cencl-buton  next ">
					<!-- <a href="{{URL::to('/team')}}/{{Request::segment(2)}}"> Next</a> -->
					
					<input type="submit" value="Next" id="next" class="btn btn-default" />
					</div>
					
					
					</div>
					
					</div>
					</div>
					</div>
					</form>
					</div> 