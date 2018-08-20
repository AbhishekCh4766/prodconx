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
						@include('common.innerleft-menu')	
						
										

						
						<div class="col-lg-9 col-xs-9 col-sm-9">
							<div class="row">
								<div class="right-side">
										<div class="rightsidebar">
@include('common.header-menu')
</div>
										@if (session('status'))
										<div class="alert alert-success">
											<button class="close" data-close="alert"></button>
											<span> {{ session('status') }} </span>
										</div>					
										@endif										
									 <div class="project-section"> 
									
											<div class="call-sheet-made">
											<div class="container">
											<div class="row row-first-section-call-sheet">
											<div class="col-lg-4 col-xs-4 col-sm-4 first-child">
											<p><span>call sheet made with</span></p>
											<p>Chandigarh, 160017, India</p>
											<div class="person">
											<div class="role strong">Director / Prod.</div>
											<div class="name">Naval</div>
											<div class="phone">91</div>
											</div>
											<div class="person-1">
											<div class="role strong">Director / Prod.</div>
											<div class="name">Naval</div>
											<div class="phone">91</div>
											</div>

											</div>

											<div class="col-lg-4 col-xs-4 col-sm-4 second-child">
											<img src="{{ URL::asset('front-end/images/prevlogo.png')}}">
											<h5>Happy New Year</h5>
											<p>General Call Time</p>
											<h4>7:00pm</h4>



											</div>



											<div class="col-lg-4 col-xs-4 col-sm-4 third-child">
											<p>Sat, Dec 31, 2016</p>
											<p>Crew Call:7:00pm</p>



											</div>
											</div>
											</div>
											</div>
											<div class="section-2">
											<div class="container">
											<div class="row">
											<div class="col-lg-12 col-xs-12 col-sm-12">
											<table>
											  <tr>
												<th>POSITION</th>
												<th>NAME</th> 
												<th>CALL</th>
											  </tr>
											  <tr>
												<td>Director</td>
												<td>SDirector/Prod.</td>
												<td>Director/Prod.</td>
											  </tr>
											  

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
						
					</div> <!-- row -->
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				
	</div>				
			</div> <!--  mid-page  -->

	
		</div>
	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	

<style>
.modal-footer {
	display:none;
} 
</style>

<script>

$( ".details #confirm_button" ).click(function() {
		$(this).val('Please wait..');
		
		var callsheet_id = $(this).attr('alt');
		var token = document.getElementById('token').value;

			var route = "callsheetConfirm";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				context: this,
				data: {
					callsheet_id:callsheet_id
				},
				success: function(data) {
					
						$(this).val('Done');
						$(this).prop("disabled",true);

					},
				error: function(data) {
					alert("Fail");
				},
			});
});
$( "#edit-li button" ).on("click", function() { 
        var alt = $(this).attr("alt");
		var token = document.getElementById('token').value;
		var team = $(this).attr("team")	;	

			var route = "geteditcontact";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'html',
				data: {
					data: alt,
					team:team
				},
				success: function(data) {
					$('#myEditModal').html(data);
					},
				error: function(data) {
					alert("Fail");
				},
			});
});
</script>

		
  </body>
  </html>