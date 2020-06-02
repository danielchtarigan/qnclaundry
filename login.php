<?php 
include 'config.php';
include 'nonaktif_membership.php';

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login QnC Application</title>

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
							<?php 
							if(isset($_POST['username'])) {
								$username = $_POST['username'];
								$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$username."' AND aktif='Ya'"));
								if($data != false && $data['password'] == md5($_POST['password'])){
                                    if(isset($_POST['remembercookie'])){
                                        $time = time();
                                        setcookie('user', $username, $time + 3600);
                                        setcookie('passd', $_POST['password'], $time + 3600);

                                    }
                                    else {
                                        if(isset($_COOKIE['user'])){
                                            setcookie('user','');
                                        }
                                        if(isset($_COOKIE['passd'])){
                                            setcookie('passd','');
                                        }
                                    }
									?>
									
									<div id="login-first" class="login-first visible widget-box no-border">

										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header green lighter bigger">
													<i class="ace-icon fa fa-users blue"></i>
													Login As											
												</h4>

												<div class="space-6"></div>											

												<form class="toolbar-login" action="ceklogin.php" method="POST">
													<fieldset>
														<input type="text" class="hidden" name="userid" id="userid" value="<?= $username ?>">
														<input type="text" class="hidden" name="passwrd" id="passwrd" value="<?= md5($_POST['password']) ?>">
														<input type="text" class="hidden" name="level" id="level" value="<?= $data['level'] ?>">

														<?php 
														if($data['level']=="operator" || $data['level']=="packer")
														{ 
															echo '
															<label class="block clearfix">
																<span class="block input-icon input-icon-right">
																	<input data-target="#workshop" type="button" class="form-control" name="" value="Workshop">
																	<i class="ace-icon fa fa-coffee"></i>
																</span>
															</label>
															';

														}

														else if($data['level']=="reception") {
															echo '
															<label class="block clearfix">
																<span class="block input-icon input-icon-right">
																	<input data-target="#reception" type="button" class="form-control" name="" value="Reception">
																	<i class="ace-icon fa fa-laptop"></i>
																</span>
															</label>
															';
														}

														else if($data['level']=="delivery") {
															echo '
															<label class="block clearfix">
																<span class="block input-icon input-icon-right">
																	<input id="delsba" type="submit" class="form-control" name="" value="Delivery | Smart Pickup">
																	<i class="ace-icon fa fa-circle"></i>
																</span>
															</label>
															';
														}
														else {
															echo '
															<label class="block clearfix">
																<span class="block input-icon input-icon-right">
																	<input id="delsba" type="submit" class="form-control" name="" value="Admin | Spectator">
																	<i class="ace-icon fa fa-circle"></i>
																</span>
															</label>
															';
														}
														?>
                                                        
															

													</fieldset>
												</form>
											</div>

											
										</div><!-- /.widget-body -->
									</div><!-- /.login-first -->

									<div id="workshop" class="workshop widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header green lighter bigger">
													<i class="ace-icon fa fa-coffee blue"></i>
													Click to Select Workshop
												</h4>

												<div class="space-6"></div>

												<form class="toolbar-login" method="POST" action="ceklogin.php">
													<fieldset>	
														<input type="text" class="hidden" name="userid" id="userid" value="<?= $username ?>">
														<input type="text" class="hidden" name="passwrd" id="passwrd" value="<?= md5($_POST['password']) ?>">
														<input type="text" class="hidden" name="level" id="level" value="<?= $data['level'] ?>">

														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input type="submit" class="form-control" name="workshop" value="Toddopuli">
																<i class="ace-icon fa fa-check-square-o"></i>
															</span>
														</label>

														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input type="submit" class="form-control" name="workshop" value="Daya">
																<i class="ace-icon fa fa-check-square-o"></i>
															</span>
														</label>					

													</fieldset>
												</form>
											</div>

											
										</div><!-- /.widget-body -->
									</div><!-- /.workshop -->

									<div id="reception" class="reception widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header green lighter bigger">
													<i class="ace-icon fa fa-laptop blue"></i>
													Click to Select Outlet
												</h4>

												<div class="space-6"></div>

												<form class="toolbar-login" method="POST" action="ceklogin.php">
													<fieldset>	
														<input type="text" class="hidden" name="userid" id="userid" value="<?= $username ?>">
														<input type="text" class="hidden" name="passwrd" id="passwrd" value="<?= md5($_POST['password']) ?>">
														<input type="text" class="hidden" name="level" id="level" value="<?= $data['level'] ?>">

														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<select class="form-control" id="jaringan" name="jaringan">
																	<option value="">Choose Your Jaringan</option>
																	<?php 
																	$outlets = mysqli_query($con, "SELECT DISTINCT Kota FROM outlet WHERE Kota='Makassar' ORDER BY Kota ASC");
																	while($ot = mysqli_fetch_array($outlets)){
																		echo '<option value="'.$ot[0].'">&nbsp; '.ucwords($ot[0]).'</option>';
																	}
																	?>
																</select>
															</span>
														</label>

														<label class="block clearfix">
															<span class="block input-icon input-icon-right" id="outlets">
																
																<select class="form-control" name="" disabled="">
																	<?php 
																	echo '<option value="">Choose Your Outlet</option>';
																	
																	$outlets = mysqli_query($con, "SELECT nama_outlet FROM outlet ORDER BY nama_outlet ASC");
																	while($ot = mysqli_fetch_array($outlets)){
																		echo '<option value="'.$ot[0].'">&nbsp; '.ucwords($ot[0]).'</option>';
																	}
																	?>															
																</select>

															</span>
														</label>

														<div id="respon_key"></div>

														<label class="block clearfix">
															<span class="block input-icon input-icon-right">	
																<button type="submit" class="btn btn-sm btn-success btn-block" name="" value="Login">
																	<i class="ace-icon fa fa-key white"></i>
																	<span class="bigger-110">Login</span>
																</button>
															</span>
														</label>													

													</fieldset>
												</form>
											</div>

											
										</div><!-- /.widget-body -->
									</div><!-- /.reception -->

									<?php
								}
								else {
								?>
									<script type="text/javascript">
										 alert("Username dan Password Salah!");
										 location.href='login.php';
									</script>
								<?php
								}								

							}
							else {
								?>
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<?php if(isset($_GET['activated'])) echo "<h3 class='header green lighter bigger'>Your Account has activated! Now, you can login!</h3>"; else echo ""; ?>
											

											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											<form method="POST" action="login.php" onSubmit="klik()">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(isset($_COOKIE['user'])) { echo $_COOKIE['user']; } ?>" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE['passd'])) { echo $_COOKIE['passd']; } ?>" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space-3"></div>
													<p style="color: green" align="center"> <?php if(isset($msg)) echo $msg; ?> </p>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" name="remembercookie" />
															<span class="lbl"> Remember Me</span>
														</label>
														<button href="#" data-target="#login-first" type="submit" class="width-35 pull-right btn btn-sm btn-success" name="login">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>	
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>											

										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="register_user.php" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->								

								<?php
							}

							?>
								

								
							</div><!-- /.position-relative -->
							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div id="result"></div>
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

				 $("#jaringan").change(function(){
					var jaringan = $(this).val();
					$('#outlets').load('pilih_outlet.php?jrg='+jaringan);
				});

				 $("#outlet").change(function(){
					var outlet = $(this).val();
					$('#respon_key').load('respon_key.php?ot='+outlet);
				});					

				 
			});				
			
		</script>
	</body>
</html>
