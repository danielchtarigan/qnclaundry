<?php 
include 'config.php';
include 'send_sms.php';

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

if(isset($_POST['user_as'])) {
	$user_as = $_POST['user_as'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$accept = $_POST['accept'];

	if($user_as=="subAgen") {
		$user_a = "delivery";
		$type = "subagen";
		$subAgen = $_POST['namesub'];
	} else {
		$user_a = $user_as;
		$type = "";
		$subAgen = "";
	}

	
	if($password != $repassword) {
		$msg = "Repeat password is wrong";
	} else {
		//cek email di user yang ada
		$sql = mysqli_query($con, "SELECT * FROM user WHERE email='$email' OR name='$uname'");
		if(mysqli_num_rows($sql)>0) {
			$msg = "Email already exist!";
		} else {

			$token = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
			$token = str_shuffle($token);
			$token = substr($token, 0, 12);

			$password = md5($password);

			$con -> query ("INSERT INTO user (email,name,password,level,subagen,token,type,aktif,cabang) VALUES ('$email','$uname','$password','$user_a','$subAgen','$token','$type','tidak','makassar') ");


			$to  = $email; // note the comma

			// subject
			$subject = "Please verify email!";
			$message = '<html><body>';
			$message .= "
					Please click on the link below:";
			$message .= "<br><br>";
			$message .= "<a href='https://qnclaundry.com/reg_confirm.php?email=".$email."&token=".$token."'>".$token."</a>";
			$message .= '</body></html>';

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
			$headers .= 'to :'.$to.'' . "\r\n";
			$headers .= 'From: qnclaundry <admin@qnclaundry.com>' . "\r\n";


			// Mail it
			mail($to, $subject, $message, $headers);

			$msg = "You have been registered! Please verify your email!";

			$phone = "081233323008";
			$message = "Ada account ".$user_as." baru terdaftar di qnclaundry";

			sendSMS($phone,$message);
		}

			
		
	}	
}

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Register QnC Application</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- ace styles -->
		<link rel="stylesheet" href="lib/css/ace.min.css" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="lib/css/bootstrap.min.css" />
		<link rel="stylesheet" href="font-awesome-4.1.0/css/font-awesome.min.css" />

		

	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<img width="100%" src="Logo 2017.png">									
								</h1>
								<h4 class="white" id="id-company-text">PT. CEPAT DAN BERSIH INDONESIA</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">												

								<div id="signup-box" class="signup-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form id="form-register" action="" method="POST">
												<fieldset>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select class="form-control" id="user_as" name="user_as" required="true">
																<option value="">Register As</option>
																<option value="reception">&nbsp; Reception</option>
																<option value="delivery">&nbsp; Delivery</option>
																<option value="subAgen">&nbsp; Sub Agen</option>
															</select>
															<i class="ace-icon fa fa-circle"></i>
														</span>
													</label>

													<label class="block clearfix idsub hidden" style="margin-top: 25px">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Nama Sub Agen" name="namesub" id="namesub" />
															<i class="ace-icon fa fa-briefcase"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" name="email" id="email" required="true" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required="true" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" id="password" placeholder="Password" required="true" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="repassword" id="repassword" placeholder="Repeat password" required="true" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" name="accept" id="accept" class="ace" required="true" />
														<span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
													</label>

													<div class="space-3"></div>
													<p id="msg" style="color: green; font-weight: bolder" align="center"> <?php if(isset($msg)) echo $msg ?></p>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="submit" id="submit" class="width-65 pull-right btn btn-sm btn-success btn-register">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="login.php" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->

							</div><!-- /.position-relative -->
							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="lib/js/jquery-2.1.4.min.js"></script>	
		

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				 $(document).on('click', '.toolbar a[data-target], .toolbar-login a[data-target], .toolbar-login input[data-target]', function(e) {
					e.preventDefault();
					var target = $(this).data('target');
					$('.widget-box.visible').removeClass('visible');//hide others
					$(target).addClass('visible');//show target
				 });		

				  $('#user_as').on('change', function(){
				 	if($(this).val() == "subAgen"){
				 		$('.idsub').removeClass('hidden');
				 	} else {
				 		$('.idsub').addClass('hidden');
				 	}
				 });	
				 
			});		
		</script>
	</body>
</html>
