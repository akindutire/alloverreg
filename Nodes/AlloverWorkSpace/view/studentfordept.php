
<!DOCTYPE html>
<html>
	
	<?php
		
		if ($_SESSION['rank'] != 'faculty') {
			die();
		}
		
		$absPath = $data[0];
		$absForLinksAndInclusion = $data[1];

		$adminDetails = $data[2];

		$FacultyName = $data[4];
		$FacultyId = $data[5];

		$session_info = $data[3];
		$session_name = $session_info['session_name'];
		$session_id= $session_info['session_id'];
		
		$StudentData  = $data[6];

		
	?>


<head>

	<title>Allover</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="text/css" href="<?php echo "{$absPath}view/asset/img/logo.jpg"; ?>">

</head>


<body class="allover-usr-bg">


<div class="w3-main w3-cqs-amble" style="">

	<?php include_once('header_inclusion.php'); ?>
	<?php include_once('menu_inclusion.php'); ?>


		<!--Large Screen-->
		<div class="w3-container w3-white" style="margin-left: 0%; margin-right: 0%; margin-top: 59px; min-height: 520px; height: auto;">
			
			<p class="w3-leftbar w3-xlarge w3-white  w3-cqsfont" style="margin-left: 200px;"><a><?php echo "{$adminDetails['name']} | {$session_name} - {$FacultyName}"; ?></a></p>

				
				<div class="w3-col l12 m12 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto;">
					
					<table class="w3-table w3-responsive" id="coursedata">
						<legend>Faculty Course</legend>
						
						<thead>
							
							<tr class="w3-green"><td>#</td>  <td>Course title</td> <td>Course Code</td> <td>Course Unit</td> <td>Level</td> <td>Dept.</td>  <td>Prerequisite</td></tr>

						</thead>


						<tbody>
							<?php echo $StudentData; ?>
						</tbody>


					</table>
					
										
						

				</div>

		
</div>

		<!--Footer-->
		<?php
			include_once('footer_inclusion.php');
		?>


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

		






