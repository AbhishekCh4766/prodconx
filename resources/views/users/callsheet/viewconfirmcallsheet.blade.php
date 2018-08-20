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
								
								<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class job-posting-common-class boxProject">
									<div class="row" style="text-align: center;">
										<div class="right-side" style="padding: 0;">
											<div class="project-name my_callsheet_inner">
												@foreach($projects as $project)
												  <?php $project_name = App\Models\ProjectModel::where('id', $project->project_id)->pluck('project_name');
																?>
												<table>
													<tbody>
														<tr>
															<th>Location Name</th>
															<td>{{$project->location}}</td>
														</tr>
														<tr>
															<th>Phone Number</th>
															<td>{{$project->phone}}</td>
														</tr>
														<tr>
															<th>Director Name</th>
															<td>{{$project->director_name}}</td>
														</tr>
														<tr>
															<th>Project Name</th>
															<td>{{$project_name}}</td>
														</tr>
														<tr>
															<th>Project Title</th>
															<td>{{$project->title}}</td>
														</tr>
														<tr>
															<th>Shoot Date</th>
															<td>{{$project->date}}</td>
														</tr>
														<tr>
															<th>Call Time</th>
															<td>{{$project->time}}</td>
														</tr>
														<tr>
															<th>Shoot type</th>
															<td>{{$project->type}}</td>
														</tr>
														<tr>
															<th>Description</th>
															<td>{{$project->description}}</td>
														</tr>
														<tr>
															<th>Nearest Hospital</th>
															<td>{{$project->hospital}}</td>
														</tr>
													</tbody>
												</table>
												@endforeach
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
				</div>
			</div>
		</div>
	</div>


