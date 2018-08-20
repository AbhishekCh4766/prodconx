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
									
										<h3 class="packages-heading">Checkout</h3>
										
										<div class="portlet light portlet-fit bordered">
											<div class="portlet-body">
												<div class="pricing-content-1">
													<div class="row">
														<div class="col-md-12 col-sm-12">
															<div class="portlet grey-cascade box">
																<div class="portlet-title">
																	<div class="caption">
																		

																	</div>
																	<div class="portlet-body">
																		<div class="table-responsive">
																			<table class="table table-hover table-bordered table-striped checkout-products-info">
																				<thead>
																					<tr>
																						<th> Product </th>
																						<th> Duration </th>
																						<th> Price </th>
																					</tr>
																				</thead>
																				<tbody>
																					<tr>
																						<td>
																							<a href="javascript:;"> {{$membership_plan->title}} </a>
																						</td>
																						<td> {{$membership_plan->duration}}</td>
																						<td> {{$membership_plan->price }}</td>
																					</tr>                                                          </tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														
														<div class="col-md-6"> </div>
														<div class="col-md-6">
														
															<div class="table-responsive">
																<table class="checkout-price table table-hover table-bordered table-striped">
																	<tbody>
																		<tr>
																			<th>Sub Total:</th>
																			<td>{{$membership_plan->price }}</td>
																		</tr>                                                          
																		<tr>
																			<th>Tax:</th>
																			<td>0</td>
																		</tr>  
																		<tr>
																			<th>Grand Total:</th>
																			<td>{{$membership_plan->price }}</td>
																		</tr>  
																	</tbody>	
																</table>
															</div>	
															<!-- <div class="well">
																<div class="row static-info align-reverse">
																	<div class="col-md-8 name"> Sub Total: </div>
																	<div class="col-md-3 value"> {{$membership_plan->price }}</div>
																</div>
																<div class="row static-info align-reverse">
																	<div class="col-md-8 name"> Tax: </div>
																	<div class="col-md-3 value"> 0 </div>
																</div>													
																<div class="row static-info align-reverse">
																	<div class="col-md-8 name"> Grand Total: </div>
																	<div class="col-md-3 value"> {{$membership_plan->price }} </div>
																</div>
															</div> -->
															
															<div class="form-actions noborder checkout-buttons" style="text-align:right;" >
																<a  href="{{URL::to('userDashboard')}}"><button type="button" class="btn btn default">Cancel Payment</button></a>														
																<a  href="{{URL::to('payment')}}/{{$membership_plan->id}}"><button type="button" class="btn blue">Make Your Payment</button></a>
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
	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			
	</div>	
			
	</div>

  </body>
  </html>