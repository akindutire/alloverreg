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

	include_once("../model/cpaneltask.php");

	$cpaneltask = new cpaneltask;
	

	$sanitizeInput = new CQS_Sanitize;

	$class_code = $_POST['class_code'];
	//$class_name = $_POST['class_name'];
	$class_name = "NULL";
	$class_assigned_to = $_POST['class_assigned_to'];
	$class_capacity = $_POST['class_capacity'];
	$faculty = $_POST['faculty_id'];
	$assignment_note = "Department";

	$Logger = new CQS_Logger;
	
	if(!empty($class_code) && !empty($class_name) && !empty($class_capacity) && !empty($class_assigned_to)){

		$cleansedSet = $sanitizeInput->cleanData([$class_code,$class_name,$class_capacity,$class_assigned_to]);
		
		$cleansedSet[0] = strtoupper($cleansedSet[0]);
		$cleansedSet[1] = ucwords($cleansedSet[1]);
		$cleansedSet[2] = intval($cleansedSet[2]);
		$cleansedSet[3] = ucwords($cleansedSet[3]);

		if ($faculty == $class_assigned_to) {
		
			$assignment_note = "Faculty";
		
		}

		$cpaneltask->add_venue($cleansedSet[0],$cleansedSet[1],$cleansedSet[2],$cleansedSet[3],$assignment_note,$faculty);

	}else{

		echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Department field is empty</a>"]);
	}


	$InApp->close();
	

	
?>