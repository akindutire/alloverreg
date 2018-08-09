<?php
	
	include_once 'vendor/autoload.php';
	include_once 'CliqsStudio/init.php';
	include_once 'error.php';

	use CliqsStudio\config\CQS_Config as CQS_Config;
	use CliqsStudio\CQS_App as CQS_App;

	
	class CQS_WorkSpace extends CQS_App{
	
	}
	
	/*@params FrameWorkRelativePath, WorkSpaceFolder, Database Parameters, LiveState, appToken*/

	$dbParams = ['driver'=>'mysql','host'=>'localhost','user'=>'root','password'=>'','database'=>'allover_reg'];
	$CQS_WorkSpace = new CQS_WorkSpace('CliqsStudio/','Nodes/AlloverWorkSpace/',$dbParams,false);

	
	/*error class reads the 3rd param of CQS_WorkSpace*/

	
	set_error_handler("error_handler",E_ALL);


	$CQS_WorkSpace->start();
	
	
?>