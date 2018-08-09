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

	$faculty = $_POST['faculty'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$Logger = new CQS_Logger;
	
	if(!empty($faculty) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($username) && !empty($password)){

		$cleansedSet = $sanitizeInput->cleanData([$faculty,$fname,$mname,$lname,$username,$password]);
		
		$cleansedSet[1] = ucwords($cleansedSet[1]);
		$cleansedSet[2] = ucwords($cleansedSet[2]);
		$cleansedSet[3] = ucwords($cleansedSet[3]);

		$adminActivity->create_account($cleansedSet[1],$cleansedSet[2],$cleansedSet[3],$cleansedSet[4],$cleansedSet[5],$cleansedSet[0]);

	}else{

		echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Some fields are empty</a>"]);
	}


	$InApp->close();
	

	
?>