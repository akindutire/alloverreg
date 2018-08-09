<!DOCTYPE html>
<html>
	
	<?php
		$absPath = $data[0];
	?>

<head>

	<title>Allover</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="text/css" href="<?php echo "{$absPath}view/asset/img/logo.jpg"; ?>">

</head>


<body class="allover-usr-bg">


<div class="w3-main w3-cqs-amble">

	<?php include_once('header_inclusion.php'); ?>



		<!--Large Screen-->
		<div class="w3-container w3-cloud-bg" style="margin-left: 0%; margin-right: 0%; margin-top: 59px;">
			
			<div class="w3-col l12 m12 s12 w3-white" style="display: flex; justify-content: center;">	
			
				<div class="w3-col l5 m5 s12 w3-margin-8" style=" margin-top: 8%; margin-bottom: 10%;">
					
					<div class="w3-head w3-padding-4 w3-center" style="margin-top: -8%;"><h3 class=" w3-cqsfont">Login</h3><hr></div>

					<div class="w3-container w3-animate-zoom" style="">
					
						<form class="w3-form" action="<?php echo "{$absPath}StreamController/stream_login2.php"; ?>" method="post" id="login_admin_form">

							<p class="w3-panel w3-small w3-left-bar w3-center" id="result_space"> </p>


							<br>
							<label>Matric No.</label>	<input type="email" class="w3-input" name="EmailOnAdminLogin" id="EmailOnAdminLogin"><br>
							<label>Password</label>	<input type="password" class="w3-input" name="PasswordOnAdminLogin" id="PasswordOnAdminLogin"><br>

							<div class="w3-bar w3-center" style="display: flex; justify-content: center;">
							
								<button class="w3-btn w3-bar-item w3-green w3-riple w3-margin-left" type="submit" id="login_student">Login</button>								
								

							</div>
						

						</form>
					</div>

				</div>

			</div>



		<!--Footer-->
		<?php
			include_once('footer_inclusion.php');
		?>


	
</div>


</body>

<style type="text/css">
		
		@import "<?php echo "{$absPath}view/asset/css/w3.css" ?>";
		@import "<?php echo "{$absPath}view/asset/css/cqs.css" ?>";
		@import "<?php echo "{$absPath}view/asset/css/allover.css" ?>";
		@import "<?php echo "{$absPath}view/asset/css/font-awesome/css/font-awesome.min.css" ?>";

</style>



<script type="text/javascript" src="<?php echo "{$absPath}view/asset/js/jquery-3.2.1.min.js" ?>"></script>
<script type="text/javascript" src="<?php echo "{$absPath}view/asset/js/CliqsStudio_login_interact.js" ?>"></script>
<script type="text/javascript" src="<?php echo "{$absPath}view/asset/js/CliqsStudio_form_interact.js" ?>"></script>
<script type="text/javascript" src="<?php echo "{$absPath}view/asset/js/allover.js" ?>"></script>
<script type="text/javascript" src="<?php echo "{$absPath}view/asset/js/allover_interact.js" ?>"></script>


</html>		

		






