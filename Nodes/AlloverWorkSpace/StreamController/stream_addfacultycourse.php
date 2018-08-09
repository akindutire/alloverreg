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

	$faculty = $_POST['faculty_id'];
	$department = $_POST['department'];
	$course_title = $_POST['course_title'];
	$course_code = $_POST['course_code'];
	$course_unit = $_POST['course_unit'];
	$course_preq = $_POST['course_preq'];
	$level = $_POST['level'];
	$semester = $_POST['semester'];
	
	$Logger = new CQS_Logger;
	
	if(!empty($department) && !empty($course_title) && !empty($course_code) && !empty($course_unit) && !empty($course_preq) && !empty($level)){

		$cleansedSet = $sanitizeInput->cleanData([$faculty,$department,$course_title,$course_code,$course_unit,$course_preq]);
		
		$cleansedSet[2] = ucwords($cleansedSet[2]);
		$cleansedSet[3] = strtoupper($cleansedSet[3]);
		

		$cpaneltask->create_course($cleansedSet[2],$cleansedSet[3],$cleansedSet[4],$cleansedSet[5],$cleansedSet[0],$cleansedSet[1],$level,$semester);

	}else{

		echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Some fields are empty</a>"]);
	}


	$InApp->close();
	

	
?>