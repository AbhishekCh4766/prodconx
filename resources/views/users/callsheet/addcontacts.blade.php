@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>
  <script>
  
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
} 
  
  </script>
  

<?php //echo'<pre>'; print_r($friends); die; ?>
  <body>
  <!-- top-bar -->
    <div class="post-page main-page">
		
			@include('common.header')

			@include('common.left-menu')

			<div class="mid-page addCallsheet-main">
			<div class="container">
			
			<form action="{{URL::to('/addContactCallsheet')}}" method="POST" >
				<div class="profile-part">
					<div class="row">
					<div class="addCallsheet-bx recipints-box">
					<div class="call-sheet-recipints">
						<div class="tab">
							<h3>Select call sheet recipients</h3>
							<ul>
							  <li><a style="cursor:pointer;" class="tablinks" onclick="openCity(event, 'London')"> <i class="fa fa-users" aria-hidden="true"></i> My Contacts</a></li>
							  <li><a style="cursor:pointer;" class="tablinks" onclick="openCity(event, 'Paris')"> <i class="fa fa-user" aria-hidden="true"></i> Crew</a></li>
							  <li><a style="cursor:pointer;" class="tablinks" onclick="openCity(event, 'Tokyo')"> <i class="fa fa-deviantart" aria-hidden="true"></i> Talent</a></li>
							  <li><a style="cursor:pointer;" class="tablinks" onclick="openCity(event, 'Paris1')"> <i class="fa fa-th-large" aria-hidden="true"></i> Extras</a></li>
							  <li><a style="cursor:pointer;" class="tablinks" onclick="openCity(event, 'Tokyo-1')"><i class="fa fa-user" aria-hidden="true"></i> Custom </a></li>
							</ul>  
						</div>

						<div id="London" class="tabcontent">
									<div class="table-chack-bx"> 
										<div class="row margin-top-50">
											<div class="col-md-12">
											<h4>My Contacts</h4>
												<div class="panel panel-primary filterable">
												
														<div class="bg tablescroll">
															<table class="table table-bordered table-striped">
																@forelse($projectContacts as $contact)
																<tr>
																	<td style="width: 4.1%; width:50px;">
																		<div class="checkbox radio-margin">
																			<label>
																				<input type="checkbox" value="{{$contact->id}}" name="contact[]" >
																				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																			</label>
																		</div>
																	</th>
																	<td style="width: 30.8%">
																		<span class="addCallsheet-img">
																			<img src="http://allalgos.com/prodconx/public/front-end/images/profile_no_bg.png">
																		</span>
																		<span class="table-striped-table">{{$contact->first_name}} {{$contact->last_name}}</span>
																	</td>
																	<td style="width: 30.8%">
																		<span class="table-striped-table">{{$contact->email}}</span>
																	</td>

																	<td style="width: 30.8%">
																		<span class="table-striped-table">
																			@if($contact->role_id == 1)
																				Talent
																			@elseif($contact->role_id == 2)
																				Extras
																			@elseif($contact->role_id == 3)
																				Crew
																			@else
																				Custom
																			@endif
																			
																		</span>
																	</td>
																</tr>
																@empty
																	<p>No users</p>
																@endforelse						
																
															
															</table>
														</div>
													
												</div>
											</div>
										</div>

						  </div>
						</div>

						<div id="Paris" class="tabcontent" style="display: none;">
									<div class="table-chack-bx"> 

									
									
										<div class="row margin-top-50">
											<div class="col-md-12">
											<h4>My Contacts</h4>
												<div class="panel panel-primary filterable">
												
														<div class="bg tablescroll">
															<table class="table table-bordered table-striped">
																@forelse($crewContacts as $contact)
																<tr>
																	<td style="width: 4.1%; width:50px;">
																		<div class="checkbox radio-margin">
																			<label>
																				<input type="checkbox" value="{{$contact->id}}" name="contact[]">
																				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																			</label>
																		</div>
																	</th>
																	<td style="width: 30.8%">
																		<span class="addCallsheet-img">
																			<img src="http://allalgos.com/prodconx/public/front-end/images/profile_no_bg.png">
																		</span>
																		<span class="table-striped-table">{{$contact->first_name}} {{$contact->last_name}}</span>
																	</td>
																	<td style="width: 30.8%">
																		<span class="table-striped-table">{{$contact->email}}</span>
																	</td>

																	<td style="width: 30.8%">
																		<span class="table-striped-table">Crew</span>
																	</td>
																</tr>
																@empty
																	<p>No users</p>										
																@endforelse						
																
															
															</table>
														</div>
													
												</div>
											</div>
										</div>

						  </div>
						</div>

						<div id="Tokyo" class="tabcontent" style="display: none;">
									<div class="table-chack-bx"> 

									
									
										<div class="row margin-top-50">
											<div class="col-md-12">
											<h4>My Contacts</h4>
												<div class="panel panel-primary filterable">
												
													
														<!-- <table>
															<tr class="filters">
															<th style="width: 0%; width:50px;">

															</th>
															<th style="width: 100%">
																<input type="text" class="form-control" placeholder="Select All" disabled>
															</th>
															</tr>
														</table> -->
														<div class="bg tablescroll">
															<table class="table table-bordered table-striped">
																@forelse($talentContacts as $contact)
																<tr>
																	<td style="width: 4.1%; width:50px;">
																		<div class="checkbox radio-margin">
																			<label>
																				<input type="checkbox" value="{{$contact->id}}" name="contact[]">
																				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																			</label>
																		</div>
																	</th>
																	<td style="width: 30.8%">
																		<span class="addCallsheet-img">
																			<img src="http://allalgos.com/prodconx/public/front-end/images/profile_no_bg.png">
																		</span>
																		<span class="table-striped-table">{{$contact->first_name}} {{$contact->last_name}}</span>
																	</td>
																	<td style="width: 30.8%">
																		<span class="table-striped-table">{{$contact->email}}</span>
																	</td>

																	<td style="width: 30.8%">
																		<span class="table-striped-table">Talent</span>
																	</td>
																</tr>
																@empty
																	<p>No users</p>										
																@endforelse						
																				
																
															
															</table>
														</div>
													
												</div>
											</div>
										</div>

						  </div>
						</div> 
						<div id="Paris1" class="tabcontent" style="display: none;">
									<div class="table-chack-bx"> 

									
									
										<div class="row margin-top-50">
											<div class="col-md-12">
											<h4>My Contacts</h4>
												<div class="panel panel-primary filterable">
												
													
														<!-- <table>
															<tr class="filters">
															<th style="width: 0%; width:50px;">

															</th>
															<th style="width: 100%">
																<input type="text" class="form-control" placeholder="Select All" disabled>
															</th>
															</tr>
														</table> -->
														<div class="bg tablescroll">
															<table class="table table-bordered table-striped">
																@forelse($extraContacts as $contact)
																<tr>
																	<td style="width: 4.1%; width:50px;">
																		<div class="checkbox radio-margin">
																			<label>
																				<input type="checkbox" value="{{$contact->id}}" name="contact[]">
																				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																			</label>
																		</div>
																	</th>
																	<td style="width: 30.8%">
																		<span class="addCallsheet-img">
																			<img src="http://allalgos.com/prodconx/public/front-end/images/profile_no_bg.png">
																		</span>
																		<span class="table-striped-table">{{$contact->first_name}} {{$contact->last_name}}</span>
																	</td>
																	<td style="width: 30.8%">
																		<span class="table-striped-table">{{$contact->email}}</span>
																	</td>

																	<td style="width: 30.8%">
																		<span class="table-striped-table">Extra</span>
																	</td>
																</tr>
																@empty
																	<p>No users</p>										
																@endforelse						
																					
																
															
															</table>
														</div>
													
												</div>
											</div>
										</div>

						  </div>
						</div>

						<div id="Tokyo-1" class="tabcontent" style="display: none;">
									<div class="table-chack-bx"> 			
										<div class="row margin-top-50">
											<div class="col-md-12">
											<h4>My Contacts</h4>
												<div class="panel panel-primary filterable">
												
													
														<!-- <table>
															<tr class="filters">
															<th style="width: 0%; width:50px;">

															</th>
															<th style="width: 100%">
																<input type="text" class="form-control" placeholder="Select All" disabled>
															</th>
															</tr>
														</table> -->
														<div class="bg tablescroll">
															<table class="table table-bordered table-striped">
																@forelse($customtContacts as $contact)
																<tr>
																	<td style="width: 4.1%; width:50px;">
																		<div class="checkbox radio-margin">
																			<label>
																				<input type="checkbox" value="{{$contact->id}}" name="contact[]">
																				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
																			</label>
																		</div>
																	</th>
																	<td style="width: 30.8%">
																		<span class="addCallsheet-img">
																			<img src="http://allalgos.com/prodconx/public/front-end/images/profile_no_bg.png">
																		</span>
																		<span class="table-striped-table">{{$contact->first_name}} {{$contact->last_name}}</span>
																	</td>
																	<td style="width: 30.8%">
																		<span class="table-striped-table">{{$contact->email}}</span>
																	</td>

																	<td style="width: 30.8%">
																		<span class="table-striped-table">Custom</span>
																	</td>
																</tr>
																@empty
																	<p>No users</p>										
																@endforelse						
																				
																
															
															</table>
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
	<input type="hidden" value="{{Request::segment(3)}}" name="callsheet_id" />
	<input type="hidden" value="{{Request::segment(2)}}" name="project_id" />
	{{csrf_field()}}
	
	<div class="text-center new-contacts-btuon">  
       <a href="#" class="btn btn-lg btn-success" data-toggle="modal" data-target="#basicModal"><i class="fa fa-plus-circle"></i>New Contact</a>
	  

	</div>
	
	
	
</div>
     
  
    </div>
  </div>
</div>
	
	</div>
		</div>
		</div>
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
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<div class="select-cencl-buton list">
					<ul>
					
					<li class="active"><a href="#">General </a></li>
				

					<li><a href="#">Recipients </a></li>
	

					<li><a href="#"> Customize </a></li>
					
					
					</ul>
					
					</div>
					
					
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
					<div class="select-cencl-buton  next">
					<!-- <a href="{{URL::to('/team')}}/{{Request::segment(2)}}"> Next</a> -->
					<!-- <a href="{{URL::to('/addScheduleCallsheet')}}/{{Request::segment(2)}}/{{Request::segment(3)}}"> Next</a> -->
					<input type="submit" value="Next" id="next" class="btn btn-default" />
					</form>

					</div>
					
					
					</div>
					
					</div>
					</div>
					</div>
                   <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="create-new-contact">
	 <div class="create-new-imag">
	 <img src="front-end/images/book.png"></div>
  <h2>Create New Contact</h2>


  	<form action="{{url::to('/newprojectcontact')}}" method="post" class="form-group-left">
  		{{csrf_field()}}
    <div class="form-group">
  
      <input type="text" class="form-control" id="name" placeholder="Full Name…" name="name">
    </div>
    <div class="form-group">
      <input type="email" class="form-control" id="email" placeholder="Email Address…" name="email">
    </div>
	<div class="form-group">
      <input type="text" class="form-control" id="phone" placeholder="+91 11 2345 125" name="phone">
    </div>
    <input type="hidden" value="{{ Request::segment(3) }} " name="callsheet_id" />
	<input type="hidden" value="{{ Request::segment(2) }} " name="project_id" />
	<div class="form-group selectpickerbx">
		
		
       <select class="selectpicker" name="role[]" multiple="" >
       	@foreach($roles as $role)
      
      <option value="{{$role->id}}" >{{$role->role_name}}</option>

 
       @endforeach
  
           </select>
    </div>

    <div class="form-group selectpickerbx">
	
       <select class="selectpicker" name="department">
       	@foreach($departments as $department)
      
      <option value="{{$department->id}}" >{{$department->name}}</option>

 
       @endforeach
  
           </select>
    </div>
       <div class="form-group selectpickerbx">
	
       <select class="selectpicker" name="department_role">
       	@foreach($department_roles as $department_role)
      
      <option value="{{$department_role->id}}" >{{$department_role->name}}</option>

 
       @endforeach
  
           </select>
    </div>
<br/>
	<div class="form-group" style="clear: both;">
     <button type="submit" class="btn btn-default"> Save & Close</button>
	</div>
  </form>
					</div> 
	</div>
	
	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
	<script>
	
	$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
	
	
	
	
	</script>
	
  </body>
  </html>