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

    <title>Prodconx</title>
    <link href="{{ URL::asset('front-end/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('front-end/css/style.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Main jumbotron for a primary marketing message or call to action -->
<header>
<div class="container">
   <div class="inr_header">
   <div class="logo_bx"><a href="javascript:;"><img src="{{ URL::asset('front-end/images/logo.png')}}"></a></div>
<!---- <div class="nav_bx">
<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <a href="#">Home</a>
    <a href="#">Members</a>
    <a href="#">Friends </a>
    <a href="#">Messages</a>
	<a href="#">Notifications</a>
	<a href="#">Profile</a>
  </div>
</div>


<span style="font-size:30px;cursor:pointer" onclick="openNav()"><img src="{{ URL::asset('front-end/images/icon_nav.png')}}"></span>
</div>--->
    </div>
	 <div class="card_form_bx">
	  <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" 
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin login-form" action="{{URL::to('UserDashboard')}}" method="post">
			
				<div class="row">
					<div class="col-md-12">
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
				
                <span id="reauth-email" class="reauth-email"></span>
				
				  <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><img src="{{ URL::asset('front-end/images/mail_icon.png')}}"></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder=" Enter E-mail address"> 
										<input type="hidden" name="_token" value="{{ csrf_token() }}">										
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><img src="{{ URL::asset('front-end/images/passwod_icon.png')}}"></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="enter user password">
                                    </div>
				
				
                 <button class="btn btn-lg btn-primary btn-block login" type="submit">login</button>
            </form><!-- /form -->
			<div class="forgot-password-box">
            <!--<a href="{{URL::to('forgotpassword')}}" class="forgot-password">
                Forgot the password?
            </a>-->
			<p>New Here? <a href="{{URL::to('register')}}"> Sign up</a></p>
        </div><!-- /card-container -->
		</div>
	</div>
	
	
</div>




</header>
<section class="cretive_agency">

<div class="container">
<section class="cretive_agency_inr">
<h2>We’re Pro  Creative Agency</h2>
<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, binhumour, or randomised words which don't look even slbelievable. If you are going to use a passage of Lorem Ipsum,<p>
<a href="{{URL::to('register')}}">Join now</a>



</div>



</div>


</section>
<section class="talent_crew">

<div class="container">
<div class="talent_crew_inr">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<div class="talent_crew_bx">
<a href="#"> <b>Add</b><span>Talent & Crew</span></a>

</div>


</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<div class="talent_crew_bx">
<a href="#"> <b>Create & Track </b><span>Call Sheets</span></a>

</div>


</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<div class="talent_crew_bx">
<a href="#"> <b>Backup </b><span>Production Files</span></a>

</div>


</div>



</div>



</div>


</section>
<footer>
<div class="foter_top">
<div class="container">
<div class="inr_foter_top">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="logo_ftr">
<img src="{{ URL::asset('front-end/images/logo.png')}}">

</div>
<div class="logo_ftr_txt">
<p>Now, the Pequod had sailed from Nantucket at the very beginning of the Season-on-the-Line.</p>
<p>Possible endeavor then could enable her commander to make the great stuff inside.</p>


</div>


</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="foter_right">
<div class="foter_right_contct">
<p>Contact us </p>
<a href="#">
20 7371 2812 
</a>
</div>   
<div class="foter_right_mail">
<a href="mailto:Proconx@gmail.com">Email:Proconx@gmail.com
</a>

</div>


</div>



</div>
</div>

</div>

</div>
<div class="foter_copy">
<div class="container">
<div class="foter_copy_inr"><p> </i> 
 Copyright © 2017 prodconx.com. All Rights Reserved. </p></div>



</div>

</div>




</footer>





   <script>
		function openNav() {
		document.getElementById("myNav").style.width = "100%";
		}

		function closeNav() {
		document.getElementById("myNav").style.width = "0%";
		}
</script>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ URL::asset('front-end/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>	
    <script src="{{ URL::asset('assets/pages/scripts/login-4.min.js')}}" type="text/javascript"></script>	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script>
	jQuery("#user_type").change(function(){
       var val = jQuery(this).val();
		if(val==1)
		{
			
			$('.company-type').css('display','block');
			$('.user-type').css('display','none');			
		}
		else{
			
			$('.company-type').css('display','none');
			$('.user-type').css('display','block');					
		}
			
			
    });
	</script>
	<script>
		$(".success-alert").fadeTo(2000, 500).slideUp(500, function(){
		    $(".success-alert").slideUp(500);
		});
	</script>
  </body>
</html>
