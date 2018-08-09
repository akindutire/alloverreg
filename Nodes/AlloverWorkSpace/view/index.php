<!DOCTYPE html>
<html>
	
	<?php
		
		$absPath = $data[0];
		$absLinkPath = $data[1];

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

				

		<replaceit id='firstPage'>

		<!--Large Screen-->

		<div class="w3-container w3-cloud-bg w3-col l12 m12 s12" id="firstPage" style="margin-left: 0%; margin-right: 0%; margin-top: 59px; height: 500px;">
			
			<div class="w3-col l12 m12 s12 w3-white w3-cell w3-cell-middle w3-center w3-animate-zoom" style="height: 100%;">	
			
					
			
					
					
						<img class="w3-mobile" src="<?php echo "{$absPath}/view/asset/img/img03.jpg"; ?>">

						<p class="w3-center"><a href="<?php echo "{$absLinkPath}s"; ?>" class="w3-btn allover-usr-btn w3-animate-bottom">Start</a></p>

			</div>

		</div>
			
		</replaceit>
		


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