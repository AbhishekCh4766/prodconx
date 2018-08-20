<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('front-end/favicon.ico')}}">

    <title>Homepage</title>
    <link href="{{ URL::asset('front-end/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('front-end/css/style.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="home-page">
		<div class="home-page-header">
			<div class="container">
				<div class="logo"><a href="javascript:;"><img src="{{ URL::asset('front-end/images/logo.png')}}"></a></div>
				<div class="login-bar">
					<!-- @if (session('message'))
					<div class="alert alert-danger">
						<span> {{ session('message') }} </span>
					</div>					
					@endif	
					
					@if (session('success'))
					<div class="alert alert-success">
						<span> {{ session('success') }} </span>
					</div>					
					@endif	 -->
					
					<form class="login-form" action="{{URL::to('UserDashboard')}}" method="post">
						<div class="form-group">
							<div class="input-icon">
								<input class="login-input" type="email" name="username" placeholder="E-mail" />
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
						</div>	 
						<div class="form-group">
							<div class="input-icon">		
								<input class="login-input" type="password" placeholder="Password"  name="password"/>
							</div>	
						</div>	
						<input class="loginb-button" type="submit"  value="LOGIN" />
					</form>	
					<div class="forgot-password">
						<a href="{{URL::to('forgotpassword')}}" >Forgot Password? </a>
					</div>
				</div>
			</div>
		</div>
		<div class="homepage-main">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						@if (session('message'))
						<div class="alert alert-danger myalert success-alert">
							<span> {{ session('message') }} </span>
						</div>					
						@endif	

						@if (session('success'))
						<div class="alert alert-success myalert success-alert">
							<span> {{ session('success') }} </span>
						</div>					
						@endif
					</div>
				</div>
				<div class="row">
					<div class="home-sign-up-heading">
						<h1>Connect, Create, Share & Get Hired.</h1>
						<h2>The first  Social Media Site With a Purpose</h2>
					</div>
						<div class="home-sign-up-form">
							<div class="home-sign-up-form-inner">
								<h3>Forgot Password ?</h3>
								<div class="login-bar">								
									<form class="login-form" action="{{URL::to('getPassword')}}" method="post">
										<div class="form-group">
											<label class="forgotemailaddress" for="InputFirstName">Please Enter Your E-mail</label>
											<input class="form-control placeholder-no-fix" type="text" placeholder="Please enter your email" name="username" id="first_name" /> 
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="login-button-div">
												<input class="loginb-button" type="submit"  value="Send" />
											</div>
										</div>	 
								
									</form>	
								</div>
								<div class="back-to-login">
									<a href="{{URL::to('login')}}" ><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>Back To Login</a>
								</div>
							</div>
						
						</div>
				</div>	
			</div>	
		</div>
		<div class="home-footer">
			<div class="designed-by">DESIGNBY-Prodconx</div>
		</div>
    </div>

    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ URL::asset('front-end/js/bootstrap.min.js')}}"></script>
    <!--<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	-->
    <script src="{{ URL::asset('assets/pages/scripts/login-4.min.js')}}" type="text/javascript"></script>	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
    	$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
		    $(".success-alert").slideUp(500);
		});
    </script>
  </body>
</html>
