
<!DOCTYPE html>
<html>
	
	<?php
	
		$absPath = $data[0];
		$absForLinksAndInclusion = $data[1];

		$adminDetails = $data[2];

		$FacultyName = $data[3];

		$DepartmentName = $data[4];

		$faculty_id = $data[5];
		
		$department_id = $data[6];
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
			
			<p class="w3-leftbar w3-xlarge w3-white  w3-cqsfont" style="margin-left: 200px;"><a><?php echo $adminDetails['name']; ?></a></p>


				<p class="w3-cqsfont w3-large" style="margin-left:  200px;">Add Admin to <?php echo $DepartmentName; ?> <a  class="w3-tag w3-small w3-padding w3-red" onclick="window.close()"><I class="fa fa-times"></I>&nbsp;Close Registration</a></p>
				
				<div class="w3-col l6 m6 s12" style="margin-left: 200px; margin-top: 1%; margin-bottom: 1%; height: auto; display: flex; justify-content: center;">
					
					<div class="w3-col l12 m12 s12">
						<p id="result_space" class="w3-center w3-small"></p>

						<form class="w3-form w3-padding" action="<?php echo "{$absPath}StreamController/stream_addadminatdeptlevel.php"; ?>" method="post">
							
							<label>First Name</label> <input class="w3-input" type="text" name="fname" id="fname" autofocus><br>
							<label>Middle Name</label> <input class="w3-input" type="text" name="mname" id="mname" ><br>
							<label>Last Name</label> <input class="w3-input" type="text" name="lname" id="lname" ><br>
							<label>Username</label> <input class="w3-input" type="text" name="username" id="username" ><br>
							<label>Password</label> <input class="w3-input" type="password" name="password" id="password"><br>

							<label>Priority</label> <select class="w3-select" name="priority" id="priority">
								
								<option value="HODdepartment" class="w3-lime">HOD</option>
								<option value="department" class="w3-lime">Lecturer</option>
							</select><br>
							
							<input type="hidden" name="faculty" id="faculty" value="<?php echo $faculty_id; ?>">
							<input type="hidden" name="department" id="department" value="<?php echo $department_id; ?>">
							
							<p class="w3-center"> <button class="w3-btn w3-green" type="submit" id="btnAddAdminAtDeptLevel">Add</button> </p>
						
						</form>

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

		






