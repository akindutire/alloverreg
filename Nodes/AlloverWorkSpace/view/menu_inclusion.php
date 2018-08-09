<?php

use \CliqsStudio\service\CQS_Session as CQS_Session;

$session = new CQS_Session;

$capacity = $session->getSession('rank');



?>

<div class="w3-sidebar w3-bar-block w3-cloud-bg" style="margin-top: 0px;">
	
	<?php if($capacity == 'backdoor'){ ?>

		<a class="w3-bar-item w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel"; ?>" style="text-decoration: none; "><i class="fa fa-home"></i>&nbsp;Home</a>

		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/addfaculty"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Faculty</a>
		
		
		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/logout"; ?>" style="text-decoration: none; "><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
	
	<?php }else if($capacity == 'faculty'){ ?>


		<a class="w3-bar-item w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel"; ?>" style="text-decoration: none; "><i class="fa fa-home"></i>&nbsp;Home</a>

		<?php if($_SESSION['academic_session'] != null) { ?>
			
			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/opensession/{$_SESSION['academic_session']}/$FacultyId"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Department</a>

			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}student/list/{$_SESSION['academic_session']}/$FacultyId"; ?>" style="text-decoration: none; "><i class="fa fa-users"></i>&nbsp;Student</a>
			
			
			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/addvenue/$FacultyId"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Venue</a>

			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}/course/courses/{$_SESSION['academic_session']}/$FacultyId"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Course</a>

			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}/Nodes/AlloverWorkSpace/StreamController/stream_autoload.php?A={$_SESSION['academic_session']}&B={$FacultyId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Autoload Course</a>
			
			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-red w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}cpanel/exitsession/$FacultyId"; ?>" title="Exit from session implies clearing courses,student,lecturer associated" style="text-decoration: none; "><i class="fa fa-minus"></i>&nbsp;Exit Session</a>-->
			
		<?php } ?>
		
		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/logout"; ?>" style="text-decoration: none; "><i class="fa fa-sign-out"></i>&nbsp;Logout</a>


	<?php }else if ($capacity == 'HODdepartment') {  ?>

			<a class="w3-bar-item w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel"; ?>" style="text-decoration: none; "><i class="fa fa-home"></i>&nbsp;Home</a>


			<?php if($_SESSION['academic_session'] != null) { ?>
			
			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/opensession/{$_SESSION['academic_session']}/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-arrow-right"></i>&nbsp;Lecturer</a>
			
			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}student/list/{$_SESSION['academic_session']}/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-users"></i>&nbsp;Student</a>

			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}student/autoload/{$_SESSION['academic_session']}/{$FacultyId}/{$DepartmentId}"; ?>" target="_new" style="text-decoration: none; "><i class="fa fa-refresh"></i>&nbsp;Switch Student</a>
			
			
			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}lectures/prepare/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Lectures</a>-->

			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}/course/courses/{$_SESSION['academic_session']}/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Course</a>

			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}/Nodes/AlloverWorkSpace/StreamController/stream_autoload_for_dept.php?A={$_SESSION['academic_session']}&B={$FacultyId}&C={$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Autoload Course</a>-->
			
			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-red w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}cpanel/exitsession/$FacultyId"; ?>" title="Exit from session implies clearing courses,student,lecturer associated" style="text-decoration: none; "><i class="fa fa-minus"></i>&nbsp;Exit Session</a>-->
			
		<?php } ?>
		
		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-red w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/logout"; ?>" style="text-decoration: none; "><i class="fa fa-sign-out"></i>&nbsp;Logout</a>

			


	<?php }else{ ?>

			<a class="w3-bar-item w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel"; ?>" style="text-decoration: none; "><i class="fa fa-home"></i>&nbsp;Home</a>

			<?php if($_SESSION['academic_session'] != null) { ?>
			
			
			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}/cpanel/opensession/{$_SESSION['academic_session']}/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;My Course</a>


			<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}/course/courses/{$_SESSION['academic_session']}/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Courses</a>

			
			
			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}lectures/prepare/{$FacultyId}/{$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Lectures</a>-->

			
			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}/Nodes/AlloverWorkSpace/StreamController/stream_autoload_for_dept.php?A={$_SESSION['academic_session']}&B={$FacultyId}&C={$DepartmentId}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Autoload Course</a>-->
			
			<!--<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-red w3-grey w3-hover-green" href="<?php //echo "{$absForLinksAndInclusion}cpanel/exitsession/$FacultyId"; ?>" title="Exit from session implies clearing courses,student,lecturer associated" style="text-decoration: none; "><i class="fa fa-minus"></i>&nbsp;Exit Session</a>-->
			
		<?php } ?>

		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-red w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}cpanel/logout"; ?>" style="text-decoration: none; "><i class="fa fa-sign-out"></i>&nbsp;Logout</a>


	<?php } ?>
	
</div>