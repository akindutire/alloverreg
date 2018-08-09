<?php
	
	include_once('../../../vendor/autoload.php');
	include_once('../../../CliqsStudio/init.php');
	include_once('../../../error.php');


	use \CliqsStudio\config\CQS_Config as CQS_Config;
	use \CliqsStudio\service\CQS_Logger as CQS_Logger;
	use \CliqsStudio\service\CQS_Sanitize as CQS_Sanitize;
	use CliqsStudio\CQS_App as CQS_App;

	class CQS_WorkSpace extends CQS_App{


	}

	include_once("../controller/constants.php");

	//$dbParams = ['driver'=>'mysql','host'=>'localhost','user'=>'root','password'=>'','database'=>'allover_reg'];
	$InApp = new CQS_WorkSpace("../../../CliqsStudio/","../",$dbParams,false); 
	
	set_error_handler("error_handler",E_ALL);

	include_once("../model/adminActivity.php");

	$adminActivity = new adminActivity;
	

	$sanitizeInput = new CQS_Sanitize;

	$faculty = $_POST['faculty_id'];
	$department = $_POST['department'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$matric = $_POST['matric'];
	

	$dob = $_POST['dob'];
	$level = $_POST['level'];
	$semester = $_POST['semester'];

	$Logger = new CQS_Logger;
	
	if(!empty($matric) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($dob)){

		$cleansedSet = $sanitizeInput->cleanData([$matric]);
		
		$cleansedSet[0] = strtoupper($cleansedSet[0]);
		$fname = ucwords($fname);
		$mname = ucwords($mname);
		$lname = ucwords($lname);

		$password = $cleansedSet[0];
		
		$adminActivity->create_student_account($cleansedSet[0],$fname,$mname,$lname,$dob,$password,$faculty,$department,$level,$semester);

	}else{

		echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Some fields are empty</a>"]);
	}


	$InApp->close();
	

	
?>