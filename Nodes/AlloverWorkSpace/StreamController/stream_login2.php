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

	include_once("../model/studenttask.php");

	$studenttask = new studenttask;
	

	$sanitizeInput = new CQS_Sanitize;

	$user = $_POST['EmailOnAdminLogin'];
	$pass = $_POST['PasswordOnAdminLogin'];

	$Logger = new CQS_Logger;
	



	if(!empty($user) && !empty($pass)){

		$cleansedSet = $sanitizeInput->cleanData([$user,$pass]);
		
	

		$studenttask->login_account($cleansedSet[0],$cleansedSet[1]);

	}else{

		echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Login fields are empty</a>"]);
	}


	$InApp->close();
	

	
?>