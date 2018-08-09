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
	
	$Logger = new CQS_Logger;
	
	if($_POST['parser'] == 1){
	
		$faculty_id = $_POST['faculty_id'];
		echo $cpaneltask->coursedata($_SESSION['academic_session'],$faculty_id);
	
	}else{

		$faculty_id = $_POST['faculty_id'];
		$department_id = $_POST['department_id'];
		echo $cpaneltask->coursedata($_SESSION['academic_session'],$faculty_id,$department_id);
		
	}

	$InApp->close();
	

	
?>