<!DOCTYPE html>
<?php
include "operation.php";
$use=new User();
 $date = date_create();
	$output="Enter Email id and password.";
if(isset($_POST['submit'])){
$login1=$use->login($_POST['email'],$_POST['password']);
if(is_array($login1)){
	if(isset($login1['success'])){
		session_start();
		$_SESSION['email']=$login1['success']['email'];
		$_SESSION['login_time']=date_format($date, 'Y-m-d H:i:s');
		header("location:dashboard.php");
	}
	else if(isset($login1['error'])){
		 $output="Email_id or password wrong";
	}
}
}
else if(isset($_POST['reg'])){
	$sign_up=$use->create_user($_POST['firstname'],$_POST['lastname'],$_POST['password'],$_POST['repass'],$_POST['email'],$_POST['gender'],$_POST['dob'],'yes');
	if(is_array($sign_up)){

		if(isset($sign_up['success'])){

			$output=$sign_up['success'];
		}
		else if(isset($sign_up['error'])){
			$output=$sign_up['error'];
		}

	}
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Login Page</title>
	
		<!-- Bootstrap framework -->
			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
			<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
		<!-- theme color-->
					<link rel="stylesheet" href="css/blue.css" />
		<!-- tooltip -->    
			<link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
		<!-- main styles -->
			<link rel="stylesheet" href="css/style.css" />
	
		<!-- Favicons and the like (avoid using transparent .png) -->
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="apple-touch-icon-precomposed" href="icon.png" />
	
		<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	
		<!--[if lte IE 8]>
			<script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
		<![endif]-->
		
	<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
	<body class="login_page">
		
		<div class="login_box">
			
			<form action="login.php" method="post" id="login_form">
				<div class="top_b">Sign in </div>    
				<div class="alert alert-info alert-login">
					<a class="close" data-dismiss="alert">×</a>
					<?php echo $output;?>
				</div>
				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span><input type="text" id="email" name="email" placeholder="email id"/>
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Password"/>
						</div>
					</div>
					<div class="formRow clearfix">
						<label class="checkbox"><input type="checkbox" /> Remember me</label>
					</div>
				</div>
				<div class="btm_b clearfix">
					<button class="btn btn-inverse pull-right" type="submit" name="submit">Sign In</button>
					<span class="link_reg"><a href="#reg_form">Not registered? Sign up here</a></span>
				</div>  
			</form>
			
			<form action="dashboard.html" method="post" id="pass_form" style="display:none">
				<div class="top_b">Can't sign in?</div>    
					<div class="alert alert-info alert-login">
					Please enter your email address. You will receive a link to create a new password via email.
				</div>
				<div class="cnt_b">
					<div class="formRow clearfix">
						<div class="input-prepend">
							<span class="add-on">@</span><input type="text" placeholder="Your email address" />
						</div>
					</div>
				</div>
				<div class="btm_b tac">
					<button class="btn btn-inverse" type="submit">Request New Password</button>
				</div>  
			</form>
			
			<form action="login.php" method="post" id="reg_form" style="display:none">
				<div class="top_b">Sign up </div>
				<div class="alert alert-login">
					By filling in the form bellow and clicking the "Sign Up" button, you accept and agree to <a data-toggle="modal" href="#terms">Terms of Service</a>.
				</div>
				<div id="terms" class="modal hide fade" style="display:none">
					<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3>Terms and Conditions</h3>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<a data-dismiss="modal" class="btn" href="#">Close</a>
					</div>
				</div>
				<div class="cnt_b">
					
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="firstname" name="firstname">
						</div>
					</div>

					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on">@</span><input type="text" placeholder="lastname" name="lastname"/>
						</div>
						<!--<small>The e-mail address is not made public and will only be used if you wish to receive a new password.</small>-->
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="email" placeholder="Enter email" name="email"/>
						</div>
					</div>

					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password "  name="password"/>
						</div>
					</div>
					
					 
					 <div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="repass" name="repass"/>
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><select name="gender">
							<option>male</option>
							<option>female</option>
						</select>
						</div>


					 <div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="date" placeholder="" name="dob"/>
						</div>
					</div>


				</div>
				<div class="btm_b tac">
					<button class="btn btn-inverse" type="submit" name="reg">Sign Up</button>
				</div>  
			</form>
			
		</div>
		
		<div class="links_b links_btm clearfix">
			<span class="linkform"><a href="#pass_form">Forgot password?</a></span>
			<span class="linkform" style="display:none">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
		</div>  
		
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.actual.min.js"></script>
		<script src="lib/validation/jquery.validate.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				
				//* boxes animation
				form_wrapper = $('.login_box');
				$('.linkform a,.link_reg a').on('click',function(e){
					var target	= $(this).attr('href'),
						target_height = $(target).actual('height');
					$(form_wrapper).css({
						'height'		: form_wrapper.height()
					});	
					$(form_wrapper.find('form:visible')).fadeOut(400,function(){
						form_wrapper.stop().animate({
							height	: target_height
						},500,function(){
							$(target).fadeIn(400);
							$('.links_btm .linkform').toggle();
							$(form_wrapper).css({
								'height'		: ''
							});	
						});
					});
					e.preventDefault();
				});
				
				//* validation
				$('#login_form').validate({
					onkeyup: false,
					errorClass: 'error',
					validClass: 'valid',
					rules: {
						username: { required: true, minlength: 3 },
						password: { required: true, minlength: 3 }
					},
					highlight: function(element) {
						$(element).closest('div').addClass("f_error");
					},
					unhighlight: function(element) {
						$(element).closest('div').removeClass("f_error");
					},
					errorPlacement: function(error, element) {
						$(element).closest('div').append(error);
					}
				});
			});
		</script>
	</body>
</html>
