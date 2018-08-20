<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
	
	<head>
	@include('includes.head')
	</head>
	<!-- HEAD END --->	
		

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
       @include( 'includes.header' )
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
			@include('includes.navigation')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
	<div class="page-content">
						<!-- BEGIN PAGE HEADER-->
						<!-- BEGIN PAGE BAR -->
						<div class="page-bar">
							<ul class="page-breadcrumb">
								<li>
									<a href="{{URL::to('/dashboard')}}">Dashboard</a>
									<i class="fa fa-circle"></i>
								</li>
								<li>
									<span>Order List</span>
								</li>
							</ul>
						</div>
						<!-- END PAGE BAR -->
						<!-- END PAGE HEADER-->
						<!--
						<div class="m-heading-1 border-green m-bordered">
							
						</div>
						-->
						<div class="row">
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase"> Order #{{$order->id}}
                                        </span>
                                    </div>                                  
                                </div>
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
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="portlet yellow-crusta box">
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
                                                        <div class="portlet blue-hoki box">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-cogs"></i>Customer Information </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name"> Customer Name: </div>
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
                                                        <div class="well">
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
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
					<!-- my -->
					</div>
				</div>
			</div>
		</div>	
						
				@include( 'includes.footer' )				 