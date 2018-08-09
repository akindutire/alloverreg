
<!DOCTYPE html>
<html>
	
	<?php
		
		if ($_SESSION['rank'] != 'faculty') {
			die();
		}
		
		$absPath = $data[0];
		$absForLinksAndInclusion = $data[1];

		$adminDetails = $data[2];

		$FacultyName = $data[3];
		$FacultyId = $data[4];

		$DepartmentSelectOptionList  = $data[5];
		
		$VenueData  = $data[6];
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
			
			<p class="w3-leftbar w3-xlarge w3-white  w3-cqsfont" style="margin-left: 200px;"><a><?php echo "{$adminDetails['name']} |  {$FacultyName}";  ?></a></p>

				
				<div class="w3-col l7 m6 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto;">
					
					<p id="table_space"></p>
					<table class="w3-table w3-responsive" id="venuedata">
						
						
						<thead>
							
							<tr class="w3-green"><td>#</td> <td>Venue</td>  <td>Capacity</td> <td>Assigned_to</td></tr>

						</thead>


						<tbody>
							<?php echo $VenueData; ?>
						</tbody>


					</table>
					
										
						

				</div>

				<div class="w3-col l3 m3 s12 w3-padding w3-card-4 w3-margin-left" style=" margin-top: 1%; margin-bottom: 1%;">
					
					<p id="result_space" class="w3-center w3-small"></p>

					<form class="w3-form w3-padding" action="<?php echo "{$absPath}StreamController/stream_assignvenue.php"; ?>" method="post">
						
						<label>Class Alias</label> <input class="w3-input" type="text" name="class_code" id="class_code" autofocus><br>
						<!--<label>Class Name</label> <input class="w3-input" type="text" name="class_name" id="class_name" autofocus><br>-->
						<label>Class Capacity</label> <input class="w3-input" type="number" name="class_capacity" id="class_capacity" min='1'><br>

						<label>Assigned to</label><select class="w3-select" name="class_assigned_to" id="class_assigned_to">
							<option value="<?php echo $FacultyId; ?>">None</option>

							<?php

								echo $DepartmentSelectOptionList;
							?>
						</select>

						<input type="hidden" name="faculty_id" id="faculty_id" value="<?php echo $FacultyId; ?>">
						
						<p class="w3-center"> <button class="w3-btn w3-green" type="submit" id="btnAssignVenue">Assign</button> </p>

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

		






