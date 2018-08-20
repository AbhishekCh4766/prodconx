<!DOCTYPE html>
<html>
    <head>
        <title>SignUp | Prodconx</title>
		
	<link rel="stylesheet" href="{{ URL::asset('validation/css/validationEngine.jquery.css')}}" type="text/css"/>
	<link rel="stylesheet" href="{{ URL::asset('validation/css/template.css')}}" type="text/css"/>
	<script src="{{ URL::asset('validation/js/jquery-1.8.2.min.js')}}" type="text/javascript">
	</script>
	<script src="{{ URL::asset('validation/js/jquery.validationEngine-en.js')}}" type="text/javascript" charset="utf-8">
	</script>
	<script src="{{ URL::asset('validation/js/jquery.validationEngine.js')}}" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>		
		
		
		
		
    </head>
    <body>
<?php echo '<pre>';?>

	@if (session('status'))
        <div class="alert alert-danger">
            <span> {{ session('status') }} </span>
        </div>					
	@endif	
				
	<form method="POST" action="store" name="form" id="formID" >
	First name
	<input type="text" name="first_name" id="first_name" class="validate[required]" value="{{Request::old('first_name')}}" />
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	Last Name
	<input type="text" name="last_name" id="last_name" value="{{Request::old('last_name')}}" />			
	Gender
	<select name="gender" >
		<option value="1">Male</option>
		<option value="2">Female</option>	
	</select>
	Birth Date
	<input type="text" name="birth_date" id="birth_date" class="validate[required]" value="{{Request::old('birth_date')}}" />	
	Phone
	<input type="text" name="phone" id="phone" value="{{Request::old('phone')}}" />					
	Username	
	<input type="text" name="username" id="username" class="validate[required]" value="{{Request::old('username')}}" />	
	Password
	<input type="password" name="password" id="password" class="validate[required]"  />	
	Email
	<input type="text" name="email" id="email" class="validate[required]" value="{{Request::old('email')}}" />	

	<input type="submit" name="submit" id="submit"/>	
	
	</form>
<?php echo '</pre>';?>	
<a href="login" >SignIn</a>	
    </body>
</html>
