<?php
	
		
	use CliqsStudio\config\CQS_Config as CQS_Config;

	class errorl extends CQS_Config{

		public $live = null;
		public function __construct(){

			$parent = new parent;
			$this->live = $parent->live;

		}
	}	

	$now = date('F-d-Y',time());	
			
	if (!is_dir('log/')) {
		$filePath = '../log';
	}else{
		$filePath = 'log/';
	}
	
	$e = new errorl;
	
	$GLOBALS['live'] = $e->live;
	$GLOBALS['error_file']="$filePath/".$now.".txt";

	function error_handler($errno,$errstr,$errfile,$errline){

				echo "<b>Error:</b> [$errno] $errstr on line $errline in $errfile<br>";

				

				if ($GLOBALS['live'] === true){

					error_log("Error: [$errno] $errstr",3,$GLOBALS['error_file']);
				}

	}


?>