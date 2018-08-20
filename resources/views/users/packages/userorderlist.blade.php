@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>

  <body>
  <!-- top-bar -->
    <div class="post-page main-page user-order-list">
		
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
										 <h3 class="packages-heading">Order Detail</h3>
										<!-- Begin: life time stats -->
										<?php if(isset($order->id)) { ?>
										<div class="portlet light portlet-fit portlet-datatable bordered">
											<div class="portlet-body">
												
															<div class="row">
																<div class="col-md-6 col-sm-12">
																	<div class="portlet blue-crusta box">
																		<div class="portlet-title">
																			<div class="caption">
																				<i class="fa fa-cogs"></i>Order Details </div>
																			<!--<div class="actions">
																				<a href="javascript:;" class="btn btn-default btn-sm">
																					<i class="fa fa-pencil"></i> Edit </a>
																			</div> -->
																		</div>
																		<div class="portlet-body">
																			<div class="row static-info">
																				<div class="col-md-5 name"> Order #: </div>
																				<div class="col-md-7 value"> {{$order->id}}
																				</div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Order Start Date: </div>
																				<div class="col-md-7 value"> {{ date('F d, Y', strtotime($order->start_date)) }} </div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Order End Date: </div>
																				<div class="col-md-7 value"> {{ date('F d, Y', strtotime($order->end_date)) }} </div>
																			</div>																
																			<div class="row static-info">
																				<div class="col-md-5 name"> Order Status: </div>
																				<div class="col-md-7 value">
																					<span class="label label-success"> Completed </span>
																				</div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Grand Total: </div>
																				<div class="col-md-7 value"> {{$order->total_amount}} </div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Payment Information: </div>
																				<div class="col-md-7 value"> {{$order->payment_method }}  </div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12">
																	<div class="portlet red box">
																		<div class="portlet-title">
																			<div class="caption">
																				<i class="fa fa-cogs"></i>Information </div>

																		</div>
																		<div class="portlet-body">
																			<div class="row static-info">
																				<div class="col-md-5 name">  Name: </div>
																				<div class="col-md-7 value">  {{$order->first_name }}&nbsp;{{$order->last_name }}</div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Email: </div>
																				<div class="col-md-7 value"> {{$order->email }} </div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Username: </div>
																				<div class="col-md-7 value"> {{$order->username }} </div>
																			</div>
																			<div class="row static-info">
																				<div class="col-md-5 name"> Phone Number: </div>
																				<div class="col-md-7 value"> {{$order->phone }} </div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row">
																<div class="col-md-12 col-sm-12">
																	<div class="portlet grey-cascade box">
																		<div class="portlet-title">
																			<div class="caption">
																				<i class="fa fa-cogs"></i>Membership Cart </div>

																		</div>
																		<div class="portlet-body">
																			<div class="table-responsive">
																				<table class="table table-hover table-bordered table-striped">
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
																								<a href="javascript:;"> {{$order->title }} </a>
																							</td>
																							<td> {{$order->duration }}</td>
																							<td> {{$order->price }}</td>
																						</tr>                                                          </tbody>
																				</table>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6"> </div>
																<div class="col-md-6">
																	<div class="table-responsive">
																		<table class="checkout-price table table-hover table-bordered table-striped">
																			<tbody>
																				<tr>
																					<th>Sub Total:</th>
																					<td>{{$order->amount }}</td>
																				</tr>                                                          
																				<tr>
																					<th>Tax:</th>
																					<td>{{$order->tax }}</td>
																				</tr>  
																				<tr>
																					<th>Grand Total:</th>
																					<td>{{$order->total_amount }}</td>
																				</tr>  
																			</tbody>	
																		</table>
																	</div>	
																	<!-- <div class="well">
																		<div class="row static-info align-reverse">
																			<div class="col-md-8 name"> Sub Total: </div>
																			<div class="col-md-3 value"> {{$order->amount }}</div>
																		</div>
																		<div class="row static-info align-reverse">
																			<div class="col-md-8 name"> Tax: </div>
																			<div class="col-md-3 value"> {{$order->tax }} </div>
																		</div>													
																		<div class="row static-info align-reverse">
																			<div class="col-md-8 name"> Grand Total: </div>
																			<div class="col-md-3 value"> {{$order->total_amount }} </div>
																		</div>
																	   
																	</div> -->
																</div>
															</div>
														
											</div>
										</div>
										<?php } else { ?>
										<div class="portlet light portlet-fit portlet-datatable bordered">
											<div class="portlet-body">
												<div class="tabbable-line">
													<ul class="nav nav-tabs nav-tabs-lg">
														<li class="active">
															<a href="#tab_1" data-toggle="tab"> Details </a>
														</li>
													</ul>
													<div class="tab-content">
														<div class="tab-pane active" id="tab_1">
															
															
															<div class="row">
																<div class="col-md-12 col-sm-12">
																	<div class="portlet grey-cascade box">
																		<div class="portlet-title">
																			<div class="caption">
																			  No Plan Activated.</div>

																		</div>
																		
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
										<!-- End: life time stats -->
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