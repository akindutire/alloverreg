<?php
	
	namespace CliqsStudio\service;
	use \CliqsStudio\Config\CQS_Config;


	class CQS_Logger extends CQS_Config{

		public $go_Flag = null;
		public $CQSUserPath = null;

		public function __construct(){
			
			$parent  =  new parent;
			$this->CQSUserPath = $parent->CQSUserPath;			
		}
	
		public function syslogger($msg){

				$parent = new parent;
				$self = new self;

				$LOGPATH 	=		$parent->logPath[0];
				
				$realPath = $self->CQSUserPath.$LOGPATH;
				
				
				if (is_dir($realPath) == true) {
					
					$now = date('F-d-Y',time());
					$file = $realPath.''.$now.".txt";

					$file = file_exists($file)?$file:fopen($file, 'w+');

					if (is_readable($file)) {

						
						$time = date('h:i:s a',time());
						$msg= $time." ---> $msg\n";

						try {
				
							error_log($msg,3,$file);
				
						} catch (Exception $e) {
							
							$e->getMessage();

						}

					}else{
						
						trigger_error("CQS Major Concern: Sys Log File Missing");	
					}

				}
			


		}

	
		public static function checkLive($error){

			$self = new self;

			$self->syslogger($error);
				
				/*echo "<pre>$error</pre>"; */
			
			

		}



	}



?>