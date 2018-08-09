
<!DOCTYPE html>
<html>
	
	<?php
		
		if ($_SESSION['rank'] != 'HODdepartment') {
			die();
		}
		
		$absPath = $data[0];
		$absForLinksAndInclusion = $data[1];

		$adminDetails = $data[2];

		$FacultyName = $adminDetails['faculty'];
		$FacultyId = $adminDetails['faculty_id'];

		$DepartmentId = $adminDetails['department_id'];
		$DepartmentName = $adminDetails['department'];

		$session_info = $data[3];
		$session_name = $session_info['session_name'];
		$session_id= $session_info['session_id'];
		
		$StudentData  = $data[4];

		$LevelOptionList = $data[5];

		
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

	

	<!--Modal for Courses-->

		<div class="w3-modal w3-animate-top" style="display: none; position: fixed;" id="DialogModalForAssignedCourses">
			
			
			<div class="w3-modal-content" class="">
				
				<h4 class="w3-grey">

					<span class="w3-center w3-padding-16 w3-medium w3-margin" style="padding-left: 16px;">Registered Courses</span>
					<span><a class="w3-tag w3-red w3-right" onclick="document.getElementById('DialogModalForAssignedCourses').style.display='none';"><i class="fa fa-times"></i></a></span>

				</h4>

				<div class="w3-container w3-white w3-padding-16">
					
					
					<table class="w3-table">
						
						<thead class="w3-grey">
							
							<tr><td>#</td> <td>Course</td> <td>Course Unit</td> <td>Course Code</td> <td>Registered On</td> </tr>
						</thead>

						<tbody>
							

						</tbody>


					</table>


				</div>
				


			</div>
		</div>
		<!--end modal-->



		<!--Large Screen-->
		<div class="w3-container w3-white" style="margin-left: 0%; margin-right: 0%; margin-top: 59px; min-height: 520px; height: auto;">
			
			<p class="w3-leftbar w3-xlarge w3-white  w3-cqsfont" style="margin-left: 200px;"><a><?php echo "{$adminDetails['name']} | {$session_name} - {$DepartmentName}"; ?></a></p>

				
				<div class="w3-col l7 m12 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto;">
					
					<table class="w3-table w3-responsive" id="studentdata">
						
						<thead>
							
							<tr class="w3-green"><td>#</td>  <td>Matric. No.</td> <td>Fullname</td> <td>Level</td> <td>Semester</td>  <td>Date of Birth</td> <td>Admitted</td></tr>

						</thead>


						<tbody>
							<?php echo $StudentData; ?>
						</tbody>


					</table>
					
										
						

				</div>


				<div class="w3-col l3 m3 s12 w3-padding w3-card-4 w3-margin-left" style=" margin-top: 1%; margin-bottom: 1%;">
					
					<p id="result_space" class="w3-center w3-small"></p>

					<form class="w3-form w3-padding" action="<?php echo "{$absPath}StreamController/stream_addstudent.php"; ?>" method="post">
						
						

						<label>Matric. No</label> <input class="w3-input" type="text" name="matric" id="matric" autofocus><br>
						<!--<label>Class Name</label> <input class="w3-input" type="text" name="class_name" id="class_name" autofocus><br>-->

						<label>First Name</label> <input class="w3-input" type="text" name="fname" id="fname"><br>

						<label>Middle name</label> <input class="w3-input" type="text" name="mname" id="mname"><br>

						<label>Last name</label> <input class="w3-input" type="text" name="lname" id="lname"><br>

						<label>Date of Birth</label><input class="w3-input" type="date" name="dob" id="dob" required="required"><br>

						

						<label>Level</label><select class="w3-input" name="level" id="level">
						
							<?php

								echo $LevelOptionList;
							?>
						</select><br/>

						<label>Semester</label><select class="w3-input" name="semester" id="semester">
						
							<option value="1">First Semester</option>
							<!--<option value="2">Second Semester</option>-->

						</select><br/>

						<input type="hidden" name="department" id="department" value="<?php echo $DepartmentId; ?>">
						<input type="hidden" name="faculty_id" id="faculty_id" value="<?php echo $FacultyId; ?>">
						
						<p class="w3-center"> <button class="w3-btn w3-green" type="submit" id="btnRegisterStudent">Register</button> </p>

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

		






