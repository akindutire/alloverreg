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

	$department_id = $_POST['department_id'];
	$lecturer_id  = $_POST['lecturer_id'];
	$course_id = $_POST['course_id'];


	
	$Logger = new CQS_Logger;
	
	if(!empty($course_id) && !empty($department_id) && !empty($course_id)){

	
		$cpaneltask->assign_course($department_id,$lecturer_id,$course_id);

	}else{

		echo json_encode(["msg"=>"Input field is empty"]);
	}


	$InApp->close();
	

	
?>