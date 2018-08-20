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
										 <!-- <div class="row project-section-name">
											<div class="col-lg-8 col-sm-8 col-xs-12 input-box">
												<div class="input-group">
													  <input type="text" class="form-control" placeholder="Search for...">
													  <span class="input-group-btn">
														<button class="btn btn-default" type="button">Go!</button>
													  </span>
												</div>
											</div>
										</div> -->
										<div class="membership-section">
											
											<h3 class="packages-heading">Pricing</h3>
										
											<ul class="packages-inner">
											@foreach($memberships as $membership)	
												<li>
													<h3>{{$membership->title}}</h3>
													<span class="membership-price"><font>$</font>{{$membership->price}}</span>
													<p class="per-month">{{$membership->duration}}</p>
													<a href="{{URL::to('checkout')}}/{{$membership->id}}" >Purchase</a>
												</li>

											@endforeach	
											</ul>
											
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
  </body>
  </html>