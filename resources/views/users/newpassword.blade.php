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
		<div class="container">
			<div class="homepage-main">
				<div class="row">
					<div class="col-sm-7">
						<div class="home-left">
						<div class="logo"><a href="#"><img src="{{ URL::asset('front-end/images/logo.png')}}"></a></div>
							<div class="left-bottom">
								<h3>New-Password</h3>
								<div class="row">
									@if (session('status'))
										<div class="alert alert-success">
											<span> {{ session('status') }} </span>
										</div>					
									@endif	
									@if (session('success'))
										<div class="alert alert-success">
											<span> {{ session('success') }} </span>
										</div>					
									@endif										
								<form class="register-form"   action="{{URL::to('updatepassword')}}" method="post">	
									<div class="col-sm-12">
										<div class="form-group">
											<label class="" for="InputPassword">New Password</label>
											<input type="password" class="form-control"  autocomplete="off" placeholder="" name="password" id="register_password">
											
											<input type="hidden" name="random_key" id="random_key" class="" value="{{Request::segment(2)}}" />
											<input type="hidden" name="user_id" id="user_id" class="" value="{{Request::segment(3)}}" />
											
											<input type="hidden" name="_token" id="token" class="" value="{{csrf_token()}}" />											
											
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="" for="InputConfirmPassword">Confirm Password</label>
											<input type="password" class="form-control" autocomplete="off" placeholder="" name="rpassword">
										</div>
									</div>
									<div class="col-sm-12"><button type="submit" class="btn btn-default">Submit</button></div>
									</form>
									<a href="{{URL::to('login')}}" > Back To Login</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="home-right">
							<div class="home-right-img"><img src="{{ URL::asset('front-end/images/line.png')}}"></div>
							<div class="home-right-text">
								<h1>Connect, Create, <br>Share & Get Hired.</h1>
								<h2>The first  Social Media Site With <br>a Purpose</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="designed-by">DESIGNBY-Prodconx</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ URL::asset('front-end/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/login-4.min.js')}}" type="text/javascript"></script>	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
