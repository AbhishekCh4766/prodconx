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
				<div class="membership-part">
					<div class="row">
							
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<div class="row">
								<div class="right-side">
									<div class="membership-section">
										@if (session('message'))
											<div class="alert alert-danger">
												<span> {{ session('message') }} </span>
											</div>					
										@endif		
												
										<!---- Datatable ------------>

										<h3 class="packages-heading">Payment History</h3>				
										<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Package Name</th>
													<th>Amount</th>
													<th>Duration</th>
													<th>Start Date</th>
													<th>End Date</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Package Name</th>
													<th>Amount</th>
													<th>Duration</th>
													<th>Start Date</th>
													<th>End Date</th>
												</tr>
											</tfoot>
											<tbody>
											@foreach($memberships as $pack)
												<tr>
													<td>{{$pack->title}}</td>
													<td>{{$pack->total_amount}}</td>
													<td>{{$pack->duration}}</td>
													<td>{{ date('F d, Y', strtotime($pack->start_date)) }}</td>
													<td>{{ date('F d, Y', strtotime($pack->end_date)) }}</td>
												</tr>
											@endforeach	
											</tbody>
										</table>						
								
									</div>
								</div>	
							</div>	
						</div>
						
						
				
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
				
			</div> <!--  mid-page  -->

		</div>
	</div>
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">						
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>	

	<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );
	</script>
	
  </body>
  </html>