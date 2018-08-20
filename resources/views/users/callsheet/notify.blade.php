@include('common.head')
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/10b4771377.js"></script>
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
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
							<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class">
								<div class="row">
									<div class="right-side">
										<div class="row personal-info">
											<div class="project-name">
												<p><a href="{{URL::to('projects')}} " >Project</a> > <a href="{{URL::to('project')}}/{{Request::segment(2)}}" > {{$projectname->project_name}} </a> > Call Sheets Notifications</p>
											</div>
										 	<div class="project-section project-section_bx">
												<table class="table table-bordered table-hover">
												    <thead>
												      <tr>
												        <th>Sno</th>
												        <th>Contact Name</th>
												        <th>Email</th>
												        <th>Is Confirmed</th>
												      </tr>
												    </thead>
												    <tbody>
												    <?php $x = 1; ?>
												    @foreach($contacts as $contact)
												      <tr>
												        <td>{{$x}}</td>
												        <td>
												        	{{ ucwords(App\User::where('id',$contact->owner_id)->pluck('first_name')) }}
												        	{{ ucwords(App\User::where('id',$contact->owner_id)->pluck('last_name')) }}
												        </td>
												        <td>
												        	{{App\User::where('id',$contact->owner_id)->pluck('email')}}
												        </td>
												        <td>
												        	{{ $contact->confirm == 1 ? 'Confirmed' : 'Not Confirmed' }}
												        </td>
												      </tr>
												      <?php $x++; ?>
												    @endforeach
												    </tbody>
											  	</table>
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
				</div>
			</div> <!-- row -->
		</div>		
	</div>		
	<!-- end call sheet preview-->
</div> <!--  mid-page  -->
<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
</body>
</html>