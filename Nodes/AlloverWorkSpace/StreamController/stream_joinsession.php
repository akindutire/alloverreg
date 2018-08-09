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

	$Academic_session = $_POST['Academic_Session'];

	$faculty_id = $_POST['faculty_id'];	

	$Logger = new CQS_Logger;
	
	if(!empty($Academic_session)){

		$cleansedSet = $sanitizeInput->cleanData([$Academic_session]);

		$cpaneltask->join_or_create_academic_session($cleansedSet[0],$faculty_id);

	}else{

		echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Input field is empty</a>"]);
	}


	$InApp->close();
	

	
?>