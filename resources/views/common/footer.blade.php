<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Post-Page</title>
    <link href="{{ URL::asset('front-end/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('front-end/css/style.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <!-- top-bar -->
    <div class="post-page main-page">
		<div class="container">
			<div class="top-bar">
				<div class="notification-icon"><a href="#"><img src="{{ URL::asset('front-end/images/notification-icon.png')}}"></a></div>
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							  <span class="sr-only">Toggle navigation</span>
							  <span class="icon-bar"></span>
							  <span class="icon-bar"></span>
							  <span class="icon-bar"></span>
							</button>
						</div>
						
						<div class="navbar-collapse collapse" id="navbar" aria-expanded="false" style="height: 1px;">
							<ul class="nav navbar-nav navbar-right">
							  <li class="active"><a href="./">Home <span class="sr-only">(current)</span></a></li>
							  <li><a href="../navbar-static-top/">Jobs</a></li>
							  <li><a href="../navbar-fixed-top/">Pro-Crew</a></li>
							  <li><a href="../navbar-fixed-top/">Account</a></li>
							   <li><a href="../navbar-fixed-top/">Create</a></li>
							   <li><a href="../navbar-fixed-top/">CallSheet</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div><!--/.container-fluid -->
				</nav>
			</div>

			<div class="side-bar">
				<div class="row">
					<div class="col-lg-12 col-mg-12 col-xs-12 space-icon">
						 <img src="{{ URL::asset('front-end/images/1.png')}}">
					</div>
					<div class="col-lg-12 col-mg-12 col-xs-12 space-icon">
						 <img src="{{ URL::asset('front-end/images/2.png')}}">
					</div>
					<div class="col-lg-12 col-mg-12 col-xs-12 space-icon">
						   <img src="{{ URL::asset('front-end/images/3.png')}}">
					</div>
				</div>
			</div>

			<div class="mid-page">
				<div class="profile-part">
					<div class="row">
						<div class="col-lg-3 col-xs-3 col-sm-3 side-bar-settings">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-xs-12 dp-background">
									<div class="profile-pic">
										<img src="{{ URL::asset('front-end/images/4.png')}}">
										<p class="name">Jesica</p>
										<p class="profile">Director</p>
									</div>
								</div>
							</div>
							
							<div class="row friends-sections">
								<div class="col-lg-12 col-xs-12 col-sm-12 frends-background">
									<div class="friends-section">
										<p class="profile-setting">Profile</p>
										<span><img src="{{ URL::asset('front-end/images/5.png')}}"></span>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12 col-sm-12 frends-background">
									<div class="friends-section">
										<p class="profile-setting"><a href="#">Friends</a></p>
										<span><img src="{{ URL::asset('front-end/images/6.png')}}"></span>
									</div>
								</div>
							</div>
							
							<div class="row addres-background">
								<div class="col-lg-12 col-xs-12 col-sm-12 website-link">
									<div class="addres-section">
										<img src="{{ URL::asset('front-end/images/7.png')}}">
										<span class="pronox"><a href="#">www.pronex.com</a></span>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12 col-sm-12 website-link1">
									<div class="addres-section1">
									<img src="{{ URL::asset('front-end/images/8.png')}}">
									 <span>USA</span>
									</div>
								</div>
							</div>
							<div class="row friends-sections">
								<div class="col-lg-12 col-xs-12 col-sm-12 groups">
									<div class="friends-section">
										<p class="profile-setting">	Group</p>
										<span>#</span>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12 col-sm-12 group-background">
									<div class="group-hand">
										  <img src="{{ URL::asset('front-end/images/9.png')}}">
										<span class="profile-setting"><a href="#">People-World</a></span>
									</div>
							
									<div class="yellow-bag">
										<img src="{{ URL::asset('front-end/images/10.png')}}">
										<span class="profile-setting"><a href="#">ThePublic Square</a></span>
									</div>
								</div>
							</div>						

							<div class="row friends-sections">
								<div class="col-lg-12 col-xs-12 col-sm-12 groups">
									<div class="friends-section">
										<p class="profile-setting">	Current-Project</p>
										<span><img src="{{ URL::asset('front-end/images/12.png')}}"></span>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12 col-sm-12 group-background">
									<div class="group-hand">
										<img src="{{ URL::asset('front-end/images/13.png')}}">
										<span class="profile-setting"><a href="#">EDM Party</a></span>
									</div>
							
									<div class="yellow-bag">
										<img src="{{ URL::asset('front-end/images/14.png')}}">
										<span class="profile-setting"><a href="#">Project</a></span>
									</div>
								</div>
							</div>												
													
						</div>			
						
						
						<div class="col-lg-9 col-xs-9 col-sm-9">
							<div class="row">
								<div class="search-bar-main">
									<div class="search-bar">
										<input class="search-input" type="text" placeholder="Search on Prodcnox.....">
										<button type="button">Search</button>
									</div>
								</div>	
							</div>	
						</div>
						
						<div class="col-lg-9 col-xs-9 col-sm-9">
							<div class="row">
								<div class="right-side">
								
									<div class="whats-on-your-mind">
										<div class="whats-on-your-mind-icon">
											<img src="{{ URL::asset('front-end/images/man-icon.png')}}">
										</div>
										<div class="whats-on-your-mind-text">
											<input class="" type="text" placeholder="Search on Prodcnox.....">
										</div>
									</div>
									
									<div class="post-section">
										<ul>
											<li>
												<div class="icon-name">
													<div class="image-icon">
														<img src="{{ URL::asset('front-end/images/man-icon.png')}}">
													</div>
													<div class="blog-name-time">
														<p class="blog-name">David Dawan</p>
														<p class="time-ago">2 hour ago via phone</p>
													</div>
												</div>
												<div class="blog-image-text">
													<p><a href="#">#trickshoot</a> Tuesday with <a href="#">#sheery</a> and <a href="#">Chris @#@#65</a> at your office.this is awsome</p>
													<img src="{{ URL::asset('front-end/images/blog-image1.jpg')}}">
													<ul class="icon-text">
														<li class="like">
															<p><a href="#">Like</a></p>
														</li>
														<li class="comments">
															<p><a href="#">Comments</a></p>
														</li>
														<li class="reply">
															<p><a href="#">Reply</a></p>
														</li>
													</ul>
												</div>
												<div class="say-something-section">
													<div class="say-something-icon">
														<img src="{{ URL::asset('front-end/images/man-icon.png')}}">
													</div>
													<div class="say-something-text">
														<input class="" type="text" placeholder="Search on Prodcnox.....">
													</div>
												</div>
											</li>
											
											<li>
												<div class="icon-name">
													<div class="image-icon">
														<img src="{{ URL::asset('front-end/images/man-icon.png')}}">
													</div>
													<div class="blog-name-time">
														<p class="blog-name">David Dawan</p>
														<p class="time-ago">2 hour ago via phone</p>
													</div>
												</div>
												<div class="blog-image-text">
													<p><a href="#">#trickshoot</a> Tuesday with <a href="#">#sheery</a> and <a href="#">Chris @#@#65</a> at your office.this is awsome</p>
													<img src="{{ URL::asset('front-end/images/blog-image2.jpg')}}">
													<ul class="icon-text">
														<li class="like">
															<p><a href="#">Like</a></p>
														</li>
														<li class="comments">
															<p><a href="#">Comments</a></p>
														</li>
														<li class="reply">
															<p><a href="#">Reply</a></p>
														</li>
													</ul>
												</div>
												<div class="say-something-section">
													<div class="say-something-icon">
														<img src="{{ URL::asset('front-end/images/man-icon.png')}}">
													</div>
													<div class="say-something-text">
														<input class="" type="text" placeholder="Search on Prodcnox.....">
													</div>
												</div>
											</li>

										</ul>
									</div>
									
								</div>	
							</div>	
						</div>
						
					</div> <!-- row -->
					
				</div> <!-- profile-part -->
				
			</div> <!--  mid-page  -->

	
		</div>
	</div>
	
  </body>
  </html>