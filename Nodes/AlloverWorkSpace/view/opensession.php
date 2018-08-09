
<!DOCTYPE html>
<html>
	
	<?php
		
		if ($_SESSION['rank'] != 'faculty') {
			die();
		}
		
		$absPath = $data[0];
		$absForLinksAndInclusion = $data[1];

		$adminDetails = $data[2];

		$FacultyName = $adminDetails['faculty'];
		$FacultyId = $adminDetails['faculty_id'];

		$session_info = $data[3];
		$session_name = $session_info['session_name'];
		$session_id= $session_info['session_id'];

		$DepartmentData = $data[4];
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

				
				<div class="w3-col l7 m6 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto;">
					<p id="table_space" class="w3-center w3-small"></p>

					<table class="w3-table w3-responsive" id="deptdata">
						
						
						<thead>
							
							<tr class="w3-green"><td>#</td><td>Department</td> <td>Lecturers</td></tr>

						</thead>


						<tbody>
							<?php echo $DepartmentData; ?>
						</tbody>


					</table>
					
										
						

				</div>

				<div class="w3-col l3 m3 s12 w3-padding w3-card-4 w3-margin-left" style=" margin-top: 1%; margin-bottom: 1%;">
					
					<p></p>
					<p id="result_space" class="w3-center w3-small"></p>

					<form class="w3-form w3-padding" action="<?php echo "{$absPath}StreamController/stream_adddept.php"; ?>" method="post">
						
						<label>Department</label> <input class="w3-input" type="text" name="department" id="department" autofocus><br>
						<input type="hidden" name="faculty_id" id="faculty_id" value="<?php echo $FacultyId; ?>">
						<p class="w3-center"> <button class="w3-btn w3-green" type="submit" id="btnAddDept">Create</button> </p>
					</form>

										
						

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

		






