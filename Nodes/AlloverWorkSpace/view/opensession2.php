
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

		$DepartmentName = $adminDetails['department'];
		$DepartmentId = $adminDetails['department_id'];

		$session_info = $data[3];
		$session_name = $session_info['session_name'];
		$session_id= $session_info['session_id'];

		$LecturerData = $data[4];
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

		<div class="w3-modal w3-animate-top" style="display: none; position: fixed;" id="DialogModalForCourses">
			
			
			<div class="w3-modal-content" class="">
				
				<h4 class="w3-grey">

					<span class="w3-center w3-padding-16 w3-medium w3-margin" style="padding-left: 16px;">Unassigned Departmental Courses</span>
					<span><a class="w3-tag w3-red w3-right" onclick="alert('Refresh to take effect');document.getElementById('DialogModalForCourses').style.display='none';"><i class="fa fa-times"></i></a></span>

				</h4>

				<div class="w3-container w3-white w3-padding-16">
					
					
					<table class="w3-table">
						
						<thead class="w3-grey">
							
							<tr><td>#</td> <td>Course</td> <td>Course Unit</td> <td>Course Code</td> </tr>
						</thead>

						<tbody>
							

						</tbody>


					</table>


				</div>
				


			</div>
		</div>
		<!--end modal-->

		<!--Modal for Assigned Courses-->

		<div class="w3-modal w3-animate-top" style="display: none; position: fixed;" id="DialogModalForAssignedCourses">
			
			
			<div class="w3-modal-content" class="">
				
				<h4 class="w3-grey">

					<span class="w3-center w3-padding-16 w3-medium w3-margin" style="padding-left: 16px;">Assigned Departmental Courses</span>
					<span><a class="w3-tag w3-red w3-right" onclick="document.getElementById('DialogModalForAssignedCourses').style.display='none';"><i class="fa fa-times"></i></a></span>

				</h4>

				<div class="w3-container w3-white w3-padding-16">
					
					
					<table class="w3-table">
						
						<thead class="w3-grey">
							
							<tr><td>#</td> <td>Course</td> <td>Course Unit</td> <td>Course Code</td> </tr>
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

				
				<div class="w3-col l8 m6 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto;">
					
					<p id="table_space" class="w3-center w3-small"></p>
					
					<input type="hidden" name="department" id="department" value="<?php echo $DepartmentId; ?>">

					<table class="w3-table w3-responsive" id="lecdata">
						
						
						<thead>
							
							<tr class="w3-green"><td>#</td><td>Lecturer</td> <td>Course(s)</td></tr>

						</thead>


						<tbody>
							<?php echo $LecturerData; ?>
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

		






