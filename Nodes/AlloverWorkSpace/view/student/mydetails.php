
<!DOCTYPE html>
<html>
	
	<?php
		
		
		
		$absPath = $data[0];
		$absForLinksAndInclusion = $data[1];

		$studentDetails = $data[2];


		$session_name = $studentDetails['cur_session'];
		$session_id= $studentDetails['session_id'];

		$FacultyId = $studentDetails['faculty_id'];
		$DepartmentId = $studentDetails['department_id'];
		$DepartmentName = $studentDetails['department'];

		$Level = $studentDetails['level_id'];
		$semester = $studentDetails['semester_id'];
	?>


<head>

	<title>Allover</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<ank rel="icon" type="text/css" href="<?php echo "{$absPath}view/asset/img/logo.jpg"; ?>">

</head>


<body class="allover-usr-bg">


<div class="w3-main w3-cqs-amble" style="">

	<?php include_once('header_inclusion.php'); ?>
	<?php include_once('menu_inclusion.php'); ?>


		<!--Large Screen-->
		<div class="w3-container w3-white" style="margin-left: 0%; margin-right: 0%; margin-top: 59px; min-height: 520px; height: auto;">
			
			<p class="w3-leftbar w3-xlarge w3-white  w3-cqsfont" style="margin-left: 200px;"><a><?php echo $studentDetails['name']; ?></a></p>

				
				<div class="w3-col l7 m6 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto;">
					
					<div class="w3-container w3-cqs-aaargh">
						
					
							<a class="w3-bar w3-col onethird">
								<span class="w3-bar-item" style="width:20%;">Fullname</span>
								<span class="w3-bar-item"><?php echo $studentDetails['name']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird">
								<span class="w3-bar-item" style="width:20%;">Date of Brith</span>
								<span class="w3-bar-item"><?php echo $studentDetails['dob']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird">
								<span class="w3-bar-item" style="width:20%;">Matric. No</span>
								<span class="w3-bar-item"><?php echo $studentDetails['matric']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird ">
								<span class="w3-bar-item" style="width:20%;">Department</span>
								<span class="w3-bar-item"><?php echo $studentDetails['department']; ?></span>
							</a>
							

							<a class="w3-bar w3-col onethird  ">
								<span class="w3-bar-item" style="width:20%;">Faculty</span>
								<span class="w3-bar-item"><?php echo $studentDetails['faculty']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird  ">
								<span class="w3-bar-item" style="width:20%;">Level</span>
								<span class="w3-bar-item"><?php echo $studentDetails['level']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird  ">
								<span class="w3-bar-item" style="width:20%;">Semester</span>
								<span class="w3-bar-item"><?php echo $studentDetails['semester']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird">
								<span class="w3-bar-item" style="width:20%;">Session</span>
								<span class="w3-bar-item"><?php echo $studentDetails['cur_session']; ?></span>
							</a>

							<a class="w3-bar w3-col onethird ">
								<span class="w3-bar-item" style="width:20%;">Admitted</span>
								<span class="w3-bar-item"><?php echo $studentDetails['admitted']; ?></span>
							</a>

						</ul>

					</div>


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

		






