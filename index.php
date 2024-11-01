<?php
if (!isset($_SESSION)) {
	unset($_SESSION['error']);
	session_start();
}
if (isset($_SESSION['username'])) {
	header("Location: homepage.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Loginpage</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<style>
	/* Label moves up when the input is focused or has a value */
	.input100:focus+.label-input100,
	.input100:not(:placeholder-shown)+.label-input100 {
		top: -10px;
		font-size: 20px;
		color: #333;
	}
</style>

<body style="background-color: #faf3f3;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="conf/login.php" method="POST">
					<span class="login100-form-title p-b-43">
						<img src="images/logo.png" style="width:100px;height:100px;"> Pelita Harapan
					</span>
					<br>
					<span class="login1000-form-title p-b-43">
						Login
					</span>
					<span class="Describe-form-title p-b-43">
						Welcome to Pelita Harapan.
						<hr> Please enter your email and password to continue
					</span>


					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" id="email" name="email" required>
						<label class="label-input100" for="email">Email</label>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="password" name="password" required>
						<label class="label-input100" for="password">Password</label>
					</div>
					<?php if (isset($_SESSION['error'])) {
						echo '<div id="errorMessage" class="alert alert-danger animate__animated animate__fadeInDown" role="alert" style="background-color: #fe4949; color: white; text-align: center; margin: 20px auto; padding: 15px; border-radius: 5px;">'
							. htmlspecialchars($_SESSION['error']) . '</div>';
						unset($_SESSION['error']);
					} ?>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Don't have account? <a href="SignUp.php"> Sign up </a>
						</span>
					</div>


				</form>

				<div class="login100-more" style="background-image: url('images/LoginPage.jpg');">
				</div>
			</div>
		</div>
	</div>





	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>