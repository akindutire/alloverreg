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
	$InApp = new CQS_WorkSpace("../../../CliqsStudio/","../",$dbParams,false); 
	
	set_error_handler("error_handler",E_ALL);

	include_once("../model/cpaneltask.php");

	$cpaneltask = new cpaneltask;
	

	$sanitizeInput = new CQS_Sanitize;

	$update_id = $_POST['updateid'];
	$department = $_POST['updatedept'];

	$Logger = new CQS_Logger;
	
	if(!empty($department)){

		$cleansedSet = $sanitizeInput->cleanData([$department]);
		$cleansedSet[0] = ucwords($cleansedSet[0]);

		$cpaneltask->update_department($cleansedSet[0],$update_id);

	}else{

		echo json_encode(["msg"=>"Department field is empty"]);
	}


	$InApp->close();
	

	
?>